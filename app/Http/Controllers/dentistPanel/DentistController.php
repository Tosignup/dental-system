<?php

namespace App\Http\Controllers\dentistPanel;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Branch;
use App\Models\Dentist;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\DentistSchedule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DentistController extends Controller
{   
    public function overview($id)
    {
        $dentist = Dentist::find($id);
        

        $appointments = Appointment::where('dentist_id', $id)
                                    ->with(['patient']) // Eager load the necessary relationships
                                    ->paginate(5); // Adjust pagination as needed
        

        return view('dentist.contents.overview', compact('dentist', 'appointments'));
    }

    public function dentistAppointments($id)
    {
        // Get the logged-in dentist's ID
        $dentist = Dentist::find($id);


        // Fetch pending and approved appointments separately
        $pendingAppointments = Appointment::where('dentist_id', $id)
                                        ->where('pending', 'Pending')
                                        ->with(['patient', 'procedure', 'branch'])
                                        ->paginate(5, ['*'], 'pending_page'); // Custom pagination query param
        
        $approvedAppointments = Appointment::where('dentist_id', $id)
                                        ->where('pending', 'approved')
                                        ->with(['patient', 'procedure', 'branch'])
                                        ->paginate(5, ['*'], 'approved_page'); // Custom pagination query param

        $appointmentIds = $pendingAppointments->pluck('id')->merge($approvedAppointments->pluck('id'));

        // Fetch payments related to the dentist's appointments
        $payments = Payment::whereIn('appointment_id', $appointmentIds)->paginate(5, ['*'], 'payment'); // Custom pagination query param
        return view('dentist.contents.overview', compact('dentist','pendingAppointments', 'approvedAppointments', 'payments'));
    }


    public function addDentist()
    {
        $branches = Branch::all();
        return view('forms.add-dentist', compact('branches'));
    }

    public function storeDentist(Request $request)
    {
        $request->validate([
            'dentist_first_name' => 'required|string|max:255',
            'dentist_last_name' => 'required|string|max:255',
            'dentist_birth_date' => 'required|date',
            'dentist_email' => 'required|string|email|max:255|unique:users,email',
            'dentist_phone_number' => 'nullable|string|max:15',
            'dentist_gender' => 'nullable|string',
            'password' => 'required|string|min:8|confirmed',
            'dentist_specialization' => 'required|string|max:50',
            'branch_id' => 'required|exists:branches,id',

        ]);

        $dentist = Dentist::create([
            'dentist_first_name' => $request->dentist_first_name,
            'dentist_last_name' => $request->dentist_last_name,
            'dentist_birth_date' => $request->dentist_birth_date,
            'dentist_email' => $request->dentist_email,
            'dentist_gender' => $request->dentist_gender,
            'dentist_phone_number' => $request->dentist_phone_number,
            'password' => Hash::make($request->password),
            'dentist_specialization' => $request->dentist_specialization,
            'branch_id' => $request->branch_id,
        ]);

        User::create([
            'username' => $request->dentist_first_name . ' ' . $request->dentist_last_name,
            'email' => $request->dentist_email,
            'password' => Hash::make($request->password),
            'role' => 'dentist',
            'dentist_id' => $dentist->id, // Link to the patient via foreign key
        ]);

        return redirect()->route('dentist')->with('success', 'Patient created successfully');
    }


    public function editDentist($id){

        $dentist = Dentist::findOrFail($id);

        return view ('forms.update-dentist', compact('dentist'));
    }
    public function updateDentist(Request $request, $id)
    {
        $dentist = Dentist::findOrFail($id);

        $validated = $request->validate([
            'dentist_first_name' => 'required|string|max:255',
            'dentist_last_name' => 'required|string|max:255',
            'dentist_birth_date' => 'required|date',
            'dentist_phone_number' => 'nullable|string|max:15',
            'dentist_specialization' => 'required|string|max:50',
        ]);

        $dentist->update($validated);
        return redirect()->route('dentist', compact('dentist'))->with('success','dentist updated');

    }

    public function showDentist($id)
    {   
        // $dentist = Dentist::findOrFail($id);
        // $schedules = DentistSchedule::with('dentist_schedules')->get($id);

        $dentist = Dentist::with('dentistSchedule')->findOrFail($id);

        return view('content.dentist-information', compact('dentist'));
    }

    public function getDentists($branchId) //w
    {
        try {
            // Fetch dentists associated with the given branch ID
            $dentists = Dentist::where('branch_id', $branchId)->get(['id', 'dentist_last_name', 'dentist_first_name']);
            return response()->json($dentists);
        } catch (\Exception $e) {
            // Log the exception and return a 500 error response
            \Log::error('Error fetching dentists: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch dentists'], 500);
        }
    }

    // Fetch schedules for a specific dentist
    public function getSchedulesByDentist1($dentistId)
    {
        try {
            $schedules = DentistSchedule::where('dentist_id', $dentistId)->get();

            if ($schedules->isEmpty()) {
                return response()->json([], 200);
            }

            return response()->json($schedules, 200);
        } catch (\Exception $e) {
            \Log::error('Error fetching schedules: ' . $e->getMessage());
            return response()->json(['error' => 'Error fetching schedules'], 500);
        }
    }

    public function getSchedulesByDentist($dentistId)
    {
        try {
            // Get the current date and time
            $now = Carbon::now();

            // Retrieve only future schedules for the selected dentist
            $schedules = DentistSchedule::where('dentist_id', $dentistId)
                ->where('date', '>', $now) // Filter out past schedules
                ->get();

            if ($schedules->isEmpty()) {
                return response()->json([], 200);
            }

            return response()->json($schedules, 200);
        } catch (\Exception $e) {
            \Log::error('Error fetching schedules: ' . $e->getMessage());
            return response()->json(['error' => 'Error fetching schedules'], 500);
        }
    }



    public function getAvailableTimeSlots($scheduleId) //w
    {
        // Fetch the schedule for the selected schedule_id
        $schedule = DentistSchedule::find($scheduleId);

        if (!$schedule) {
            return response()->json(['error' => 'No schedule found'], 404);
        }

        // Start and end times from the schedule
        $startTime = new \DateTime($schedule->start_time);
        $endTime = new \DateTime($schedule->end_time);
        $appointmentDuration = $schedule->appointment_duration; // Duration in minutes

        // Array to store time slots
        $timeSlots = [];

        // Generate time slots between start and end time
        while ($startTime < $endTime) {
            $slotStart = clone $startTime;
            $slotEnd = clone $startTime;
            $slotEnd->modify("+{$appointmentDuration} minutes");

            if ($slotEnd <= $endTime) {
                // Format the slot as '08:00 - 08:30'
                $timeSlots[] = $slotStart->format('H:i') . ' - ' . $slotEnd->format('H:i');
            }

            // Move to the next slot
            $startTime = $slotEnd;
        }

        // Return the available time slots as a JSON response
        return response()->json($timeSlots);
    }

    public function getScheduleDetails($scheduleId) //w
    {
        $schedule = DentistSchedule::find($scheduleId);
        return response()->json([
            'date' => $schedule->date
        ]);
    }

    // public function viewPayments(Request $request)
    // {
    //     // Assuming you have a relationship set up in your Dentist model
    //     $dentist = auth()->user()->id; // Get the logged-in dentist's ID

        

    //     return view('dentist.contents.overview', compact('dentist','payments'));
    // }

    
}
