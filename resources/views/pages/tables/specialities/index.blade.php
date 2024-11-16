@extends('layouts.dashboard');

@section('title','Table Doctor Specialities')

@section('contents')
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    <x-card mdColSpan="md:col-span-2" xlColSpan="xl:col-span-3">
        <x-datatable :data="$specialities" datatableId="datatable" routeDelete="specialities.destroy" routeEdit="specialities.edit" routeCreate="specialities.create"/>
    </x-card>
</div>
@endsection