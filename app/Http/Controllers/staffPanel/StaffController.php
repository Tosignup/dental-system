<?php

namespace App\Http\Controllers\staffPanel;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Staff;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function overview()
    {
        $today = Carbon::today();

        $totalPatients = Patient::count();
        $newPatients = Patient::whereDate('created_at', $today)->count();
        $todayPatients = Patient::whereDate('next_visit', $today)->count();

        $totalAppointments = Appointment::count();
        $todayAppointment = Appointment::whereDate('appointment_date', $today)->count();
        $newAppointments = Appointment::whereDate('created_at', $today)->count();

        return view('content.overview', compact('totalPatients', 'newPatients', 'todayPatients', 'totalAppointments', 'newAppointments', 'todayAppointment'));

        // return view('content.overview');
    }

    

    public function addStaff()
    {
        return view('forms.add-staff');
    }

    public function storeStaff(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone_number' => 'nullable|string|max:15',
            'gender' => 'nullable|string',
            'fb_name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'branch_id' => 'required|exists:branches,id',
        ]);

        $staff = Staff::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'gender' => $request->gender,
            'fb_name' => $request->fb_name,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'branch_id' => $request->branch_id,
        ]);

        User::create([
            'username' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff',
            'staff_id' => $staff->id, // Link to the patient via foreign key
        ]);

        return redirect()->route('staff')->with('success', 'Patient created successfully');
    }

    public function editStaff($id){

        $staff = Staff::findOrFail($id);

        return view ('forms.update-staff', compact('staff'));
    }
    public function updateStaff(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'fb_name' => 'required|string|max:255',
            'branch_id' => 'required|exists:branches,id',

        ]);

        $staff->update($validated);
        return redirect()->route('staff', compact('staff'))->with('success','staff updated');

    }

    public function showStaff($id)
    {   
        $staff = Staff::findOrFail($id);
        // $schedules = staffSchedule::with('staff_schedules')->get($id);

        // $staff = staff::with('staffSchedule')->findOrFail($id);

        return view('content.staff-information', compact('staff'));
    }
}
