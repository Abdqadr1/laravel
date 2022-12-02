<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    private $EMPLOYEE_PER_PAGE = 5;
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function view()
    {
        $employees = Employee::paginate($this->EMPLOYEE_PER_PAGE);
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
        $email = $request->email;
        $employee->email = $email;
        $employee->date_joined = now();

        $employee->save();
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
        $employee->name = $request->name;
        $email = $request->email;
        $employee->email = $email;

        $employee->save();
        MailController::sendRegistrationMail([
            'message' => "Your detail have been updated",
            'subject' => "Employee Registration",
            'from' => "registration@employee.com",
            'view' => "emails.registration",
            'to' => $email,
        ]);
        return redirect(route('view'))->with('message', 'Employee updated successfully');
    }

    public function delete($id)
    {
        $employee = Employee::findOrFail($id);
    }
}
