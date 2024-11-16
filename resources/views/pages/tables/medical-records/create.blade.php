@extends('layouts.form')

@section('title', 'Create Medical Record')
    
@section('contents')
    <x-form formMethod="POST" action="{{ route('medical-records.store') }}" routeBack="{{ route('medical-records.index') }}" xlColSpan="2" mdColSpan="2" formHeading="Create New Medical Record">
        <div>
            <label for="doctor_name" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Doctor Name</label>
            <input type="text" name="doctor_name" id="doctor_name"
                class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Enter doctor name" required>
            @error('doctor_name')
                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="patient_surename" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Patient Surname</label>
            <input type="text" name="patient_surename" id="patient_surename"
                class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Enter patient surname" required>
            @error('patient_surename')
                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="diagnosis" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Diagnosis</label>
            <textarea name="diagnosis" id="diagnosis"
                class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Enter diagnosis details" required></textarea>
            @error('diagnosis')
                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="action" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Action</label>
            <textarea name="action" id="action"
                class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Enter suggested actions" required></textarea>
            @error('action')
                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
            @enderror
        </div>
    </x-form>
@endsection