<?php

namespace App\Http\Controllers\clientPanel;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    protected function authenticated(Request $request, $user)
    {
        // Retrieve the logged user record
        $loggedUser = User::where('email', $request->email)->first();

        if ($loggedUser && $loggedUser->patient_id) {
            // Store the patient ID in session
            session(['patient_id' => $loggedUser->patient_id]);

            // Redirect to client (patient) page
            return redirect()->route('client.dashboard');
        }

        // Handle redirection for other roles (e.g., admin, staff, dentist)
    }
}
