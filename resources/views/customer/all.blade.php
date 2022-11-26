@extends('layouts.layout')

@section("content")
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <p>{{ session('message') }}</p>
        <h2>Customers</h2>
        <a href="/customer/add">Add Customer</a>
        @foreach ($customers as $customer)
            <div> {{$customer->id}} - {{ $customer->name }} - {{$customer->age}} - 
                @foreach ($customer->hobbies as $hobby)
                    <span>{{ $hobby }},</span>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
@endsection