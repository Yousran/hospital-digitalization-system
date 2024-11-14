<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\BiographController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.landing');
})->name('home');

Route::resource('users', UserController::class);
Route::post('/users/datatable', [UserController::class, 'datatable'])->name('users.datatable');
Route::resource('patients', PatientController::class);
Route::post('/patients/datatable', [PatientController::class, 'datatable'])->name('patients.datatable');
Route::resource('doctors', DoctorController::class);
Route::post('/doctors/datatable', [DoctorController::class, 'datatable'])->name('doctors.datatable');
Route::resource('specialities', SpecialityController::class);
Route::post('/specialities/datatable', [SpecialityController::class, 'datatable'])->name('specialities.datatable');
Route::post('/roles/datatable', [RoleController::class, 'datatable'])->name('roles.datatable');
Route::resource('roles', RoleController::class);
Route::resource('medical-records', MedicalRecordController::class);
Route::post('/medical-records/datatable', [MedicalRecordController::class, 'datatable'])->name('medical-records.datatable');

Route::resource('biographs', BiographController::class);

Route::resource('medicines', MedicineController::class);
Route::post('/medicines/update-stock', [MedicineController::class, 'updateStock'])->name('medicines.updateStock');

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

Route::controller(ConsultationController::class)->group(function () {
    Route::get('/consultation', 'index')->name('consultation');
    Route::post('/consultation', 'store')->name('consultation.store');
    Route::get('/add-medicine', 'addMedicine')->name('consultation.addMedicine');
});

Route::controller(UserController::class)->group(function(){
    Route::get('/user/{username}', 'showProfile')->name('user.profile');
});

Route::post('files', [FileController::class, 'store'])->name('files.store');


//https://flowbite.com/docs/forms/number-input/#min-and-max-values
//https://flowbite.com/docs/components/card/#e-commerce-card

//Consultation
//https://flowbite.com/blocks/e-commerce/shopping-cart/

//Dashboard 
//https://flowbite.com/docs/components/card/#card-with-list
//TODO: Medical Records adalah riwayat rekam medis, untuk dokter hanya bisa melihat rekam medis miliknya saja dan user hanya bisa melihat rekam medisnya saja
//TODO: ubah datatables buatan menjadi datatables flowbite
//TODO: Consultation bagian medicine card memunculkan stock dan juga memiliki field input description.
//TODO: Consultation bagian medicine card dengan panah quantity yang berfungsi dan berinteraksi dengan jumlah stock, yang akan mengubah jumlah stock di database
//TODO: Profile page with data doctor, and medical records
//TODO: refactor semua style dari tailwind