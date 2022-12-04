@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="text-center mb-3">Add Task</h3>
            <form action="{{route('add.task')}}" method="POST" class="add-form border" >
                @if (session('error'))
                    <div class="alert alert-danger my-2 text-center" role="alert">
                        {{session('error')}}
                    </div>
                @endif
                @if (session('message'))
                    <div class="alert alert-success my-2 text-center" role="alert">
                        {{session('message')}}
                    </div>
                @endif
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="name" name="name" class="form-control" id="name" placeholder="Name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Deadline</label>
                    <input type="datetime-local" class="form-control" name="deadline" id="email" placeholder="Email address" required>
                </div>

                 <div class="mb-3">
                    <label for="employee_id" class="form-label">Employee ID</label>
                    <input type="number" class="form-control" step='1' name="employee_id" id="employee_id" placeholder="ID" min="1" required>
                </div>

                <button type="submit" class="btn btn-danger">Add Task</button>
            </form>
        </div>
    </div>
</div>
@endsection
