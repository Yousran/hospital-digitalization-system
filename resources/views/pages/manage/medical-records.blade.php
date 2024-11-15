@extends('layouts.dashboard')

@section('title', 'Medical Records')

@section('contents')
    <section class="bg-white mt-16 px-10 max-h-full min-h-screen antialiased dark:bg-gray-900 md:py-8">
        <div class="col-span-1 sm:col-span-3">
            <x-profile-card dropdownId="2" id="modal-container">
                <div class="items-center p-4 w-full">
                    <x-datatable routeDelete="medical-records.destroy" dataName="Medical Records" routeEdit="medical-records.edit" routeDatatable="medical-records.datatable"></x-datatable>
                </div>
                <x-modal target="createModal" modalTitle="Create Medical Record">
                    <div class="p-4 max-h-[80vh] w-[50vw]">
                        <form method="POST" action="{{ route('medical-records.store') }}">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- First Column -->
                                <div class="mb-4">
                                    <label for="doctor_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Doctor Name</label>
                                    <input type="text" name="doctor_name" class="mt-1 block w-full p-2 border rounded-lg" required>
                                </div>
                
                                <div class="mb-4">
                                    <label for="patient_surename" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Patient Surename</label>
                                    <input type="text" name="patient_surename" class="mt-1 block w-full p-2 border rounded-lg" required>
                                </div>
                
                                <!-- Second Column -->
                                <div class="mb-4">
                                    <label for="diagnosis" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Diagnosis</label>
                                    <textarea name="diagnosis" rows="4" class="mt-1 block w-full p-2 border rounded-lg" required></textarea>
                                </div>
                
                                <div class="mb-4">
                                    <label for="action" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Action</label>
                                    <textarea name="action" rows="4" class="mt-1 block w-full p-2 border rounded-lg" required></textarea>
                                </div>
                            </div>
                
                            <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create Record</button>
                        </form>
                    </div>
                </x-modal>                
            </x-profile-card>
        </div>
    </section>
@endsection
