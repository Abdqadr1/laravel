@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{route('emp.edit.put', $employee->id)}}" method="POST" class="p-3 border">
        <h4 class="text-center my-3">Edit Employee (ID : {{$employee->id}})</h4>
        @csrf
        @method("put")
        <div class="row justify-content-around">
            <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="name" name="name" class="form-control" id="name" placeholder="Name" value="{{$employee->name}}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email address" value="{{$employee->email}}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="checkbox" name="status" class="form-check" id="status" {{ ($employee->status) ? "checked" : "" }}>
                    </div>
                    <div class="mb-3">
                        <label for="salary" class="form-label">Salary</label>
                        <input type="number" name="salary" class="form-control" id="salary" step="0.01"
                            placeholder="Salary" value="{{$employee->salary}}">
                    </div>
                    <div class="form-floating mb-3">
                        <input  name="address" class="form-control" id="address" placeholder="Address" value="{{$employee->address->street}}" required>
                        <label for="address">Address</label>
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <input name="country" class="form-control" id="country" placeholder="Country" value="{{$employee->address->country}}"
                        >
                    </div>
            </div>
            <div class="col-md-3">
                <div class="mb-4">
                    <h3 class="form-label mb-3">Roles</h3>
                    @foreach ($roles as $role)
                        <div class="form-check">
                            <input name="roles[]" class="form-check-input" type="checkbox" value="{{$role->id}}" 
                                id="{{$role->name}}" {{ ($emp_roles->contains($role->id)) ? 'checked' : '' }} >
                            <label class="form-check-label" for="{{$role->name}}">
                                {{$role->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
                <h4 class="text-center mb-2">Tasks</h4>
                @if (count($employee->tasks) > 0)
                    @foreach ($employee->tasks as $task)
                        <div class="p-3 border border-success rounded d-flex justify-content-center my-2">
                            <span class="me-2">{{ $task->name }}</span>
                            <span class="ms-2">{{ $task->deadline }}</span>
                        </div>
                    @endforeach
                @else
                    <div class="text-center my-4">You have no task</div>
                @endif
                
            </div>
        </div>
        <button type="submit" class="btn btn-success">Edit Employee</button>
    </form>
</div>
@endsection
