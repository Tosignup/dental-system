<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Branch;
use App\Models\Dentist;

use Illuminate\Http\Request;
use App\Models\DentistSchedule;

class ScheduleController extends Controller
{
    public function addSchedule()
    {
        $dentists = Dentist::all();
        $branches = Branch::all();

        return view('forms.add-schedule', compact('dentists', 'branches'));
    }

    public function storeSchedule(Request $request)
    {
        $request->validate([
            'dentist_id' => 'required|exists:dentists,id', // assuming doctors are users
            'branch_id' => 'required|exists:branches,id', // assuming doctors are users
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'appointment_duration' => 'required|integer|min:15', // assuming duration in minutes
        ]);

        // Parse the date and time
        $date = Carbon::parse($request->date);
        $startTime = Carbon::parse($request->date . ' ' . $request->start_time);
        $endTime = Carbon::parse($request->date . ' ' . $request->end_time);

        // Check for overlapping schedules
        $overlappingSchedule = DentistSchedule::where('dentist_id', $request->dentist_id)
            ->whereDate('date', $date)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime, $endTime) {
                    $q->where('start_time', '<', $endTime)
                        ->where('end_time', '>', $startTime);
                });
            })
            ->exists();

        if ($overlappingSchedule) {
            return back()->withErrors([
                'start_time' => 'This schedule overlaps with an existing one.',
                'end_time' => 'This schedule overlaps with an existing one.',
            ])->withInput();
        }

        // Save the schedule if valid
        DentistSchedule::create([
            'dentist_id' => $request->dentist_id,
            'branch_id' => $request->branch_id,
            'date' => $date,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'appointment_duration' => $request->appointment_duration,
        ]);

        return redirect()->route('schedule')->with('success', 'Schedule added successfully.');
    }

    // ORIGINAL SHOW WITH DYNAMIC ID
    // public function show($id)
    // {
    //     $schedule = DentistSchedule::findOrFail($id);

    //     return view('content.schedule-information', compact('schedule'));
    // }


    // DUMMY SHOW FOR FRONT-END TESTING
    public function show()
    {

        return view('content.schedule-information');
    }
}
