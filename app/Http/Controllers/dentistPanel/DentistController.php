<?php

namespace App\Http\Controllers\dentistPanel;

use App\Models\User;
use App\Models\Dentist;
use App\Models\DentistSchedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DentistController extends Controller
{
    public function addDentist()
    {
        return view('forms.add-dentist');
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
            'branch' => 'required|string',
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
            'branch' => $request->branch,
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
}
