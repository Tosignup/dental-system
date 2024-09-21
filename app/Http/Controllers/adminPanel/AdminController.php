<?php

namespace App\Http\Controllers\adminPanel;

use Carbon\Carbon;
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

    public function patient_list(Request $request)
    {
        $patients = Patient::all();
        $patientQuery = Patient::query();

        if ($request->has('search') && !empty($request->get('search'))) {
            $searchTerm = $request->get('search');
            $patientQuery->where(function ($query) use ($searchTerm) {
                $query->where('last_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('first_name', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->has('sort')) {
            $sortOption = $request->get('sort');
            if ($sortOption == 'next_visit') {
                $patientQuery->orderBy('next_visit', 'ASC');
            } elseif ($sortOption == 'id') {
                $patientQuery->orderBy('id', 'ASC');
            } elseif ($sortOption == 'name') {
                $patientQuery->orderBy('last_name', 'ASC')->orderBy('first_name', 'ASC');
            } elseif ($sortOption == 'date_added') {
                $patientQuery->orderBy('created_at', 'ASC');
            }
        } else {
            $patientQuery->orderBy('created_at', 'ASC');
        }

        $patients = $patientQuery->paginate(10); //to edit


        return view('content.patients', compact('patients'));
    }

    public function dentist()
    {
        $dentists = Dentist::all();

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
