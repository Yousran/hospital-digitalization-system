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
                    Edit Patient Information
                </h1>

                <form method="POST" action="{{ route('biographs.update', $patient->biograph->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- First Column -->
                        <div>
                            <div class="mb-4">
                                <label for="surename" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Surename</label>
                                <input type="text" name="surename" value="{{ $patient->biograph->surename ?? '' }}" class="mt-1 block w-full p-2 border rounded-lg" required>
                            </div>

                            <div class="mb-4">
                                <label for="date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date of Birth</label>
                                <input type="date" name="date_of_birth" value="{{ $patient->biograph->date_of_birth ?? '' }}" class="mt-1 block w-full p-2 border rounded-lg" required>
                            </div>

                            <div class="mb-4">
                                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                                <textarea name="address" class="mt-1 block w-full p-2 border rounded-lg" required>{{ $patient->biograph->address ?? '' }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label for="religion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Religion</label>
                                <input type="text" name="religion" value="{{ $patient->biograph->religion ?? '' }}" class="mt-1 block w-full p-2 border rounded-lg" required>
                            </div>

                            <div class="mb-4">
                                <label for="job" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Job</label>
                                <input type="text" name="job" value="{{ $patient->biograph->job ?? '' }}" class="mt-1 block w-full p-2 border rounded-lg" required>
                            </div>
                        </div>

                        <!-- Second Column -->
                        <div>
                            <div class="mb-4">
                                <label for="nik" class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIK</label>
                                <input type="text" name="nik" value="{{ $patient->biograph->nik ?? '' }}" class="mt-1 block w-full p-2 border rounded-lg" required>
                            </div>

                            <div class="mb-4">
                                <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gender</label>
                                <select name="gender" class="mt-1 block w-full p-2 border rounded-lg" required>
                                    <option value="laki-laki" {{ (isset($patient->biograph->gender) && $patient->biograph->gender == 'laki-laki') ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="perempuan" {{ (isset($patient->biograph->gender) && $patient->biograph->gender == 'perempuan') ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="marriage_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Marriage Status</label>
                                <input type="text" name="marriage_status" value="{{ $patient->biograph->marriage_status ?? '' }}" class="mt-1 block w-full p-2 border rounded-lg" required>
                            </div>

                            <div class="mb-4">
                                <label for="file_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">File</label>
                                <x-file-dropzone id="2"/>
                            </div>
                        </div>
                    </div>

                    <div class="flex space-x-4 w-full">
                        <!-- Cancel Button -->
                        <a href="{{ route('patients.index') }}" class="w-full text-gray-900 bg-gray-200 hover:bg-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">
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