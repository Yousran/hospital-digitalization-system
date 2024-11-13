@extends('layouts.dashboard')

@section('title', 'Doctors')

@section('contents')
    <section class="bg-white mt-16 px-10 max-h-full min-h-screen antialiased dark:bg-gray-900 md:py-8">
        <div class="col-span-1 sm:col-span-3">
            <x-profile-card dropdownId="2" id="modal-container">
                <div class="items-center p-4 w-full">
                    <x-datatable routeDelete="doctors.destroy" dataName="Doctors" routeEdit="doctors.edit" routeDatatable="doctors.datatable"></x-datatable>
                </div>
                <x-modal target="createModal" modalTitle="Create Doctor">
                    <div class="p-4 max-h-[80vh] w-[50vw]">
                        <form method="POST" action="{{ route('biographs.store') }}">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- First Column -->
                                <div>
                                    <!-- Surname Field -->
                                    <div class="mb-4">
                                        <label for="surename" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Surename</label>
                                        <input type="text" name="surename" class="mt-1 block w-full p-2 border rounded-lg" required>
                                    </div>
                    
                                    <!-- Date of Birth Field -->
                                    <div class="mb-4">
                                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date of Birth</label>
                                        <input type="date" name="date_of_birth" class="mt-1 block w-full p-2 border rounded-lg" required>
                                    </div>
                    
                                    <!-- Address Field -->
                                    <div class="mb-4">
                                        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                                        <textarea name="address" class="mt-1 block w-full p-2 border rounded-lg" required></textarea>
                                    </div>
                    
                                    <!-- Religion Field -->
                                    <div class="mb-4">
                                        <label for="religion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Religion</label>
                                        <input type="text" name="religion" class="mt-1 block w-full p-2 border rounded-lg" required>
                                    </div>
                    
                                    <!-- Job Field -->
                                    <div class="mb-4">
                                        <label for="job" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Job</label>
                                        <input type="text" name="job" class="mt-1 block w-full p-2 border rounded-lg" required>
                                    </div>

                                    <div class="mb-4">
                                        <label for="speciality_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Speciality</label>
                                        <select name="speciality_id" id="speciality_id" class="mt-1 block w-full p-2 border rounded-lg">
                                            <!-- Loop through the $specialities collection to display each option -->
                                            @foreach($specialities as $speciality)
                                                <option value="{{ $speciality->id }}">
                                                    {{ $speciality->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>
                    
                                <!-- Second Column -->
                                <div>
                                    <!-- NIK Field -->
                                    <div class="mb-4">
                                        <label for="nik" class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIK</label>
                                        <input type="text" name="nik" class="mt-1 block w-full p-2 border rounded-lg" required>
                                    </div>
                    
                                    <!-- Gender Field -->
                                    <div class="mb-4">
                                        <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gender</label>
                                        <select name="gender" class="mt-1 block w-full p-2 border rounded-lg" required>
                                            <option value="laki-laki">Laki-laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                    </div>
                    
                                    <!-- Marriage Status Field -->
                                    <div class="mb-4">
                                        <label for="marriage_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Marriage Status</label>
                                        <input type="text" name="marriage_status" class="mt-1 block w-full p-2 border rounded-lg" required>
                                    </div>
                    
                                    <!-- File ID Field -->
                                    <div class="mb-4">
                                        <label for="file_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Foto KTP</label>
                                        <x-file-dropzone id="2"/>
                                    </div>
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
