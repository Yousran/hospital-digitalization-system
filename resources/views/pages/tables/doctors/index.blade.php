@extends('layouts.dashboard')

@section('title','Table Doctors')

@section('contents')
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    <x-card mdColSpan="md:col-span-2" xlColSpan="xl:col-span-3">
        <x-datatable :data="$doctors" datatableId="datatable" routeDelete="doctors.destroy" routeEdit="doctors.edit" routeCreate="doctors.create"/>
    </x-card>
</div>
@endsection