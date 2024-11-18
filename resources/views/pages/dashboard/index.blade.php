@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')

@section('contents')
@php
    $user = Auth::user();
    $roles = $user->roles->pluck('name')->toArray();
@endphp
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    <!-- Active Users (Admin Only) -->
    @if (in_array('admin', $roles))
        <x-card mdColSpan="md:col-span-1" xlColSpan="xl:col-span-1">
            <x-list-card 
                title="Active Users" 
                list-id="active-users-list" 
                fetch-url="{{ route('fetchActiveUsers') }}" 
            />
        </x-card>
    @endif

    <!-- Medical Records Chart (Visible for Admin and Doctor) -->
    @if (in_array('admin', $roles))
        <x-card mdColSpan="md:col-span-1" xlColSpan="xl:col-span-1">
            <x-chart 
                title="Medical Records"
                fetch-url="{{ route('chartMedicalRecords') }}" 
                series-name="Medical Records" 
                color="#5d80ab" 
                chart-type="area" 
            />
        </x-card>
    @endif

    <!-- Active Doctors (Admin Only) -->
    @if (in_array('admin', $roles))
        <x-card mdColSpan="md:col-span-1" xlColSpan="xl:col-span-1">
            <x-list-card 
                title="Active Doctors" 
                list-id="active-doctors-list" 
                fetch-url="{{ route('fetchActiveDoctors') }}" 
            />
        </x-card>
    @endif

    <!-- Active Patients (Admin and Doctor) -->
    @if (in_array('admin', $roles))
        <x-card mdColSpan="md:col-span-1" xlColSpan="xl:col-span-1">
            <x-list-card 
                title="Active Patients" 
                list-id="active-patients-list" 
                fetch-url="{{ route('fetchActivePatients') }}" 
            />
        </x-card>
    @endif

    <!-- Latest Patients (Doctor Only) -->
    @if (in_array('dokter', $roles))
        <x-card mdColSpan="md:col-span-1" xlColSpan="xl:col-span-1">
            <x-list-card 
                title="Latest Patients" 
                list-id="active-latest-patients-list" 
                fetch-url="{{ route('fetchDoctorLatestPatients') }}" 
            />
        </x-card>
    @endif
    
    <!-- Latest Patients (Doctor Only) -->
    @if (in_array('pasien', $roles))
        <x-card mdColSpan="md:col-span-1" xlColSpan="xl:col-span-1">
            <x-medical-record-card/>
        </x-card>
    @endif
    
    <!-- Latest Patients (Doctor Only) -->
    @if (in_array('pasien', $roles))
        <x-card mdColSpan="md:col-span-1" xlColSpan="xl:col-span-1">
            <x-rate-medical-record-card/>
        </x-card>
    @endif

    <!-- Users DataTable (Admin Only) -->
    @if (in_array('admin', $roles))
        <x-card mdColSpan="md:col-span-2" xlColSpan="xl:col-span-3">
            <x-datatable :data="$users" datatableId="datatable"/>
        </x-card>
    @endif
</div>
@endsection