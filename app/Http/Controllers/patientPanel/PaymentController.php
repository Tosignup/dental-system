<?php

namespace App\Http\Controllers\patientPanel;

use Carbon\Carbon;
use App\Models\Patient;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Validate;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function addPayment($id){
        $patient = Patient::findOrFail($id);

        return view('forms.add-payment', compact('patient'));
    }

    public function storePayment(Request $request, Patient $patient)
    {

        $request->validate([
            'tooth_number' => 'nullable|string',
            'dentist' => 'nullable|string',
            'procedure' => 'nullable|string',
            'charge' => 'required|numeric|min:0',
            'paid' => 'required|numeric|min:0',
            'balance_remaining' => 'required|numeric|min:0',
            'remarks' => 'nullable|string',
            'signature' => 'nullable|boolean',
            'payment_date' => 'nullable|date',
        ]);

        $paymentData = $request->all();
        $paymentData['patient_id'] = $patient->id;

        if ($paymentData['balance_remaining'] == 0) {
            $paymentData['status'] = 'done';
        }

        Payment::create($paymentData);
        
        //testing

        $payment = Payment::firstOrNew([
            'patient_id' => $patient->id,
            'procedure' => $request->procedure
        ]);

        $payment->fill($request->all());
        $payment->payment_date = Carbon::now();
        $payment->save();

        PaymentHistory::create([
            'payment_id' => $payment->id,
            'tooth_number' => $request->tooth_number,
            'dentist' => $request->dentist,
            'procedure' => $request->procedure,
            'charge' => $request->charge,
            'paid' => $request->paid,
            'balance_remaining' => $request->balance_remaining,
            'remarks' => $request->remarks,
            'signature' => $request->signature,
            'payment_date' => Carbon::now(),
        ]);
        
        //testing end

        return redirect()->route('show.patient', $patient->id)->with('success', 'Payment recorded successfully.');
    }

    //testing start
    public function testPayment(Request $request, Patient $patient)
    {
        $request->validate([
            'tooth_number' => 'nullable|string',
            'dentist' => 'nullable|string',
            'procedure' => 'nullable|string',
            'charge' => 'required|numeric|min:0',
            'paid' => 'required|numeric|min:0',
            'balance_remaining' => 'required|numeric|min:0',
            'remarks' => 'nullable|string',
            'signature' => 'nullable|boolean',
            'payment_date' => 'nullable|date',
        ]);

        $paymentData = $request->all();
        $paymentData['patient_id'] = $patient->id;

        if ($paymentData['balance_remaining'] == 0) {
            $paymentData['status'] = 'done';
        }

        Payment::create($paymentData);
        
        //testing

        // $payment = Payment::firstOrNew([
        //     'patient_id' => $patient->id,
        //     'procedure' => $request->procedure
        // ]);
        // $payment->fill($request->all());
        // $payment->payment_date = Carbon::now();
        // $payment->save();

        // PaymentHistory::create([
        //     'payment_id' => $payment->id,
        //     'tooth_number' => $request->tooth_number,
        //     'dentist' => $request->dentist,
        //     'procedure' => $request->procedure,
        //     'charge' => $request->charge,
        //     'paid' => $request->paid,
        //     'balance_remaining' => $request->balance_remaining,
        //     'remarks' => $request->remarks,
        //     'signature' => $request->signature,
        //     'payment_date' => Carbon::now(),
        // ]);
        
        //testing end

        return redirect()->route('show.patient', $patient->id)->with('success', 'Payment recorded successfully.');
    }
    //testing end

    public function editPayment(Patient $patient, Payment $payment) 
    {
        return view('forms.update-payment', compact(['patient','payment']));
    }

    public function updatePayment(Request $request, Patient $patient, Payment $payment)
    {
        Log::info('Updating payment', ['patient_id' => $patient->id, 'payment_id' => $payment->id]);

        $request->validate([
            'paid' => 'required|numeric|min:0',
            'remarks' => 'nullable|string',
            'signature' => 'nullable|boolean',
        ]);

        try {
            $payment->paid += $request->input('paid');
            $payment->balance_remaining -= $request->input('paid');
            $payment->remarks = $request->input('remarks');
            $payment->signature = $request->input('signature', false); // Default to false if not present

            $payment->save();

            Log::info('Payment updated successfully', ['payment' => $payment]);
        } catch (\Exception $e) {
            Log::error('Error updating payment', ['message' => $e->getMessage()]);
            return back()->with('error', 'Failed to update payment. Please try again.');
        }

        return redirect()->route('show.patient', $patient->id)->with('success', 'Payment updated successfully.');
    }

    public function testUpPayment(Request $request, $patient_id, $payment_id)
    {
        $request->validate([
            'paid' => 'required|numeric|min:0.01',
            'remarks' => 'nullable|string',
            'signature' => 'required|string|max:255',
        ]);

        $patient = Patient::findOrFail($patient_id);
        $payment = Payment::findOrFail($payment_id);

        try {
            $payment->paid += $request->input('paid');
            $payment->balance_remaining -= $request->input('paid');
            $payment->remarks = $request->input('remarks');
            $payment->signature = $request->input('signature', false); // Default to false if not present

            $payment->save();

            Log::info('Payment updated successfully', ['payment' => $payment]);
        } catch (\Exception $e) {
            Log::error('Error updating payment', ['message' => $e->getMessage()]);
            return back()->with('error', 'Failed to update payment. Please try again.');
        }

        // Update the specified fields
        // $payment->update([
        //     'paid' => $request->paid,
        //     'balance_remaining' => $payment->charge -= $request->paid, // Update the balance_remaining
        //     'remarks' => $request->remarks,
        //     'signature' => $request->signature,
        // ]);

        // Record the payment update in the payment history
        PaymentHistory::create([
            'payment_id' => $payment->id,
            'tooth_number' => $payment->tooth_number,
            'dentist' => $payment->dentist,
            'procedure' => $payment->procedure,
            'charge' => $payment->charge,
            'paid' => $request->paid,
            'balance_remaining' => $payment->charge - $payment->paid,
            'remarks' => $request->remarks,
            'signature' => $request->signature,
            'payment_date' => Carbon::now(),
        ]);

        return redirect()->route('show.patient', $patient->id)->with('success', 'Payment updated successfully.');

    }

    public function showPaymentHistory($patient_id, $payment_id)
    {
        $patient = Patient::findOrFail($patient_id);
        $payment = Payment::with('histories')->findOrFail($payment_id);
        
        return view('content.payment-history', compact('patient', 'payment'));
    }

    
}
