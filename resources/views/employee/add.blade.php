@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            Add Employee
            <form action="{{route('add-post')}}" method="POST" class="add-form border" >
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Email address</label>
                    <input type="name" name="name" class="form-control" id="name" placeholder="Name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email address">
                </div>
                <button type="submit" class="btn btn-success">Add Employee</button>
            </form>
        </div>
    </div>
</div>
@endsection
