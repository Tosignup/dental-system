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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile-overview', [ProfileController::class, 'profileOverview'])->name('profile');
    // Route::patch('/profile/{user}', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::patch('/profile', [ProfileController::class, 'editProfile'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/appointments/add-walk-in', [AppointmentController::class, 'addWalkIn'])->name('add.walkIn');
    Route::get('/appointments/add-online/{patient}', [AppointmentController::class, 'addOnline'])->name('add.online');
    Route::post('/appointments', [AppointmentController::class, 'storeWalkIn'])->name('store.walkIn');
    Route::post('/appointments/{patient}', [AppointmentController::class, 'storeOnline'])->name('store.online');

    //Working Routes
    Route::get('/appointments/add-walk-in/dentists/{branch}', [DentistController::class, 'getDentists']);
    // Route::get('/appointments/add-walk-in/procedures/{dentistId}', [DentistController::class, 'getProceduresByDentist']);
    Route::get('/appointments/add-walk-in/schedules/{dentistId}', [DentistController::class, 'getDentistSchedules']);

    //Testing Routes
    Route::get('/appointments/add-walk-in/schedules/{dentistId}', [DentistController::class, 'getSchedulesByDentist']);
    Route::get('/appointments/add-walk-in/timeslots/{scheduleId}', [DentistController::class, 'getAvailableTimeSlots']);
    Route::get('/appointments/add-walk-in/schedule/{scheduleId}', [DentistController::class, 'getScheduleDetails']);
});

require __DIR__ . '/auth.php';

Route::get('/preview-email', function () {
    $user = Auth::user(); // Or pass a mock user instance for testing
    $notification = new VerifyEmail();

    return $notification->toMail($user);
});

Route::get('/send-test-email', function () {
    $details = [
        'subject' => 'Test Email from Laravel',
        'body' => 'This is a test email sent from Laravel using Mailtrap.'
    ];

    Mail::raw($details['body'], function ($message) use ($details) {
        $message->to('recipient@example.com')
                ->subject($details['subject']);
    });

    return 'Test email has been sent!';
});

// Route::get('/test-email', function () {
//     $details = [
//         'title' => 'Test Email',
//         'body' => 'This is a test email sent via MailSlurp SMTP.'
//     ];

//     Mail::to('d30a96df-fe79-46d7-861f-1a5551ae1780@mailslurp.net')->send(new \App\Mail\TestMail($details));

//     return 'Test email sent!';
// });


Route::get('/appointments/show-appointment/{appointment}', [AppointmentController::class, 'show'])->name('show.appointment');

Route::group(['middleware' => ['auth', 'verified','role:admin,staff,dentist']], function () {
    Route::get('/patient-list', [PatientController::class, 'patient_list'])->name('patient_list');
    Route::get('/appointments', [AppointmentController::class, 'appointment_submission'])->name('appointment.submission');
    Route::get('/inventory', [AdminController::class, 'inventory'])->name('inventory');
    Route::get('/admin/schedule', [AdminController::class, 'schedule'])->name('schedule');

    //Patient
    Route::get('/show-patient/{patient}/patient-contract', [PatientController::class, 'patientContract'])->name('patient.contract');
    Route::get('/show-patient/{patient}/patient-background', [PatientController::class, 'patientBackground'])->name('patient.background');
    Route::get('/show-patient/{patient}/patient-xray', [PatientController::class, 'patientXray'])->name('patient.xray');

    //Image Upload
    Route::post('/upload-image', [ImageController::class, 'uploadImage'])->name('upload.image');

    //Appointment
    // Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointment.create');
    // Route::post('/appointments/store', [AppointmentController::class, 'store'])->name('appointment.store');

    //Payment TEsting
    Route::get('/appointments/{appointmentId}/payment', [PaymentController::class, 'create'])->name('payments.form');
    Route::get('/payments/{paymentId}/history', [PaymentController::class, 'showPaymentHistory'])->name('payments.history');


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
    // Route::get('/admin/show-schedule/{schedule}', [ScheduleController::class, 'showSchedule'])->name('show.schedule');
    

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
    Route::post('/patient/payment/{patient}', [PaymentController::class, 'storePayment'])->name('store.payment');


    
});

// Staff Routes
Route::group(['middleware' => ['auth', 'verified', 'role:staff']], function () {
    Route::get('/staff/dashboard', [StaffController::class, 'overview'])->name('staff.dashboard');
    // Route::get('/staff/patient-list', [StaffController::class, 'patient_list'])->name('patient_list');

});
// Dentist Routes
Route::group(['middleware' => ['auth', 'role:dentist']], function () {
    Route::get('/dentist/dashboard/{dentist}', [DentistController::class, 'dentistAppointments'])->name('dentist.dashboard');
    // Route::get('/staff/patient-list', [StaffController::class, 'patient_list'])->name('patient_list');

    Route::get('/dentist/payments', [DentistController::class, 'viewPayments'])->name('dentist.payments');


    Route::post('/appointments/{id}/approve', [AppointmentController::class, 'approve'])->name('appointments.approve');
    Route::post('/appointments/{id}/decline', [AppointmentController::class, 'decline'])->name('appointments.decline');

});
//Client Routes
Route::group(['middleware' => ['auth', 'verified', 'role:client']], function () {
    Route::get('/client/dashboard', [ClientController::class, 'dashboard'])->name('dashboard'); //for redirection
    Route::get('/client/dashboard/overview/{patient}', [ClientController::class, 'profileOverview'])->name('client.overview');
    Route::get('/client/dashboard/user-profile', [ClientController::class, 'profileUserProfile'])->name('client.user-profile');

    Route::get('/client/{appointmentId}/payment', [ClientController::class, 'createClientPayment'])->name('client.form');
    Route::post('/client/{paymentId}/store', [ClientController::class, 'storeClientPartialPayment'])->name('client.store');
    Route::get('/client/{paymentId}/history', [ClientController::class, 'showClientPaymentHistory'])->name('client.history');

    // Route::get('/appointment/request', [AppointmentController::class, 'create'])->name('appointments.request');
    // Route::post('/appointment/store', [AppointmentController::class, 'store'])->name('appointments.store');
});
