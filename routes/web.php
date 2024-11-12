<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\BiographController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\UserController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.landing');
})->name('home');

Route::resource('users', UserController::class);
Route::resource('patients', PatientController::class);
Route::resource('doctors', DoctorController::class);
Route::resource('specialities', SpecialityController::class);
Route::resource('biographs', BiographController::class);

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

Route::post('files', [FileController::class, 'store'])->name('files.store');