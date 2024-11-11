<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SpecialityController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
Route::get('/specialities', [SpecialityController::class, 'index'])->name('specialities.index');
Route::get('/roles',function(){
    $roles = Role::with('users')->get();
    return dd(compact('roles'));
});