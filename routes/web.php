<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\UserController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.landing');
})->name('home');

Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
Route::get('/specialities', [SpecialityController::class, 'index'])->name('specialities.index');
Route::get('/roles',function(){
    $roles = Role::with('users')->get();
    return dd(compact('roles'));
});

Route::controller(AuthenticateController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/password-reset', function(){
        return view('pages.password-reset');
    })->name('password-reset');
    Route::post('/password-reset', 'sendResetLinkEmail');
});

Route::controller(UserController::class)->group(function(){
    Route::get('/user/{username}', 'showProfile')->name('user.profile');
});