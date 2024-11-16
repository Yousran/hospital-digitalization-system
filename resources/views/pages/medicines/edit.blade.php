@extends('layouts.form')

@section('title', 'Edit Medicine')

@section('contents')
<x-form formMethod="POST" action="{{ route('medicines.update', $medicine->id) }}" routeBack="{{ route('medicines.index') }}" xlColSpan="2" mdColSpan="2" formHeading="Edit Medicine">
    @method('PUT')

    <div>
        <label for="name" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Name</label>
        <input type="text" name="name" id="name" 
            value="{{ old('name', $medicine->name ?? '') }}"
            class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Medicine name" required>
        @error('name')
            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="description" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Description</label>
        <textarea name="description" id="description" rows="3"
            class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Medicine description">{{ old('description', $medicine->description ?? '') }}</textarea>
        @error('description')
            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="type" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Type</label>
        <input type="text" name="type" id="type" 
            value="{{ old('type', $medicine->type ?? '') }}"
            class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Medicine type" required>
        @error('type')
            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="stock" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Stock</label>
        <input type="number" name="stock" id="stock" 
            value="{{ old('stock', $medicine->stock ?? '') }}"
            class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Available stock" required>
        @error('stock')
            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="picture" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Medicine Picture</label>
        <x-file-dropzone id="{{ $medicine->id }}" />
    </div>
</x-form>
@endsection
