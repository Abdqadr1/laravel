<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Service\EmployeeService;
use App\Models\Address;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $this->authorize('create', Employee::class);
        $roles = Role::orderBy("name")->get();
        return view('employee.add', ['roles' => $roles]);
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
        $this->authorize('create', Employee::class);
        return EmployeeService::addEmployee($request);
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
        return EmployeeService::editEmployee($request);
    }

    public function delete($id)
    {
        return EmployeeService::deleteEmployee($id);
    }


    public function addTask(Request $request)
    {
        $result = EmployeeService::addTaskToEmployee($request);
        error_log(json_encode($result));
        if (!$result['isDone']) {
            return back()->withErrors([$request['key'] => $request['message']])->withInput();
        }

        return redirect()->back()->with('message', "Task added successfully");
    }
}
