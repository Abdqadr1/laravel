@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{route('add-post')}}" method="POST" class="border p-2">
        @csrf
        <h3 class="text-center">Add Employee</h3>
        <div class="row justify-content-around">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="name" name="name" class="form-control" id="name" placeholder="Name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email address">
                     @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <input type="checkbox" name="status" class="form-check" id="status">
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="number" name="salary" class="form-control" id="salary" step="0.01" placeholder="Salary">
                </div>
                
                <div class="form-floating mb-3">
                    <input  name="address" class="form-control" id="address" placeholder="Address" required>
                    <label for="address">Address</label>
                </div>
                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    <input name="country" class="form-control" id="country" placeholder="Country">
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="" class="form-label">Roles</label>
                    @foreach ($roles as $role)
                        <div class="form-check">
                            <input name="roles[]" class="form-check-input" type="checkbox" value="{{$role->id}}" id="{{$role->name}}">
                            <label class="form-check-label" for="{{$role->name}}">
                                {{$role->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
        <button type="submit" class="btn btn-success">Add Employee</button>
    </form>
</div>
@endsection
