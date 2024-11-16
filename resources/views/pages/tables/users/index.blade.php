@extends('layouts.dashboard');

@section('title','Table Users')

@section('contents')
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    <x-card mdColSpan="md:col-span-2" xlColSpan="xl:col-span-3">
        <x-datatable :data="$users" datatableId="datatable" routeDelete="users.destroy" routeEdit="users.edit" routeCreate="users.create"/>
    </x-card>
</div>
@endsection