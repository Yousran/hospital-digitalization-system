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
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Middleware\CheckRole;
use App\Models\Patient;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

Route::get('test',function(){
    $biographs = Patient::all();
    $roles = Role::all();
    return view('test', compact('roles'));
})->name('test');

Route::get('settings', function () {
    return view('pages.settings');
})->name('settings');

Route::middleware(['log'])->group(function () {
    Route::get('/', function () {
        return view('layouts.landing');
    })->name('home');

    Route::post('files', [FileController::class, 'store'])->name('files.store');

    Route::controller(AuthenticateController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login');
        Route::get('/register', 'showRegisterForm')->name('register');
        Route::post('/register', 'register');
        Route::get('/logout', 'logout')->name('logout')->middleware('auth');

        Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
        Route::get('auth/google/callback', 'handleGoogleCallback');

        Route::get('/password-reset', function(){
            return view('pages.password-reset');
        })->name('password-reset');
        Route::post('/password-reset', 'sendResetLinkEmail');
    });
    
    Route::resource('users', UserController::class)->only(['store','update']);
    Route::resource('biographs', BiographController::class)->only(['store','update']);
    
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
});

Route::middleware(['auth','log'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        
        Route::get('/chart-medical-records', 'chartMedicalRecords')->name('chartMedicalRecords')->middleware(['role:admin']);
        Route::get('/chart-user-gender', 'chartUserGender')->name('chartUserGender')->middleware(['role:admin']);
        
        Route::get('/fetch-active-users', 'fetchActiveUsers')->name('fetchActiveUsers')->middleware(['role:admin']);
        Route::get('/fetch-active-doctors', 'fetchActiveDoctors')->name('fetchActiveDoctors')->middleware(['role:admin,dokter']);
        Route::get('/fetch-active-patients', 'fetchActivePatients')->name('fetchActivePatients')->middleware(['role:admin']);
        Route::get('/fetch-doctor-latest-patients', 'fetchLatestPatients')->name('fetchDoctorLatestPatients')->middleware(['role:dokter']);
        Route::get('/fetch-patient-latest-medicines', 'fetchPatientLatestMedicines')->name('fetchPatientLatestMedicines')->middleware(['role:pasien']);
        Route::get('/fetch-latest-unrated-medical-record', 'fetchLatestUnratedMedicalRecord')->name('fetchLatestUnratedMedicalRecord')->middleware(['role:pasien']);
        Route::post('/fetch-store-rate', 'storeRate')->name('storeRate')->middleware(['role:pasien']);
        Route::get('/fetch-upcoming-schedule', 'fetchUpcomingSchedule')->name('fetchUpcomingSchedule')->middleware(['role:pasien']);
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class)->except(['store','update']);
        Route::resource('patients', PatientController::class);
        Route::resource('doctors', DoctorController::class);
        Route::resource('specialities', SpecialityController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('medical-records', MedicalRecordController::class);
        Route::resource('biographs', BiographController::class)->except(['store','update']);

        Route::resource('medicines', MedicineController::class);
        Route::post('/medicines/update-stock', [MedicineController::class, 'updateStock'])->name('medicines.updateStock');
        
    });

    Route::controller(UserController::class)->group(function(){
        Route::get('/user/{username}', 'showProfile')->name('user.profile');
    });

    Route::middleware(['role:dokter'])->group(function () {
        Route::controller(ConsultationController::class)->group(function () {
            Route::get('/consultation', 'index')->name('consultation');
            Route::post('/consultation', 'store')->name('consultation.store');
            Route::get('/medicine-suggestions', 'getSuggestions')->name('medicine.suggestions');
            Route::post('/add-medicine', 'addMedicine')->name('consultation.addMedicine');
        });
    });

    Route::controller(ScheduleController::class)->group(function () {
        Route::get('/schedules', 'index')->name('schedules');
        Route::get('/book-appointment/{id}', 'bookAppointment')->name('schedule.book-appointment');
        Route::get('/schedule/check-availability/{doctor_id}/{date}', 'checkAvailability')->name('schedule.check-availability');
        Route::post('/schedule/store', 'store')->name('schedule.store');
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
//https://flowbite.com/docs/components/card/#card-with-lis

//TODO: Medical record overview untuk dashboard pasien
//TODO: Alert view connect dengan controller 
//TODO: Custom Error page 404 dan seterusnya