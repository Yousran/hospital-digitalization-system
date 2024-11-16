@extends('layouts.form')

@section('title','Edit User')

@section('contents')
<x-form csrfMethod="PUT" formMethod="POST" action="{{ route('users.update',$user) }}" routeBack="{{ route('users.index') }}" xlColSpan="2" mdColSpan="2" formHeading="Edit User" >
    <div>
        <label for="name" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Username</label>
        <input type="text" name="name" id="name"
            class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Username" required
            value="{{ $user->name }}">
        @error('name')
            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="email" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Email User</label>
        <input type="email" name="email" id="email"
            class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="name@company.com" required
            value="{{ $user->email }}">
        @error('email')
            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="password" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">New Password (Optional)</label>
        <input type="password" name="password" id="password"
            class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="********"
            >
        @error('password')
            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Confirm New Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation"
            class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="********">
        @error('password_confirmation')
            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
        @enderror
    </div>
    <x-file-dropzone id="fotoUser"/>
    <div>
        <label for="roles" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Assign Roles</label>
        @foreach($roles as $role)
            <div class="flex items-center">
                <input type="checkbox" name="roles[]" value="{{ $role->id }}" 
                id="role_{{ $role->id }}" 
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked @endif>
                <label for="role_{{ $role->id }}" class="ml-2 text-sm text-gray-900 dark:text-white">{{ $role->name }}</label>
            </div>
        @endforeach
        @error('roles')
            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
        @enderror
    </div>
</x-form>

@endsection