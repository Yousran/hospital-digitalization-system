@extends('layouts.form')

@section('title', 'Edit Doctor')

@section('contents')
<x-form formMethod="POST" action="{{ route('doctors.update', $doctor->id) }}" routeBack="{{ route('doctors.index') }}" xlColSpan="2" mdColSpan="2" formHeading="Edit Doctor">

    @method('PUT')
    <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
    <div>
        <label for="user_id" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">User</label>
        <select name="user_id" id="user_id"
            class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500">
            <option value="">Select User</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $doctor->biograph->user_id == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
        @error('user_id')
            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="surename" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Surename</label>
        <input type="text" name="surename" id="surename"
            class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Surename" required value="{{ $doctor->biograph->surename ?? '' }}">
        @error('surename')
            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="date_of_birth" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Date of Birth</label>
        <input type="date" name="date_of_birth" id="date_of_birth"
            class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
            required value="{{ $doctor->biograph->date_of_birth ?? '' }}">
        @error('date_of_birth')
            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="address" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Address</label>
        <textarea name="address" id="address"
            class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Address" required>{{ $doctor->biograph->address ?? '' }}</textarea>
        @error('address')
            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="religion" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Religion</label>
        <input type="text" name="religion" id="religion"
            class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Religion" required value="{{ $doctor->biograph->religion ?? '' }}">
        @error('religion')
            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="job" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Job</label>
        <input type="text" name="job" id="job"
            class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Job" required value="{{ $doctor->biograph->job ?? '' }}">
        @error('job')
            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="speciality_id" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Speciality</label>
        <select name="speciality_id" id="speciality_id"
            class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500">
            @foreach($specialities as $speciality)
                <option value="{{ $speciality->id }}"
                    {{ $doctor->speciality && $doctor->speciality->id === $speciality->id ? 'selected' : '' }}>
                    {{ $speciality->name }}
                </option>
            @endforeach
        </select>
        @error('speciality_id')
            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <!-- Second Column -->
    <div>
        <label for="nik" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">NIK</label>
        <input type="text" name="nik" id="nik"
            class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="NIK" required value="{{ $doctor->biograph->nik ?? '' }}">
        @error('nik')
            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="gender" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Gender</label>
        <select name="gender" id="gender"
            class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
            required>
            <option value="laki-laki" {{ (isset($doctor->biograph->gender) && $doctor->biograph->gender == 'laki-laki') ? 'selected' : '' }}>Laki-laki</option>
            <option value="perempuan" {{ (isset($doctor->biograph->gender) && $doctor->biograph->gender == 'perempuan') ? 'selected' : '' }}>Perempuan</option>
        </select>
        @error('gender')
            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="marriage_status" class="block mb-2 text-sm font-medium text-dark-500 dark:text-light-500">Marriage Status</label>
        <input type="text" name="marriage_status" id="marriage_status"
            class="w-full p-2.5 bg-light-500 border border-light-700 text-dark-500 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-300 dark:border-dark-100 dark:placeholder-dark-100 dark:text-light-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Marriage Status" required value="{{ $doctor->biograph->marriage_status ?? '' }}">
        @error('marriage_status')
            <div class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
        @enderror
    </div>
    <x-file-dropzone id="fotoKTP"/>
</x-form>
@endsection
