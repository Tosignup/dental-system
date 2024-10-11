<?php

namespace App\Http\Controllers\patientPanel;

use App\Models\User;
use App\Models\Image;
use App\Models\Branch;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\AuditLog;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{

    public function patient_list(Request $request)
    {
        $patients = Patient::all();
        $patientQuery = Patient::query();

        // Check if the search term exists
        if ($request->has('search') && !empty($request->get('search'))) {
            $searchTerm = $request->get('search');
            $patientQuery->where(function ($query) use ($searchTerm) {
                $query->where('last_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('first_name', 'like', '%' . $searchTerm . '%');
            });
        }

        // Filter by archived status if provided
        if ($request->has('archived')) {
            $archivedStatus = $request->get('archived');
        
            // Show active patients if "false" is selected
            if ($archivedStatus === 'false') {
                $patientQuery->where('is_archived', false);
            }
            // Show archived patients if "true" is selected
            elseif ($archivedStatus === 'true') {
                $patientQuery->where('is_archived', true);
            }
            // Show all patients (no filtering by archived status)
        }
        // Sorting logic
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
            // Default sorting by created date
            $patientQuery->orderBy('created_at', 'ASC');
        }

        // Execute the query and get the results
        $patients = $patientQuery->get();


        $patients = $patientQuery->paginate(10); //to edit


        return view('content.patients', [
            'patients' => $patients,
            'search' => $request->get('search'),
            'archived' => $request->get('archived'),
            'sort' => $request->get('sort')
        ]);
    }
    
    public function addPatient()
    {
        $branches = Branch::all();

        return view('forms.add-patient', compact('branches'));
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
            'branch_id' => 'required|exists:branches,id',
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
            'branch_id' => $request->branch_id,
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
        $branches = Branch::all();

        return view('forms.update-patient', compact('patient', 'branches'));
    }

    public function updatePatient(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|min:3|max:254',
            'last_name' => 'required|min:3|max:254',
            'gender' => 'required',
            'date_of_birth' => 'required|date',
            'fb_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'next_visit' => 'required|date',
            'branch_id' => 'required|exists:branches,id',
        ]);

        $patient->update($validated);
        return redirect()->route('show.patient', compact('patient'))->with('success','patient updated');

    }

    public function patientContract(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $contractImages = Image::where('patient_id', $id)
                        ->where('image_type', 'contract')
                        ->get();
        
        return view('content.patient-contract', compact('patient', 'contractImages'));
    }

    public function patientBackground(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $backgroundImages = Image::where('patient_id', $id)
                        ->where('image_type', 'background')
                        ->get();

        return view('content.patient-background', compact('patient', 'backgroundImages'));
    }
    public function patientXray(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $xrayImages = Image::where('patient_id', $id)
                ->where('image_type', 'xray')
                ->get();

        return view('content.patient-xray', compact('patient', 'xrayImages'));
    }


    //Archiving Patient Data
    public function archivePatient(Request $request, $id)
    {
        $patient = Patient::find($id);
        $patient->is_archived = 1;
        $patient->archived_at = now();  // Mark patient as archived with current timestamp
        $patient->save();

        Appointment::where('patient_id', $id)
        ->update(['is_archived' => 1, 'archived_at' => now()]); // Assuming you have an archived_at field in appointments

        AuditLog::create([
            'action' => 'archive',
            'model_type' => 'DentistSchedule',
            'model_id' => $patient->id,
            'user_id' => auth()->id(),
            'user_email' => auth()->user()->email,
            'changes' => json_encode($request->all()), // Log the request data
        ]);
        
        return redirect()->back()->with('success', 'Patient has been archived.');
    }

    public function restorePatient(Request $request, $id)
    {
        $patient = Patient::find($id);
        $patient->is_archived = 0;   
        $patient->archived_at = null;  // Restore patient by nullifying the archived_at field
        $patient->save();

        Appointment::where('patient_id', $id)
        ->update(['is_archived' => 0, 'archived_at' => null]);

        AuditLog::create([
            'action' => 'restore',
            'model_type' => 'DentistSchedule',
            'model_id' => $patient->id,
            'user_id' => auth()->id(),
            'user_email' => auth()->user()->email,
            'changes' => json_encode($request->all()), // Log the request data
        ]);
        
        return redirect()->back()->with('success', 'Patient has been restored.');
    }


}
