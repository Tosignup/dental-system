<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\AppointmentApproved;
use App\Notifications\AppointmentDeclined;
use Illuminate\Support\Facades\Notification;

class AppointmentController extends Controller
{
    public function create()
    {
        return view('appointment.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'zip_code' => 'required|integer',
            'appointment_date' => 'required|date',
            'preferred_time' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'branch' => 'required|string',

        ]);

        Appointment::create($request->all());

        return redirect()->route('appointments.request')->with('success', 'Appointment requested successfully.');
    }

    public function appointment_submission(Request $request){
        $appointments = Appointment::all();
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


    public function approve($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'approved';
        $appointment->save();

        Notification::route('mail', $appointment->email)->notify(new AppointmentApproved($appointment));

        return redirect()->route('appointment.submission')->with('success', 'Appointment approved and email sent.');
    }

    public function decline($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'declined';
        $appointment->save();

        Notification::route('mail', $appointment->email)->notify(new AppointmentDeclined($appointment));

        return redirect()->route('appointment.submission')->with('success', 'Appointment declined and email sent.');
    }
}
