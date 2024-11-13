@extends('layouts.form')

@section('contents')
<section class="bg-gray-50  min-h-screen h-full dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto">
        <div class="w-full bg-white rounded-lg shadow dark:border sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Edit Medicine
                </h1>
                <form method="POST" action="{{ route('medicines.update', $medicine->id) }}" class="space-y-4 md:space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full px-3">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $medicine->name ?? '') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                            @error('name')
                                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="w-full px-3">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea name="description" id="description" rows="3"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                >{{ old('description', $medicine->description ?? '') }}</textarea>
                            @error('description')
                                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="w-full px-3">
                            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                            <input type="text" name="type" id="type" value="{{ old('type', $medicine->type ?? '') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                            @error('type')
                                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="w-full px-3">
                            <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $medicine->stock ?? '') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                            @error('stock')
                                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="w-full px-3">
                            <label for="picture" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Medicine Picture</label>
                            <x-file-dropzone id="{{ $medicine->id }}" />
                        </div>
                    </div>                    
                    <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-primary-800">
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
