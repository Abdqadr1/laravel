<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function view()
    {
        return view('employee.view');
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

    public function addEmployee()
    {
        error_log(request('name'));
    }
}
