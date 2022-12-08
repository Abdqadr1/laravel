<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Address;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class EmployeeController extends Controller
{
    //
    const EMPLOYEE_PER_PAGE = 5;
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function view()
    {
        $employees = Employee::orderBy('created_at', 'DESC')
            // ->has('address')
            // ->doesntHave('address')
            // ->whereHas('address', function ($query) {  $query->where('street', 'like', '%i%'); })
            ->with('address')
            ->paginate(self::EMPLOYEE_PER_PAGE);

        return view('employee.view', [
            'employees' => $employees
        ]);
    }

    public function add()
    {
        $response = Gate::authorize('add-employee');
        if ($response->allowed()) {
            $roles = Role::orderBy("name")->get();
            return view('employee.add', ['roles' => $roles]);
        }
        echo $response->message();
    }

    public function task()
    {

        return view('task.add');
    }

    public function settings()
    {
        return view('employee.settings');
    }

    public function addEmployee(EmployeeRequest $request)
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

        MailController::sendRegistrationMail([
            'message' => "You have been registered as an employee at our company",
            'subject' => "Employee Registration",
            'from' => "registration@employee.com",
            'view' => "emails.registration",
            'to' => $email,
        ]);
        return redirect(route('view'))->with('message', 'Employee added successfully');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $emp_roles = $employee->roles->map(function ($role) {
            return $role->id;
        });
        $roles = Role::orderBy("name")->get();
        return view('employee.edit', [
            'employee' => $employee,
            'roles' => $roles,
            'emp_roles' => $emp_roles,
        ]);
    }

    public function editEmployee(EmployeeRequest $request)
    {
        $id = $request->route('id');
        foreach ($request->roles as $role) error_log($role);

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

        $employee->roles()->sync($request->roles);


        // MailController::sendRegistrationMail([
        //     'message' => "Your detail have been updated",
        //     'subject' => "Employee Registration",
        //     'from' => "registration@employee.com",
        //     'view' => "emails.registration",
        //     'to' => $email,
        // ]);
        return redirect(route('view'))->with('message', 'Employee updated successfully');
    }

    public function delete($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->roles()->detach();
        $employee->delete();
        // dd($employee);
        return redirect(route('view'))->with('message', 'Employee deleted successfully');
    }


    public function addTask(Request $request)
    {
        $deadline = $request->input('deadline');
        $deadline = Carbon::parse($deadline)->format('Y-m-d H:i:s');
        $id = $request->input('employee_id');
        $employee = Employee::find($id);
        if ($employee === null) {
            return redirect(route('add.task'))->with('error', "Employee with id $id does not exist");
        }
        error_log($deadline);
        Task::create([
            'name' => $request->input('name'),
            'deadline' => $deadline,
            'task_for' => $id
        ]);
        return redirect(route('add.task'))->with('message', "Task added successfully");
    }
}
