@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            Add Employee
            <form action="{{route('add-post')}}" method="POST" class="add-form border" >
                @csrf
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
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input name="address" class="form-control" id="address" placeholder="Address">
                </div>
                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    <input name="country" class="form-control" id="country" placeholder="Country">
                </div>
                <button type="submit" class="btn btn-success">Add Employee</button>
            </form>
        </div>
    </div>
</div>
@endsection
