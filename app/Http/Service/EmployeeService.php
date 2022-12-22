<?php

namespace App\Http\Service;

use App\Events\EmployeeRegistered;
use App\Http\Requests\EmployeeRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;

class EmployeeService
{

    const IMAGE_EXTENSIONS = ['png', 'jpeg', 'jpg'];
    public static function addTaskToEmployee(Request $request): array
    {
        $result = array("isDone" => false, "key" => "", "message" => '');
        $deadline = $request->input('deadline');
        $deadline = Carbon::parse($deadline)->format('Y-m-d H:i:s');
        $key = 'employee_id';
        $id = $request->input($key);
        $employee = Employee::find($id);
        if ($employee === null) {
            $result['key'] = $key;
            $result['message'] = "Employee with id $id does not exist";
            return $result;
        }
        $task = Task::create([
            'name' => $request->input('name'),
            'deadline' => $deadline,
            'task_for' => $id,
            'images' => ''
        ]);

        $photoName = "images";
        $images = $request->file($photoName);
        if ($request->hasFile($photoName)) {
            $notSupported = collect($images)->contains(function ($image, $key) {
                $ext = $image->extension();
                $size = $image->getSize();
                return !in_array($ext, EmployeeService::IMAGE_EXTENSIONS) || $size > 1024000;
            });
            if ($notSupported) {
                $result['key'] = 'images';
                $result['message'] = 'One of your files is not valid';
                return $result;
            }
            $array = [];
            foreach ($images as $image) {
                $path = $image->store("tasks/$task->id", 's3', 'public');
                array_push($array, Storage::disk('s3')->url($path));
            }
        }
        $task->update([
            'images' => $array
        ]);
        $result['isDone'] = true;
        return $result;
    }

    public static function deleteEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        $tasks = $employee->tasks;
        if (count($tasks) > 0) {
            foreach ($tasks as $task) {
                Storage::disk('s3')->deleteDirectory("tasks/$task->id");
            }
        }
        $employee->roles()->detach();
        $employee->delete();
        return back()->with('message', 'Employee deleted successfully');
    }

    public static function editEmployee(EmployeeRequest $request)
    {
        $id = $request->route('id');

        $employee = Employee::findOrFail($id);
        $employee->update([
            'name' => $request->name,
            'status' => $request->boolean('status'),
            'salary' => $request->salary,
        ]);
        $employee->setAddress([
            'street' => $request->address,
            'country' => empty($request->country) ? "" : $request->country
        ]);

        if ($request->has('roles')) {
            foreach ($request->roles as $role) error_log($role);
            $employee->roles()->sync($request->roles);
        }



        // MailController::sendRegistrationMail([
        //     'message' => "Your detail have been updated",
        //     'subject' => "Employee Registration",
        //     'from' => "registration@employee.com",
        //     'view' => "emails.registration",
        //     'to' => $email,
        // ]);
        return redirect(route('view'))->with('message', 'Employee updated successfully');
    }

    public static function addEmployee(EmployeeRequest $request)
    {
        $employee = new Employee;
        $employee->name = $request->name;
        $employee->status = $request->boolean('status');
        $employee->salary = $request->salary;
        $email = $request->email;
        $employee->email = $email;
        $employee->date_joined = now();
        $address = new Address;
        $address->street = $request->input('address');
        $address->country = $request->input('country');

        // error_log(json_encode($request->roles));
        // foreach ($request->roles as $role) error_log($role);

        // DB::transaction(function ($employee, $address, $request) {
        $employee->save();
        $employee->address()->save($address);
        $employee->roles()->sync($request->roles);
        // });

        EmployeeRegistered::dispatch($employee);

        return redirect(route('view'))->with('message', 'Employee added successfully');
    }

    public static function exe()
    {
        error_log("testing rate limit");
    }
    public static function testRateLimit()
    {
        $key = __FUNCTION__;
        RateLimiter::attempt(
            $key,
            $perMinute = 5,
            function () {
                EmployeeService::exe();
            }
        );
        if (RateLimiter::tooManyAttempts($key, $perMinute = 5)) {
            RateLimiter::hit($key);
            EmployeeService::exe();
            // $seconds = RateLimiter::availableIn($key);
            // error_log("Rate Limiting: Too many attempts, try again in $seconds seconds.");
        }
    }
}
