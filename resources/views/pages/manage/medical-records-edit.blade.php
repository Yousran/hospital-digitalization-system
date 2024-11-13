@extends('layouts.form')

@section('contents')
<section class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="flex flex-col min-h-screen items-center justify-center px-6 py-8 mx-auto">
        <a href="{{ route('home') }}" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img src="{{ asset('logo.png') }}" class="w-8 h-8 mr-4" alt="Logo" />
            Rumah Sehat
        </a>
        <div class="w-full bg-white rounded-lg shadow dark:border sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Edit Medical Record
                </h1>
                <form method="POST" action="{{ route('medical-records.update', $medicalRecord->id) }}" class="space-y-4 md:space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                        <!-- Doctor Name -->
                        <div class="mb-4">
                            <label for="doctor_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Doctor Name</label>
                            <input type="text" name="doctor_name" value="{{ $medicalRecord->doctor->biograph->surename }}" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                required>
                        </div>

                        <!-- Patient Surename -->
                        <div class="mb-4">
                            <label for="patient_surename" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Patient Surename</label>
                            <input type="text" name="patient_surename" value="{{ $medicalRecord->patient->biograph->surename }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                required>
                        </div>

                        <!-- Diagnosis -->
                        <div class="mb-4">
                            <label for="diagnosis" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Diagnosis</label>
                            <textarea name="diagnosis" rows="4" 
                                class="mt-1 block w-full p-2 border rounded-lg" required>{{ $medicalRecord->diagnosis }}</textarea>
                        </div>

                        <!-- Action -->
                        <div class="mb-4">
                            <label for="action" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Action</label>
                            <textarea name="action" rows="4" 
                                class="mt-1 block w-full p-2 border rounded-lg" required>{{ $medicalRecord->action }}</textarea>
                        </div>
                    </div>

                    <div class="flex space-x-4 w-full">
                        <!-- Cancel Button -->
                        <a href="{{ route('medical-records.index') }}" class="w-full text-gray-900 bg-gray-200 hover:bg-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">
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