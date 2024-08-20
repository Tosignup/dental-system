<?php

namespace App\Http\Controllers\patientPanel;

use App\Models\User;
use App\Models\Patient;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function addPatient()
    {
        return view('forms.add-patient');
    }

    public function storePatient(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'email' => 'required|string|email|max:255|unique:patients,email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'nullable|string|max:15',
            'fb_name' => 'required|string|max:255',
            'next_visit' => 'required|date',
        ]);

        // Create patient
        $patient = Patient::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'fb_name' => $request->fb_name,
            'next_visit' => $request->next_visit,
        ]);

        // Create login credentials for the patient in users table
        User::create([
            'username' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'patient_id' => $patient->id, // Link to the patient via foreign key
        ]);

        return redirect()->route('patient_list')->with('success', 'Patient created successfully');
    }
    public function showPatient($id)
    {   
        $patient = Patient::findOrFail($id);

        return view('content.patient-information', compact('patient'));
    }

    public function editPatient($id)
    {
        $patient = Patient::findOrFail($id);

        return view('forms.update-patient', compact('patient'));
    }

    public function updatePatient(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|min:3|max:254',
            'last_name' => 'required|min:3|max:254',
            'gender' => 'required',
            'date_of_birth' => 'required|date',
            'facebook_name' => 'required|string|max:255',
            'package' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'date_of_next_visit' => 'required|date',
            'address' => 'required|string|max:500'
        ]);

        $patient->update($validated);
        return redirect()->route('show_patient', compact('patient'))->with('success','patient updated');

    }
}
