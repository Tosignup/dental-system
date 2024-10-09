<?php

namespace App\Http\Controllers\adminPanel;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Staff;
use App\Models\Branch;
use App\Models\Dentist;
use App\Models\Patient;
use App\Models\AuditLog;
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

    public function schedule1()
    {
        // Get the current date and time
        $now = Carbon::now();

        // Retrieve schedules that are in the future
        $schedules = DentistSchedule::with('dentist')
            ->where('date', '>', $now) 
            ->get();

        return view('content.schedule', compact('schedules'));
    }

    public function schedule(Request $request)
    {
        $now = Carbon::now();

        $scheduleQuery = DentistSchedule::with(['dentist']);
                        // ->where('date', '>', $now);
                        
            if ($request->has('sortSchedule')) {
                $sortOption = $request->get('sortSchedule');
                if ($sortOption == 'date') {
                    $scheduleQuery->orderBy('date', 'ASC');
                } elseif ($sortOption == 'start_time') {
                    $scheduleQuery->orderBy('start_time', 'ASC');
                } elseif ($sortOption == 'end_time') {
                    $scheduleQuery->orderBy('end_time', 'ASC');
                }
            } else {
                $scheduleQuery->orderBy('date', 'ASC');
            }
            

        $schedules = $scheduleQuery->paginate(10);
    
        return view('content.schedule', compact('schedules'));
    }

    //Testing for AuditLog

    public function viewAuditLogs()
    {
        $auditLogs = AuditLog::orderBy('created_at', 'desc')->get();

        foreach($auditLogs as $auditLog) {
            $decodedChanges = json_decode($auditLog->changes, true); // Decode JSON to associative array
        
        // Check if decoding was successful and is an array
            if (is_array($decodedChanges)) {
                $auditLog->changes = $decodedChanges; // Assign decoded changes back to the audit log
            } else {
                $auditLog->changes = []; // Assign an empty array if decoding failed
            }
        }
        
        return view('audit.logs', compact('auditLogs'));
    }

}
