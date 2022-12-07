@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{route('add-post')}}" method="POST" class="border p-2">
        @csrf
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        <h3 class="text-center">Add Employee</h3>
        <div class="row justify-content-around">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="name" name="name" class="form-control" id="name" placeholder="Name" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-danger p-2 ps-0">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email address" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-danger p-2 ps-0">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <input type="checkbox" name="status" class="form-check" id="status" @checked(old('status'))>
                    @error('status')
                        <p class="text-danger p-2 ps-0">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="number" name="salary" class="form-control" id="salary" step="0.01" placeholder="Salary" value="{{ old('salary') }}">
                </div>
                
                <div class="form-floating mb-3">
                    <input  name="address" class="form-control" id="address" placeholder="Address" value="{{ old('address') }}" required>
                    <label for="address">Address</label>
                </div>
                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    <input name="country" class="form-control" id="country" placeholder="Country" value="{{ old('country') }}">
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
