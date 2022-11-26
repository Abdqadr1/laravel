@extends('layouts.layout')

@section("content")
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <img src="/img/male.png" />
        <h1>Test page</h1>
        <div> type - {{ $type }}, lang - {{ $lang }}</div>
        @if($price > 10)
        <p> price is greater than 10 </p>
        @elseif ($price < 5) <p>price is less than 5</p>
        @else
        <p>price is something else</p>
        @endif

        @unless($lang != "php")
        <div>the lang is php</div>
        @endunless

        {{-- @for($i=0; $i < count($fruits); $i++) 
            <p>for looping - {{ $fruits[$i] }}</p>
        @endfor --}}

        @foreach ($fruits as $fruit)
            <p>{{$loop->index + 1}} - {{ $fruit }}</p>
        @endforeach
    </div>
</div>
@endsection