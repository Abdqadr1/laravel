@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div> --}}
            <div class="container text-center">
                <div class="row gy-4">
                    <div class="col">
                        <div class="border action">
                            <a href="{{route('view')}}">View Employee</a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border action">
                            <a href="{{route('add')}}">Add Employee</a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border action">
                           <a href="{{route('task')}}">Add Task</a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border action">
                            <a href="{{route('settings')}}">Employee Settings</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
