@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <p>{{ session('message') }}</p>
        <div class="col-md-11">
            <h3 class="text-center mb-3">Employees Data</h3>
            
            <table class="table table-striped border table-hover my-2">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">ID</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">street Address</th>
                        <th scope="col">Country</th>
                        <th scope="col">Annual Salary</th>
                        <th scope="col">Tasks</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $emp)
                        <tr>
                            <td>{{$emp->id}}</td>
                            <td>{{$emp->name}}</td>
                            <td>{{$emp->email}}</td>
                            <td>{{$emp->address->street}}</td>
                            <td>{{$emp->address->country}}</td>
                            <td>{{$emp->salary}}</td>
                            <td>{{ count($emp->tasks) }}</td>
                            <td>
                                @if (json_encode($emp->status))
                                    <i class="bi bi-check-circle-fill text-success fs-5"></i>
                                @else
                                    <i class="bi bi-circle text-danger fs-5"></i>
                                @endif
                            </td>
                            <td class="d-flex justify-content-start">
                                <form title="delete" action="{{ route('emp.delete', $emp->id) }}" method="post" class="delete-form">
                                    @method('delete')
                                    @csrf
                                    <button type="submit">
                                        <i class="bi bi-archive border text-danger px-2 py-1 rounded border-info"></i>
                                    </button>
                                </form>
                                <a href="{{ route('emp.edit', $emp->id) }}">
                                    <i class="bi bi-pen border border-info px-2 py-1 rounded text-primary"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
               {{ $employees->onEachSide(3)->links() }}
            </div>
        </div>
    </div>

</div>
@endsection
