@extends('layouts.form')

@section('title', 'Create Speciality')

@section('contents')
    <x-form formMethod="POST" action="{{ route('specialities.store') }}" routeBack="{{ route('specialities.index') }}" xlColSpan="1" mdColSpan="1" formHeading="Create New Speciality">
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Name</label>
            <input type="text" name="name" id="name"
                class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Speciality Name" required>
            @error('name')
                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="description" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Description</label>
            <textarea name="description" id="description"
                class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Speciality Description"></textarea>
            @error('description')
                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
            @enderror
        </div>
    </x-form>
@endsection
