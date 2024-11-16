@extends('layouts.form');

@section('title','TEST')

@section('contents')
<h1 class="text-xl font-bold text-dark-500 md:text-2xl dark:text-light-500">
    Create New User
</h1>
<form action="{{ route('users.store') }}" method="POST">
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-4 my-4">
        @csrf
        
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="{{ route('users.index') }}" 
        class="w-full 
        text-dark-500 
        font-medium
        bg-primary-300 
        hover:bg-primary-500 
        rounded-lg 
        text-sm py-2 text-center">
            Back
        </a>

        <button type="submit"
            class="w-full 
        text-light-500 
        font-medium
        bg-primary-500 
        hover:bg-primary-600 
        rounded-lg 
        text-sm py-2 text-center">
            Create
        </button>
    </div>
</form>
@endsection