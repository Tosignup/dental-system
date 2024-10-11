<?php

namespace App\Http\Controllers\clientPanel;

use Auth;
use App\Models\User;
use App\Models\Image;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function dashboard() {
        if(Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif(Auth::user()->role === 'staff') {
            return redirect()->route('staff.dashboard');
        } elseif(Auth::user()->role === 'dentist') {
            return redirect()->route('dentist.dashboard');
        } else {
        return view('client.dashboard');
        }
    }
    
   
    public function profileOverview()
    {
        // Retrieve patient ID from session
        $patientId = session('patient_id');
        // Fetch the patient's details from the database
        $patient = Patient::find($patientId);
        
        $appointments = Appointment::where('patient_id', $patientId)
                                    ->with('procedure')
                                    ->paginate(5);
        
        $appointmentIds = $appointments->pluck('id');

        // Fetch payments related to the patient's appointments
        $payments = Payment::whereIn('appointment_id', $appointmentIds)->paginate(5);
        // Pass the patient data to the profile view
        return view('client.contents.overview', compact('patient', 'appointments', 'payments'));
    }
    
    public function clientRecords($id){

        $xrayImages = Image::where('patient_id', $id)
                ->where('image_type', 'xray')
                ->get();

        $contractImage = Image::where('patient_id', $id)
                ->where('image_type', 'contract')
                ->first();
                
        $backgroundImage = Image::where('patient_id', $id)
                ->where('image_type', 'background')
                ->first();


        return view('client.contents.client-records', compact('xrayImages', 'contractImage', 'backgroundImage'));
    }

    public function createClientPayment($appointmentId) {
        // Retrieve the appointment with related patient and procedure data
        $appointment = Appointment::with(['patient', 'procedure', 'dentist'])->find($appointmentId);


        // Retrieve payment record for the appointment
        $payment = Payment::where('appointment_id', $appointment->id)->first();

        // Calculate total paid and balance remaining
        $totalPaid = $payment ? $payment->total_paid : 0;
        $balanceRemaining = $appointment->procedure->price - $totalPaid;

        return view('client.contents.client-payment-form', compact('appointment', 'payment', 'totalPaid', 'balanceRemaining'));
    }

    public function storeClientPartialPayment(Request $request) {
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
    

    public function showClientPaymentHistory($appointmentId) {
        // Retrieve the appointment with related patient and procedure data
        $appointment = Appointment::with(['patient', 'procedure'])->find($appointmentId);
    
        // Check if the appointment exists
        if (!$appointment) {
            return redirect()->route('appointments.index')->with('error', 'Appointment not found.');
        }
    
        // Retrieve payment history for the appointment
        $paymentHistory = PaymentHistory::whereHas('payment', function($query) use ($appointmentId) {
            $query->where('appointment_id', $appointmentId);
        })->get();
    
        // Calculate total paid and balance remaining
        $totalPaid = $paymentHistory->sum('paid_amount');
        $balanceRemaining = $appointment->procedure->price - $totalPaid;
    
        return view('client.contents.client-payment-history', compact('appointment', 'paymentHistory', 'totalPaid', 'balanceRemaining'));
    }
}
