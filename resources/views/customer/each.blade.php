@extends('layouts.app')

@section("content")
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <h2>Customer {{$id}}</h2>
        <p>{{ $customer->name }}</p>
        <div>
            Hobbies: 
            @foreach ($customer->hobbies as $hobby)
                <span>{{$hobby}}</span>
            @endforeach
        </div>
        <form action="{{ route('customer.delete', $id) }}" method="POST">
            @csrf
            @method("delete")
            <button class="delete">delete</button>
        </form>
    </div>
</div>
@endsection