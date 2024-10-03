<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Dentist;
use App\Models\Patient;
use App\Models\Procedure;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\DentistSchedule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\AppointmentApproved;
use App\Notifications\AppointmentDeclined;
use Illuminate\Support\Facades\Notification;

class AppointmentController extends Controller
{
    public function create()
    {

        $branches = Branch::all();
        $patients = Patient::all();

        return view('appointment.create', [
            'branches' => $branches,
            'patients' => $patients,
        ]);
    }

    public function show($id){
        $appointment = Appointment::find($id);

        return view('appointment.appointment-information', compact('appointment'));
    }

    public function appointment_submission1(Request $request){
        $appointments = Appointment::with(['patient', 'branch'])->get();
        $appointmentsQuery = Appointment::query();

        if ($request->has('sort')) {
            $sortOption = $request->get('sort');
            if ($sortOption == 'name') {
                $appointmentsQuery->orderBy('last_name', 'ASC')->orderBy('first_name', 'ASC');
            } elseif ($sortOption == 'appointment_date') {
                $appointmentsQuery->orderBy('appointment_date', 'ASC');
            } elseif ($sortOption == 'status') {
                $appointmentsQuery->orderBy('status', 'ASC');
            } elseif ($sortOption == 'branch') {
                $appointmentsQuery->orderBy('branch', 'ASC');
            }
        } else {
            $appointmentsQuery->orderBy('created_at', 'ASC');
        }

    
        
        $appointments = $appointmentsQuery->get();

        return view('content.appointment-submissions', compact('appointments'));
    }

    public function appointment_submission(Request $request)
    {
        $walkinAppointmentsQuery = Appointment::with(['patient', 'branch', 'dentistSchedule'])
            ->where('is_online', 0);

        $onlineAppointmentsQuery = Appointment::with(['patient', 'branch', 'dentistSchedule'])
            ->where('is_online', 1);

        if ($request->has('sort')) {
            $sortOption = $request->get('sort');

            if ($sortOption == 'name') {
                $walkinAppointmentsQuery->orderBy('last_name', 'ASC')->orderBy('first_name', 'ASC');
            } elseif ($sortOption == 'appointment_date') {
                $walkinAppointmentsQuery->orderBy('appointment_date', 'ASC');
            } elseif ($sortOption == 'status') {
                $walkinAppointmentsQuery->orderBy('status', 'ASC');
            } elseif ($sortOption == 'branch') {
                $walkinAppointmentsQuery->orderBy('branch_id', 'ASC');
            }

            if ($sortOption == 'name') {
                $onlineAppointmentsQuery->orderBy('last_name', 'ASC')->orderBy('first_name', 'ASC');
            } elseif ($sortOption == 'appointment_date') {
                $onlineAppointmentsQuery->orderBy('appointment_date', 'ASC');
            } elseif ($sortOption == 'status') {
                $onlineAppointmentsQuery->orderBy('status', 'ASC');
            } elseif ($sortOption == 'branch') {
                $onlineAppointmentsQuery->orderBy('branch_id', 'ASC');
            }
        } else {
            $walkinAppointmentsQuery->orderBy('created_at', 'ASC');
            $onlineAppointmentsQuery->orderBy('created_at', 'ASC');
        }

        $walkin_appointments = $walkinAppointmentsQuery->get();
        $online_appointments = $onlineAppointmentsQuery->get();

        return view('content.appointment-submissions', compact('walkin_appointments', 'online_appointments'));
    }




    public function addWalkIn()
    {
        $branches = Branch::all();
        $patients = Patient::all();
        $procedures = Procedure::all();

        return view('appointment.add-walk-in-appointment', [
            'branches' => $branches,
            'patients' => $patients,
            'procedures' => $procedures,
        ]);
    }

    public function addOnline($id)
    {
        $patient = Patient::findOrFail($id);
        $branches = Branch::all();
        $procedures = Procedure::all();

        return view('appointment.add-online-appointment', [
            'branches' => $branches,
            'patient' => $patient,
            'procedures' => $procedures,
        ]);
    }
    


    // public function store1(Request $request)
    // {
        
    //     $request->validate([
    //         'first_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'date_of_birth' => 'required|date',
    //         'phone_number' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'zip_code' => 'required|integer',
    //         'appointment_date' => 'required|date',
    //         'preferred_time' => 'required|string|max:255',
    //         'notes' => 'nullable|string',
    //         'branch' => 'required|string',

    //     ]);

    //     Appointment::create($request->all());

    //     return redirect()->route('appointments.request')->with('success', 'Appointment requested successfully.');
    // }

    public function storeWalkIn(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'patient_id' => 'required',
            'dentist_id' => 'required',
            'branch_id' => 'required',
            'schedule_id' => 'required', // Ensure schedule is valid
            'proc_id' => 'required', // Ensure schedule is valid
            'appointment_date' => 'required|date', // Ensure date is in valid format
            'preferred_time' => 'required', // Ensure the user selects a time slot
            'status' => 'scheduled',
            'pending' => 'pending',
            'is_online' => 'boolean',
        ]);


        // Create the new appointment record
        $appointment = Appointment::create([
            'patient_id' => $validatedData['patient_id'],
            'dentist_id' => $validatedData['dentist_id'],
            'branch_id' => $validatedData['branch_id'],
            'schedule_id' => $validatedData['schedule_id'], // Store the selected schedule
            'proc_id' => $validatedData['proc_id'], // Store the selected procedure
            'appointment_date' => $validatedData['appointment_date'],
            'preferred_time' => $validatedData['preferred_time'], // Store the selected time slot
            'status' => 'scheduled',
            'pending' => 'pending', // Assuming appointments are pending initially
            'is_online' => $validatedData['is_online'],
        ]);

        return redirect()->route('appointment.submission')->with('success', 'Appointment successfully created!');
    }

    public function storeOnline(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'patient_id' => 'required',
            'dentist_id' => 'required',
            'branch_id' => 'required',
            'schedule_id' => 'required', // Ensure schedule is valid
            'proc_id' => 'required', // Ensure schedule is valid
            'appointment_date' => 'required|date', // Ensure date is in valid format
            'preferred_time' => 'required', // Ensure the user selects a time slot
            'status' => 'scheduled',
            'pending' => 'pending',
            'is_online' => 'boolean',
        ]);


        // Create the new appointment record
        $appointment = Appointment::create([
            'patient_id' => $validatedData['patient_id'],
            'dentist_id' => $validatedData['dentist_id'],
            'branch_id' => $validatedData['branch_id'],
            'schedule_id' => $validatedData['schedule_id'], // Store the selected schedule
            'proc_id' => $validatedData['proc_id'], // Store the selected schedule
            'appointment_date' => $validatedData['appointment_date'],
            'preferred_time' => $validatedData['preferred_time'], // Store the selected time slot
            'status' => 'scheduled',
            'pending' => 'pending', // Assuming appointments are pending initially
            'is_online' => $validatedData['is_online'],
        ]);
        $patient = Patient::findOrFail($id);

        return redirect()->route('client.overview', compact('patient'))->with('success', 'Appointment successfully created!');
    }



    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required',
            'dentist_id' => 'required',
            'branch_id' => 'required',
            'proc_id' => 'required',
            'schedule_id' => 'required',
            'appointment_date' => 'required|date',
            'preferred_time' => 'required',
            'status' => 'scheduled',
            'pending' => 'pending',
            'is_online' => 'boolean',
        ]);

        Appointment::create($request->all());
        return redirect()->route('appointment.submission')->with('success', 'Appointment created successfully.');
    }

    /**
     * Fetch dentists based on selected branch via AJAX.
     */
    public function getDentists($branch_id)
    {
        $dentists = Dentist::where('branch_id', $branch_id)->get();
        return response()->json(['dentists' => $dentists]);
    }

    /**
     * Retrieve procedures based on branch selection.
     */
    public function getProcedures($branch_id)
    {
        // Assuming procedures are branch-specific; adjust if necessary
        $procedures = Procedure::where('branch_id', $branch_id)->get();
        return response()->json(['procedures' => $procedures]);
    }

    /**
     * Retrieve schedules based on dentist selection.
     */
    public function getSchedules($dentist_id)
    {
        $schedules = Schedule::where('dentist_id', $dentist_id)
            ->whereDoesntHave('appointment', function ($query) {
                $query->where('status', 'Scheduled');
            })
            ->get();

        return response()->json(['schedules' => $schedules]);
    }


    public function approve($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->Pending = 'Approved';
        $appointment->save();

        Notification::route('mail', $appointment->email)->notify(new AppointmentApproved($appointment));

        return redirect()->back()->with('success', 'Appointment approved and email sent.');
    }

    public function decline($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->Pending = 'Declined';
        $appointment->save();

        Notification::route('mail', $appointment->email)->notify(new AppointmentDeclined($appointment));

        return redirect()->back()->with('success', 'Appointment declined and email sent.');
    }
}
