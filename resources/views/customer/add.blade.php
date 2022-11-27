@extends('layouts.app')

@section("content")
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <h2 class="text-center">Add Customer</h2>
        <Form action="{{ route('customer.create') }}" method="POST" class="postform">
            @csrf
            <input type="text" name="name" placeholder="Name" required/>
            <input type="number" name="age" placeholder="Age" max="150" required />
            <input type="text" name="country" placeholder="Country" required />
            <input type="password" name="password" placeholder="*****" required />
            <fieldset>
                <label for="">Hobbies: </label>
                <input type="checkbox" name="hobbies[]" value="reading">Reading
                <input type="checkbox" name="hobbies[]" value="dancing">Dancing
                <input type="checkbox" name="hobbies[]" value="jumping">Jumping
                <input type="checkbox" name="hobbies[]" value="riding">Riding
            </fieldset>
            <input type="submit" value="Submit">
        </Form>
    </div>
</div>
@endsection