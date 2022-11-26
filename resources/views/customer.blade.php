@extends('layouts.layout')

@section("content")
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <h2>Customers</h2>
        @foreach ($customers as $customer)
            <div> {{ $customer->name }} - {{$customer->age}} </div>
        @endforeach
    </div>
</div>
@endsection