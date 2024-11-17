@extends('layouts.dashboard')

@section('title','Dashboard Admin')

@section('contents')
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    <x-card mdColSpan="md:col-span-1" xlColSpan="xl:col-span-1">
        <x-list-card 
        title="Active Users" 
        list-id="active-users-list" 
        fetch-url="{{ route('fetchActiveUsers') }}" 
    />
    </x-card>
    
    <x-card mdColSpan="md:col-span-1" xlColSpan="xl:col-span-1">
        <x-chart 
            title="Medical Records"
            fetch-url="{{ route('chartMedicalRecords') }}" 
            series-name="Medical Records" 
            color="#5d80ab" 
            chart-type="area" 
        />
    </x-card>

    <x-card mdColSpan="md:col-span-1" xlColSpan="xl:col-span-1">
        <x-list-card 
            title="Active Doctors" 
            list-id="active-doctors-list" 
            fetch-url="{{ route('fetchActiveDoctors') }}" 
        />
    </x-card>

    <x-card mdColSpan="md:col-span-1" xlColSpan="xl:col-span-1">
        <x-list-card 
            title="Active Patients" 
            list-id="active-patients-list" 
            fetch-url="{{ route('fetchActivePatients') }}" 
        />
    </x-card>

    <x-card mdColSpan="md:col-span-1" xlColSpan="xl:col-span-1">
        <x-list-card 
            title="Latest Patients" 
            list-id="active-latest-patients-list" 
            fetch-url="{{ route('fetchDoctorLatestPatients') }}" 
        />
    </x-card>

    <x-card mdColSpan="md:col-span-2" xlColSpan="xl:col-span-3">
        <x-datatable :data="$users" datatableId="datatable"/>
    </x-card>

</div>
@endsection