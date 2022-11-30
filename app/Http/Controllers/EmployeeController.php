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
        $paginator = Employee::paginate($this->EMPLOYEE_PER_PAGE);
        error_log($paginator->nextPageUrl());
        return view('employee.view', [
            'employees' => $paginator->items(),
            'count' => $paginator->count(),
            'currentPage' => $paginator->currentPage(),
            'total' => $paginator->total(),
            'nextPage' => $paginator->nextPageUrl(),
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
        $employee->email = $request->email;
        $employee->date_joined = now();

        $employee->save();
        return redirect(route('view'))->with('message', 'Employee added successfully');
    }
}
