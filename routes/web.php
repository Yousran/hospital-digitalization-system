<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\BiographController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\AuthorizedMedicalRecordController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\CheckRole;
use App\Models\Patient;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.landing');
})->name('home');

Route::get('test',function(){
    $biographs = Patient::all();
    $roles = Role::all();
    return view('test', compact('roles'));
})->name('test');

Route::post('files', [FileController::class, 'store'])->name('files.store');

Route::controller(AuthenticateController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register');
    Route::get('/logout', 'logout')->name('logout')->middleware('auth');
    Route::get('/password-reset', function(){
        return view('pages.password-reset');
    })->name('password-reset');
    Route::post('/password-reset', 'sendResetLinkEmail');
});

Route::controller(UserController::class)->group(function(){
    Route::get('/user/{username}', 'showProfile')->name('user.profile');
});

Route::middleware(['auth'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/chart-medical-records', 'chartMedicalRecords')->name('chartMedicalRecords')->middleware(['role:admin']);
        Route::get('/fetch-active-users', 'fetchActiveUsers')->name('fetchActiveUsers')->middleware(['role:admin']);
        Route::get('/fetch-active-doctors', 'fetchActiveDoctors')->name('fetchActiveDoctors')->middleware(['role:admin,dokter']);
        Route::get('/fetch-active-patients', 'fetchActivePatients')->name('fetchActivePatients')->middleware(['role:admin']);
        Route::get('/fetch-doctor-latest-patients', 'fetchLatestPatients')->name('fetchDoctorLatestPatients')->middleware(['role:dokter']);
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('patients', PatientController::class);
        Route::resource('doctors', DoctorController::class);
        Route::resource('specialities', SpecialityController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('medical-records', MedicalRecordController::class);
        Route::resource('biographs', BiographController::class);

        Route::resource('medicines', MedicineController::class);
        Route::post('/medicines/update-stock', [MedicineController::class, 'updateStock'])->name('medicines.updateStock');
        
    });

    Route::middleware(['role:dokter'])->group(function () {
        Route::controller(ConsultationController::class)->group(function () {
            Route::get('/consultation', 'index')->name('consultation');
            Route::post('/consultation', 'store')->name('consultation.store');
            Route::post('/add-medicine', 'addMedicine')->name('consultation.addMedicine');
        });
    });
    
    Route::controller(AuthorizedMedicalRecordController::class)->group(function () {
        Route::get('/authorized-medical-records/patient', 'patient')->name('authorized-medical-records.patient');
        Route::get('/authorized-medical-records/doctor', 'doctor')->name('authorized-medical-records.doctor')->middleware(['role:dokter']);
    });
});

//https://flowbite.com/docs/forms/number-input/#min-and-max-values
//https://flowbite.com/docs/components/card/#e-commerce-card

//Consultation
//https://flowbite.com/blocks/e-commerce/shopping-cart/

//Dashboard 
//https://flowbite.com/docs/components/card/#card-with-list

//TODO: Middleware
//TODO: Rating

//TODO: Consultation bagian medicine card memiliki field input description.
//TODO: Consultation bagian medicine card bisa di hapus atau undo.
//TODO: Consultation bagian medicine card dengan panah quantity yang berfungsi dan berinteraksi dengan jumlah stock, yang akan mengubah jumlah stock di database
