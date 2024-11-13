@extends('layouts.dashboard')

@section('title', 'User Roles')

@section('contents')
    <section class="bg-white mt-16 px-10 max-h-full min-h-screen antialiased dark:bg-gray-900 md:py-8">
        <div class="col-span-1 sm:col-span-3">
            <x-profile-card dropdownId="2" id="modal-container">
                <div class="items-center p-4 w-full">
                    <x-datatable routeDelete="roles.destroy" dataName="User Roles" routeEdit="roles.edit" routeDatatable="roles.datatable"></x-datatable>
                </div>
                <x-modal target="createModal" modalTitle="Create User Role">
                    <div class="p-4 max-h-[80vh] w-[50vw]">
                        <form method="POST" action="{{ route('roles.store') }}">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                                <!-- Surname Field -->
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                    <input type="text" name="name" class="mt-1 block w-full p-2 border rounded-lg" required>
                                </div>
                
                                <!-- Address Field -->
                                <div class="mb-4">
                                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                    <textarea name="description" class="mt-1 block w-full p-2 border rounded-lg"></textarea>
                                </div>

                                <div class="mb-4">
                                    <label for="badge_colour" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Badge Colour</label>
                                    <input type="text" name="badge_colour" class="mt-1 block w-full p-2 border rounded-lg" required>
                                </div>
                            </div>
                            <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button>
                        </form>
                    </div>
                </x-modal>
            </x-profile-card>
        </div>
    </section>
@endsection
