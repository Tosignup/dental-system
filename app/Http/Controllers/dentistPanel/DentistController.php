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
use App\Models\PaymentHistory;
use App\Models\DentistSchedule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DentistController extends Controller
{   
    public function overview($id)
    {
        $dentist = Dentist::find($id);
        
        $today = Carbon::today();


        $totalAppointments = Appointment::count();
        $todayAppointment = Appointment::whereDate('appointment_date', $today)->count();
        $newAppointments = Appointment::whereDate('created_at', $today)->count();

        return view('dentist.contents.overview', compact('totalAppointments', 'newAppointments', 'todayAppointment'));

    }

    public function dentistAppointments($id)
    {
        // Get the logged-in dentist's ID
        $dentist = Dentist::find($id);


        // Fetch pending and approved appointments separately
        $pendingAppointments = Appointment::where('dentist_id', $id)
                                        ->where('pending', 'Pending')
                                        ->where('is_archived', 0)
                                        ->with(['patient', 'procedure', 'branch'])
                                        ->paginate(5, ['*'], 'pending_page'); // Custom pagination query param
        
        $approvedAppointments = Appointment::where('dentist_id', $id)
                                        ->where('pending', 'approved')
                                        ->where('is_archived', 0)
                                        ->with(['patient', 'procedure', 'branch'])
                                        ->paginate(5, ['*'], 'approved_page'); // Custom pagination query param

        $appointmentIds = $pendingAppointments->pluck('id')->merge($approvedAppointments->pluck('id'));

        // Fetch payments related to the dentist's appointments
        $payments = Payment::whereIn('appointment_id', $appointmentIds)->paginate(5, ['*'], 'payment'); // Custom pagination query param
        
        return view('dentist.contents.overview', compact('dentist','pendingAppointments', 'approvedAppointments', 'payments'));
    }

    public function pendingAppointment($id)
    {
        $dentist = Dentist::find($id);


        // Fetch pending and approved appointments separately
        $pendingAppointments = Appointment::where('dentist_id', $id)
                                        ->where('pending', 'Pending')
                                        ->where('is_archived', 0)
                                        ->with(['patient', 'procedure', 'branch'])
                                        ->paginate(5, ['*'], 'pending_page'); // Custom pagination query param

        // $appointmentIds = $pendingAppointments->pluck('id')->get();

        return view('dentist.contents.pending-appointments', compact('dentist','pendingAppointments'));
    }

    public function approvedAppointment($id)
    {
        $dentist = Dentist::find($id);

        $approvedAppointments = Appointment::where('dentist_id', $id)
                                        ->where('pending', 'approved')
                                        ->where('is_archived', 0)
                                        ->with(['patient', 'procedure', 'branch'])
                                        ->paginate(5, ['*'], 'approved_page'); // Custom pagination query param

        return view('dentist.contents.approved-appointments', compact('dentist','approvedAppointments'));

    }
    
    public function appointmentPayment($id)
    {
        // Get the logged-in dentist's ID
        $dentist = Dentist::find($id);
    
        // Check if the dentist exists
        if (!$dentist) {
            return redirect()->back()->with('error', 'Dentist not found.');
        }
    
        // Fetch pending appointments
        $pendingAppointments = Appointment::where('dentist_id', $id)
            ->where('pending', 'Pending')
            ->where('is_archived', 0)
            ->pluck('id');
    
        // Fetch approved appointments
        $approvedAppointments = Appointment::where('dentist_id', $id)
            ->where('pending', 'approved')
            ->where('is_archived', 0)
            ->pluck('id');
    
        // Combine appointment IDs for payments
        $appointmentIds = $pendingAppointments->merge($approvedAppointments);
    
        // Fetch payments related to the dentist's appointments
        $payments = Payment::whereIn('appointment_id', $appointmentIds)->paginate(5, ['*'], 'payment'); // Custom pagination query param
    
        return view('dentist.contents.payment-list', compact('dentist', 'payments'));
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
        $branches = Branch::all();

        return view ('forms.update-dentist', compact('dentist', 'branches'));
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
            'branch_id' => 'required|exists:branches,id',

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
    public function getSchedulesByDentist($dentistId)
    {
        try {
            // Get the current date and time
            $now = Carbon::now();

            // Retrieve only future schedules for the selected dentist
            $schedules = DentistSchedule::where('dentist_id', $dentistId)
                // ->where('date', '>', $now) 
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


    public function showDentistAppointmentInfo($id){
        $appointment = Appointment::find($id);

        return view('dentist.contents.dentist-appointment-information', compact('appointment'));
    }

    public function createDentistPayment($appointmentId) {
        // Retrieve the appointment with related patient and procedure data
        $appointment = Appointment::with(['patient', 'procedure', 'dentist'])->find($appointmentId);

        // Check if the appointment exists
        if (!$appointment) {
            return redirect()->route('appointments.submission')->with('error', 'Appointment not found.');
        }

        // Retrieve payment record for the appointment
        $payment = Payment::where('appointment_id', $appointment->id)->first();

        // Calculate total paid and balance remaining
        $totalPaid = $payment ? $payment->total_paid : 0;
        $balanceRemaining = $appointment->procedure->price - $totalPaid;

        return view('dentist.contents.dentist-payment-form', compact('appointment', 'payment', 'totalPaid'));
    }

    public function storeDentistPartialPayment(Request $request) {
        // Validate the incoming request
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'paid_amount' => 'required|numeric|min:0',
            'password' => 'required|string',
        ]);
    
        // Retrieve the appointment and related payment record
        $appointment = Appointment::with(['procedure', 'patient'])->find($request->appointment_id);
        $payment = Payment::where('appointment_id', $appointment->id)->first();
        
        // Check if the password is correct for the patient
        if (!Hash::check($request->password, $appointment->patient->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password. Please try again.']);
        }
    
        // Payment processing logic...
        $totalPaid = 0;
        $balanceRemaining = $appointment->procedure->price;
        $status = 'pending'; // Initial status
    
        // If a payment record exists, update the values accordingly
        if ($payment) {
            $totalPaid = $payment->total_paid;
            $balanceRemaining = $payment->balance_remaining;
    
            // Check if the new payment exceeds the remaining balance
            if ($request->paid_amount > $balanceRemaining) {
                return redirect()->back()->with('error', 'Payment exceeds the remaining balance of $' . number_format($balanceRemaining, 2));
            }
    
            // Update the total paid and balance remaining
            $totalPaid += $request->paid_amount;
            $balanceRemaining -= $request->paid_amount;
    
            // Determine the payment status
            if ($balanceRemaining <= 0) {
                $status = 'Paid'; // Mark as completed if fully paid
            } else {
                $status = 'Pending'; // Mark as partially paid
            }
    
            // Update the existing payment record
            $payment->update([
                'total_paid' => $totalPaid,
                'balance_remaining' => $balanceRemaining,
                'status' => $status,
            ]);
        } else {
            // If no payment record exists, create a new payment record
            if ($request->paid_amount > $balanceRemaining) {
                return redirect()->back()->with('error', 'Payment exceeds the total amount due of $' . number_format($balanceRemaining, 2));
            }
    
            // Create a new payment record
            $payment = Payment::create([
                'appointment_id' => $request->appointment_id,
                'amount_due' => $appointment->procedure->price,
                'total_paid' => $request->paid_amount,
                'balance_remaining' => $balanceRemaining - $request->paid_amount,
                'status' => 'pending', // Initial status for new payment
            ]);
        }
    
        // (Optional) Create a payment history record for tracking
        PaymentHistory::create([
            'payment_id' => $payment->id,
            'paid_amount' => $request->paid_amount,
            'payment_method' => $request->payment_method,
            'remarks' => $request->remarks ?? null, // Optional remarks
        ]);
        // Return a success response
        // return redirect()->route('show.appointment', $appointment->id)
        //                  ->with('success', 'Payment processed successfully!');
        return response()->json(['success' => true]);
    }

    public function showDentistPaymentHistory($appointmentId) {
        // Retrieve the appointment with related patient and procedure data
        $appointment = Appointment::with(['patient', 'procedure'])->find($appointmentId);
    
        // Check if the appointment exists
        if (!$appointment) {
            return redirect()->route('appointments.submission')->with('error', 'Appointment not found.');
        }
    
        // Retrieve payment history for the appointment using the appointment_id
        $paymentHistory = PaymentHistory::whereHas('payment', function($query) use ($appointmentId) {
            $query->where('appointment_id', $appointmentId);
        })->get();
    
        // Calculate total paid and balance remaining
        $totalPaid = $paymentHistory->sum('paid_amount');
        $balanceRemaining = $appointment->procedure->price - $totalPaid;
    
        return view('dentist.contents.dentist-payment-history', compact('appointment', 'paymentHistory', 'totalPaid', 'balanceRemaining'));
    }

    
}
