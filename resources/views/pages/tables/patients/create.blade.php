@extends('layouts.form')

@section('title', 'Create Patient')

@section('contents')
    <x-form formMethod="POST" action="{{ route('biographs.store') }}" routeBack="{{ route('patients.index') }}" xlColSpan="2" mdColSpan="2" formHeading="Create New Patient">
        <div>
            <label for="surename" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Surename</label>
            <input type="text" name="surename" id="surename" 
                class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Surename" required>
            @error('surename')
                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="date_of_birth" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Date of Birth</label>
            <input type="date" name="date_of_birth" id="date_of_birth" 
                class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                required>
            @error('date_of_birth')
                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="address" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Address</label>
            <textarea name="address" id="address"
                class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Address" required></textarea>
            @error('address')
                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="religion" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Religion</label>
            <input type="text" name="religion" id="religion" 
                class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Religion" required>
            @error('religion')
                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="job" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Job</label>
            <input type="text" name="job" id="job"
                class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Job" required>
            @error('job')
                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="relatives" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Relatives</label>
            <input type="text" name="relatives" id="relatives"
                class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Relatives">
            @error('relatives')
                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="nik" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">NIK</label>
            <input type="text" name="nik" id="nik"
                class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="NIK" required>
            @error('nik')
                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="gender" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Gender</label>
            <select name="gender" id="gender"
                class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                required>
                <option value="laki-laki">Laki-laki</option>
                <option value="perempuan">Perempuan</option>
            </select>
            @error('gender')
                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="marriage_status" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Marriage Status</label>
            <input type="text" name="marriage_status" id="marriage_status"
                class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Marriage Status" required>
            @error('marriage_status')
                <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <x-file-dropzone id="file_id" />
    </x-form>
@endsection