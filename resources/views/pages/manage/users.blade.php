@extends('layouts.dashboard')

@section('title', 'Users')

@section('contents')
    <section class="bg-white mt-16 px-10 max-h-full min-h-screen antialiased dark:bg-gray-900 md:py-8">
        <div class="col-span-1 sm:col-span-3">
            <x-profile-card dropdownId="2" id="modal-container">
                <div class="items-center p-4 w-full">
                    <x-datatable routeDelete="users.destroy" dataName="Users" routeEdit="users.edit" routeDatatable="users.datatable"></x-datatable>
                </div>
                <x-modal target="createModal" modalTitle="Create User">
                    <div class="p-4 max-h-[80vh] w-[50vw]">
                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- First Column -->
                                <div>
                                    <div class="mb-4">
                                        <label for="name"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                        <input type="text" name="name" value=""
                                            class="mt-1 block w-full p-2 border rounded-lg" placeholder="Username" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="email"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                        <input type="email" name="email" value=""
                                            class="mt-1 block w-full p-2 border rounded-lg" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for=""
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Profile
                                            Picture</label>
                                        <x-file-dropzone id="fileDropdown" />
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div>
                                    <div class="mb-4">
                                        <label for="password"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Password</label>
                                        <input type="password" name="password"
                                            class="mt-1 block w-full p-2 border rounded-lg"
                                            placeholder="Enter current password" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="password_confirmation"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Confirm Password</label>
                                        <input type="password" name="password_confirmation"
                                            class="mt-1 block w-full p-2 border rounded-lg" placeholder="Confirm password">
                                    </div>
                                    <div class="mb-4">
                                        <label for="roles" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Assign Roles</label>
                                        <div class="space-y-2">
                                            @foreach($roles as $role)
                                                <div class="flex items-center">
                                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" 
                                                    id="role_{{ $role->id }}" 
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <label for="role_{{ $role->id }}" class="ml-2 text-sm text-gray-900 dark:text-white">{{ $role->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('roles')
                                            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button>
                        </form>
                    </div>
                </x-modal>
            </x-profile-card>
        </div>
    </section>
@endsection
