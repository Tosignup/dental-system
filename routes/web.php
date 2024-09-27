<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Auth\Notifications\VerifyEmail;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\adminPanel\AdminController;
use App\Http\Controllers\adminPanel\ImageController;
use App\Http\Controllers\staffPanel\StaffController;
use App\Http\Controllers\clientPanel\ClientController;
use App\Http\Controllers\dentistPanel\DentistController;
use App\Http\Controllers\patientPanel\PatientController;
use App\Http\Controllers\patientPanel\PaymentController;
use Illuminate\Support\Facades\Mail;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route::get('/dashboard', [ClientController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile-overview/{user}', [ProfileController::class, 'profileOverview'])->name('profile');
    Route::put('/profile/{user}', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__ . '/auth.php';

Route::get('/preview-email', function () {
    $user = Auth::user(); // Or pass a mock user instance for testing
    $notification = new VerifyEmail();

    return $notification->toMail($user);
});

// Route::get('/test-email', function () {
//     $details = [
//         'title' => 'Test Email',
//         'body' => 'This is a test email sent via MailSlurp SMTP.'
//     ];

//     Mail::to('d30a96df-fe79-46d7-861f-1a5551ae1780@mailslurp.net')->send(new \App\Mail\TestMail($details));

//     return 'Test email sent!';
// });

Route::post('/appointments/{id}/approve', [AppointmentController::class, 'approve'])->name('appointments.approve');
Route::post('/appointments/{id}/decline', [AppointmentController::class, 'decline'])->name('appointments.decline');
Route::get('/appointments/show-appointment/{appointment}', [AppointmentController::class, 'show'])->name('show.appointment');

Route::group(['middleware' => ['auth', 'verified','role:admin,staff,dentist']], function () {
    Route::get('/patient-list', [PatientController::class, 'patient_list'])->name('patient_list');
    Route::get('/appointment-submission', [AppointmentController::class, 'appointment_submission'])->name('appointment.submission');
    Route::get('/inventory', [AdminController::class, 'inventory'])->name('inventory');
    Route::get('/admin/schedule', [AdminController::class, 'schedule'])->name('schedule');

    //Patient
    Route::get('/show-patient/{patient}/patient-contract', [PatientController::class, 'patientContract'])->name('patient.contract');
    Route::get('/show-patient/{patient}/patient-background', [PatientController::class, 'patientBackground'])->name('patient.background');
    Route::get('/show-patient/{patient}/patient-xray', [PatientController::class, 'patientXray'])->name('patient.xray');

    //Image Upload
    Route::post('/upload-image', [ImageController::class, 'uploadImage'])->name('upload.image');


 });

// Admin Routes
Route::group(['middleware' => ['auth', 'verified', 'role:admin']], function () {
    //Navbar
    Route::get('/admin/dashboard', [AdminController::class, 'overview'])->name('admin.dashboard');
    Route::get('/admin/dentist', [AdminController::class, 'dentist'])->name('dentist');
    Route::get('/admin/staff', [AdminController::class, 'staff'])->name('staff');

    //Viewing user profile

    // Doctor
    Route::get('/admin/add-dentist', [DentistController::class, 'addDentist'])->name('add.dentist');
    Route::post('/dentist', [DentistController::class, 'storeDentist'])->name('store.dentist');
    Route::get('/admin/edit-dentist/{dentist}', [DentistController::class, 'editDentist'])->name('edit.dentist');
    Route::put('/dentists/{dentist}', [DentistController::class, 'updateDentist'])->name('update.dentist');
    Route::get('/admin/show-dentist/{dentist}', [DentistController::class, 'showDentist'])->name('show.dentist');

    // Staff
    Route::get('/admin/add-staff', [StaffController::class, 'addStaff'])->name('add.staff');
    Route::post('/staff', [StaffController::class, 'storeStaff'])->name('store.staff');
    Route::get('/admin/edit-staff/{staff}', [StaffController::class, 'editStaff'])->name('edit.staff');
    Route::put('/staffs/{staff}', [StaffController::class, 'updateStaff'])->name('update.staff');
    Route::get('/admin/show-staff/{staff}', [StaffController::class, 'showStaff'])->name('show.staff');

    //Dentist Schedule
    Route::get('/admin/add-dentist-schedule', [ScheduleController::class, 'addSchedule'])->name('add.schedule');
    Route::post('/dentist-schedule', [ScheduleController::class, 'storeSchedule'])->name('store.schedule');
    Route::get('/admin/show-schedule/{schedule}', [ScheduleController::class, 'showSchedule'])->name('show.schedule');
    

    // Patients
    Route::get('/admin/add-patient', [PatientController::class, 'addPatient'])->name('add.patient');
    Route::post('/patients', [PatientController::class, 'storePatient'])->name('store.patient');
    Route::get('/admin/edit-patient/{patient}', [PatientController::class, 'editPatient'])->name('edit.patient');
    Route::put('/patients/{patient}', [PatientController::class, 'updatePatient'])->name('update.patient');
    Route::get('/admin/show-patient/{patient}', [PatientController::class, 'showPatient'])->name('show.patient');
    Route::post('/admin/archive-patient/{patient}', [PatientController::class, 'archivePatient'])->name('archive.patient');
    Route::post('/admin/restore-patient/{patient}', [PatientController::class, 'restorePatient'])->name('restore.patient');

    // Payment
    Route::get('/patient/payment-page/{patient}', [PaymentController::class, 'addPayment'])->name('add.payment');
    Route::post('/patient/payment/{patient}', [PaymentController::class, 'testPayment'])->name('store.payment');
    Route::get('/patient/edit-payment/{patient}/{payment}', [PaymentController::class, 'editPayment'])->name('edit.payment');
    Route::put('/patient/update-payment/{patient}/{payment}', [PaymentController::class, 'testUpPayment'])->name('update.payment');
    Route::get('/patient/{patient}/payment-history/{payment}', [PaymentController::class, 'showPaymentHistory'])->name('history.payment');
});

// Staff Routes
Route::group(['middleware' => ['auth', 'role:staff']], function () {
    Route::get('/staff/dashboard', [StaffController::class, 'overview'])->name('staff.dashboard');
    // Route::get('/staff/patient-list', [StaffController::class, 'patient_list'])->name('patient_list');

});
//Dentist Routes
Route::group(['middleware' => ['auth', 'role:dentist']], function () {
    Route::get('/staff/dashboard', [StaffController::class, 'overview'])->name('staff.dashboard');
    // Route::get('/staff/patient-list', [StaffController::class, 'patient_list'])->name('patient_list');

});
//Client Routes
Route::group(['middleware' => ['auth', 'verified', 'role:client']], function () {
    Route::get('/client/dashboard', [ClientController::class, 'dashboard'])->name('dashboard');
    Route::get('/client/dashboard/overview/{patient}', [ClientController::class, 'profileOverview'])->name('client.overview');
    Route::get('/client/dashboard/user-profile', [ClientController::class, 'profileUserProfile'])->name('client.user-profile');


    Route::get('/appointment/request', [AppointmentController::class, 'create'])->name('appointments.request');
    Route::post('/appointment/store', [AppointmentController::class, 'store'])->name('appointments.store');
});
