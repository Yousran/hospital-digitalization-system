@extends('layouts.dashboard')

@section('title','Medical Records')

@section('contents')
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    <x-card mdColSpan="md:col-span-2" xlColSpan="xl:col-span-3">
        <x-datatable :data="$medicalRecords" datatableId="datatable"/>
    </x-card>
</div>
@endsection