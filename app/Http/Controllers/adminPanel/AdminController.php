<?php

namespace App\Http\Controllers\adminPanel;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Staff;
use App\Models\Branch;
use App\Models\Dentist;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\DentistSchedule;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function overview()
    {
        $today = Carbon::today();

        $totalPatients = Patient::count();
        $newPatients = Patient::whereDate('created_at', $today)->count();
        $todayPatients = Patient::whereDate('next_visit', $today)->count();

        $totalAppointments = Appointment::count();
        $todayAppointment = Appointment::whereDate('appointment_date', $today)->count();
        $newAppointments = Appointment::whereDate('created_at', $today)->count();

        return view('content.overview', compact('totalPatients', 'newPatients', 'todayPatients', 'totalAppointments', 'newAppointments', 'todayAppointment'));

        // return view('content.overview');
    }
    

    public function staff()
    {
        $staffs = Staff::with('branch')->get();

        return view('content.staff-overview', compact('staffs'));
    }
    public function dentist()
    {
        
        $dentists = Dentist::with('branch')->get();
        return view('content.dentist-overview', compact('dentists'));

    }

    public function inventory()
    {
        return view('content.inventory');
    }

    public function schedule()
    {
        $schedules = DentistSchedule::with('dentist')->get();

        return view('content.schedule', compact('schedules'));
    }

    

}
