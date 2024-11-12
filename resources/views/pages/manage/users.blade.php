@extends('layouts.dashboard')

@section('title', 'Users')

@section('contents')
    <section class="bg-white mt-16 px-10 max-h-full min-h-screen antialiased dark:bg-gray-900 md:py-8">
        <div class="col-span-1 sm:col-span-3">
            <x-profile-card dropdownId="2">
                <div class="items-center p-4 w-full">
                    <x-datatable :data="$users" routeDelete="users.destroy" targetModalEdit="" >

                    </x-datatable>
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
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current
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
                                            class="mt-1 block w-full p-2 border rounded-lg" placeholder="New password">
                                    </div>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button>
                        </form>
                    </div>
                </x-modal>
                @foreach ($users as $user)
                    <x-modal target="editModal-{{ $user->id }}" modalTitle="Edit User">
                        <div class="p-4 max-h-[80vh] w-[50vw]">
                            <form method="POST" action="{{ route('users.update', $user->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- First Column -->
                                    <div>
                                        <div class="mb-4">
                                            <label for="name"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                            <input type="text" name="name" value="{{ $user->name }}"
                                                class="mt-1 block w-full p-2 border rounded-lg" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="email"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                            <input type="email" name="email" value="{{ $user->email }}"
                                                class="mt-1 block w-full p-2 border rounded-lg" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for=""
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Profile
                                                Picture</label>
                                            <x-file-dropzone id="{{ $user->id }}" />
                                        </div>
                                    </div>
                                    <!-- Second Column -->
                                    <div>
                                        <div class="mb-4">
                                            <label for="current_password"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current
                                                Password</label>
                                            <input type="password" name="current_password"
                                                class="mt-1 block w-full p-2 border rounded-lg"
                                                placeholder="Enter current password" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="password"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">New
                                                Password</label>
                                            <input type="password" name="password"
                                                class="mt-1 block w-full p-2 border rounded-lg" placeholder="New password">
                                        </div>
                                        <div class="mb-4">
                                            <label for="password_confirmation"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm
                                                New
                                                Password</label>
                                            <input type="password" name="password_confirmation"
                                                class="mt-1 block w-full p-2 border rounded-lg"
                                                placeholder="Confirm new password">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit"
                                    class="w-full text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button>
                            </form>
                        </div>
                    </x-modal>
                @endforeach
            </x-profile-card>
        </div>
    </section>
@endsection
