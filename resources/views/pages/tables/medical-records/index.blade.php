@extends('layouts.dashboard');

@section('title','Table Medical Records')

@section('contents')
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    <x-card mdColSpan="md:col-span-2" xlColSpan="xl:col-span-3">
        <x-datatable :data="$medicalRecords" datatableId="datatable" routeDelete="medical-records.destroy" routeEdit="medical-records.edit" routeCreate="medical-records.create"/>
    </x-card>
</div>
@endsection