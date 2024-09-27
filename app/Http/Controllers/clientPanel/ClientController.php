<?php

namespace App\Http\Controllers\clientPanel;

use Auth;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function dashboard() {
        if(Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif(Auth::user()->role === 'staff') {
            return redirect()->route('staff.dashboard');
        } else {

        return view('client.dashboard');
        }
    }
    // public function profileOverview(){
    //     $patientId = session('patient_id');

    //     // Fetch the patient's details from the database
    //     $patient = Patient::find($patientId);
        
    //     return view('client.contents.overview', compact('patient'));
    // }
   
    public function profileOverview()
    {
        // Retrieve patient ID from session
        $patientId = session('patient_id');

        // Fetch the patient's details from the database
        $patient = Patient::find($patientId);

        // Pass the patient data to the profile view
        return view('client.contents.overview', compact('patient'));
    }
    
    public function profileUserProfile(){
        return view('client.contents.user-profile');
    }
}
