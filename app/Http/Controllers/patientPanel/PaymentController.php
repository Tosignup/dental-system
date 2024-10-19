<?php

namespace App\Http\Controllers\patientPanel;

use Carbon\Carbon;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\AuditLog;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Validate;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PaymentController extends Controller
{
   
    public function create($appointmentId)
    {
        $appointment = Appointment::with(['patient', 'procedure', 'dentist'])->find($appointmentId);

        if (!$appointment) {
            return redirect()->route('appointments.submission')->with('error', 'Appointment not found.');
        }

        $payment = Payment::where('appointment_id', $appointment->id)->first();

        $totalPaid = $payment ? $payment->total_paid : 0;
        $balanceRemaining = $appointment->procedure->price - $totalPaid;

        return view('admin.forms.payment-form', compact('appointment', 'payment', 'totalPaid', 'balanceRemaining'));
        session()->flash('success', 'Payment added successfully!');
    }

    public function showPaymentHistory($appointmentId)
    {
        $appointment = Appointment::with(['patient', 'procedure'])->find($appointmentId);

        if (!$appointment) {
            return redirect()->route('appointments.submission')->with('error', 'Appointment not found.');
        }

        $paymentHistory = PaymentHistory::whereHas('payment', function ($query) use ($appointmentId) {
            $query->where('appointment_id', $appointmentId);
        })->get();

        $totalPaid = $paymentHistory->sum('paid_amount');
        $balanceRemaining = $appointment->procedure->price - $totalPaid;

        return view('admin.forms.payment-history', compact('appointment', 'paymentHistory', 'totalPaid', 'balanceRemaining'));
    }

    public function storePartialPayment(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'paid_amount' => 'required|numeric|min:0',
            'password' => 'required|string',
        ]);

        $appointment = Appointment::with(['procedure', 'patient'])->find($request->appointment_id);
        $payment = Payment::where('appointment_id', $appointment->id)->first();

        if (!Hash::check($request->password, $appointment->patient->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password. Please try again.']);
        }

        $totalPaid = 0;
        $balanceRemaining = $appointment->procedure->price;
        if ($balanceRemaining <= 0) {
            $status = 'Paid';
        } else {
            $status = 'Pending';
        };

        if ($payment) {
            $totalPaid = $payment->total_paid;
            $balanceRemaining = $payment->balance_remaining;

            if ($request->paid_amount > $balanceRemaining) {
                return redirect()->back()->with('error', 'Payment exceeds the remaining balance of $' . number_format($balanceRemaining, 2));
            }

            $totalPaid += $request->paid_amount;
            $balanceRemaining -= $request->paid_amount;

            if ($balanceRemaining <= 0) {
                $status = 'Paid';
            } else {
                $status = 'Pending';
            }

            $payment->update([
                'total_paid' => $totalPaid,
                'balance_remaining' => $balanceRemaining,
                'status' => $status,
            ]);
        } else {
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

        AuditLog::create([
            'action' => 'Payment',
            'model_type' => 'New payment added',
            'model_id' => $payment->id,
            'user_id' => auth()->id(),
            'user_email' => auth()->user()->email,
            'changes' => json_encode($request->all()),
        ]);
        // Return a success response
        // return redirect()->route('show.appointment', $appointment->id)
        //                  ->with('success', 'Payment processed successfully!');
        return response()->json(['success' => true]);
    }

    public function paymentList($id)
    {
        $patientId = Appointment::find($id);
        $payments = Appointment::where('patient_id', $id)
                                    ->where('pending', 'Approved')
                                    ->with(['procedure', 'dentist', 'payment'])
                                    ->paginate(5);
        
        // $payments = $payment->pluck('id');

        return view('client.patients.patient-payment-list', compact('payments'));
    }
}
