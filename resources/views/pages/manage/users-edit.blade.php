@extends('layouts.form')

@section('contents')
<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto">
        <a href="{{ route('home') }}" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img src="{{ asset('logo.png') }}" class="w-8 h-8 mr-4" alt="Logo" />
            Rumah Sehat
        </a>
        <div class="w-full bg-white rounded-lg shadow dark:border sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Edit User Information
                </h1>
                <form method="POST" action="{{ route('users.update', $user->id) }}" class="space-y-4 md:space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full md:w-1/2 px-3">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                            @error('name')
                                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                            @error('email')
                                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <x-file-dropzone id="{{ $user->id }}" />

                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full md:w-1/2 px-3">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password (Optional)</label>
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="New password (Leave blank to keep current)">
                            @error('password')
                                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Confirm new password">
                            @error('password_confirmation')
                                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Roles -->
                    <div class="w-full">
                        <label for="roles" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Assign Roles</label>
                        <div class="space-y-2">
                            @foreach($roles as $role)
                                <div class="flex items-center">
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" 
                                    id="role_{{ $role->id }}" 
                                    @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked @endif
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <label for="role_{{ $role->id }}" class="ml-2 text-sm text-gray-900 dark:text-white">{{ $role->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        @error('roles')
                            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex space-x-4 w-full">
                        <!-- Cancel Button -->
                        <a href="{{ route('users.index') }}" class="w-full text-gray-900 bg-gray-200 hover:bg-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">
                            Back
                        </a>

                        <!-- Update Button -->
                        <button type="submit"
                            class="w-full text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-primary-800">
                            Update
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
@endsection