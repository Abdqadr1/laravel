<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Employee;
use Illuminate\Http\Request;

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
        return view('employee.add');
    }

    public function payroll()
    {
        return view('employee.payroll');
    }

    public function settings()
    {
        return view('employee.settings');
    }

    public function addEmployee(Request $request)
    {
        $employee = new Employee;
        $employee->name = $request->name;
        $employee->status = $request->boolean('status');
        $employee->salary = $request->salary;
        $email = $request->email;
        $employee->email = $email;
        $employee->date_joined = now();
        $employee->save();
        $address = new Address;
        $address->street = $request->input('address');
        $address->country = $request->input('country');
        $employee->address()->save($address);

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
        return view('employee.edit', [
            'employee' => $employee
        ]);
    }

    public function editEmployee(Request $request)
    {
        $id = $request->route('id');
        $employee = Employee::findOrFail($id);
        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->boolean('status'),
            'salary' => $request->salary,
        ]);
        $employee->setAddress([
            'street' => $request->address,
            'country' => empty($request->country) ? "" : $request->country
        ]);

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
        $employee->delete();
        // dd($employee);
        return redirect(route('view'))->with('message', 'Employee deleted successfully');
    }
}
