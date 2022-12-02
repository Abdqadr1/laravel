@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            Edit Employee (ID : {{$employee->id}})
            <form action="{{route('emp.edit.put', $employee->id)}}" method="POST" class="add-form border" >
                @csrf
                @method("put")
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
                <button type="submit" class="btn btn-success">Edit Employee</button>
            </form>
        </div>
    </div>
</div>
@endsection
