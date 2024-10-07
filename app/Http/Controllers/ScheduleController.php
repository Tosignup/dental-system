<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Branch;
use App\Models\Dentist;
use App\Models\AuditLog;
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

    //Working with original approach
    public function storeSchedule1(Request $request)
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
             ->where(function($query) use ($startTime, $endTime) {
                 $query->where(function($q) use ($startTime, $endTime) {
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

    public function editSchedule($id)
    {
        $schedule = DentistSchedule::with('dentist')->findOrFail($id);

        return view('dentist.form.edit-schedule', compact('schedule'));
    }

    public function updateSchedule1(Request $request, $id)
    {
        $schedule = DentistSchedule::findOrFail($id);

        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'appointment_duration' => 'required|integer|min:15',
        ]);

         // Parse the date and time
         $date = Carbon::parse($request->date);
         $startTime = Carbon::parse($request->date . ' ' . $request->start_time);
         $endTime = Carbon::parse($request->date . ' ' . $request->end_time);
 
         // Check for overlapping schedules
         $overlappingSchedule = DentistSchedule::where('dentist_id', $request->dentist_id)
             ->whereDate('date', $date)
             ->where(function($query) use ($startTime, $endTime) {
                 $query->where(function($q) use ($startTime, $endTime) {
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
         $schedule->update([
             'date' => $date,
             'start_time' => $startTime,
             'end_time' => $endTime,
             'appointment_duration' => $request->appointment_duration,
         ]);
 
         return redirect()->route('schedule')->with('success', 'Schedule added successfully.');
    }

    public function deleteSchedule1($id)
    {
        // Find the schedule by ID or fail
        $schedule = DentistSchedule::findOrFail($id);

        // Delete the schedule
        $schedule->delete();

        // Redirect back with a success message
        return redirect()->route('schedule')->with('success', 'Schedule deleted successfully.');
    }

    //All testing functions

    //Working with JS approach
    public function storeSchedule(Request $request)
    {
        $request->validate([
            'dentist_id' => 'required|exists:dentists,id',
            'branch_id' => 'required|exists:branches,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'appointment_duration' => 'required|integer|min:15',
            'selected_dates' => 'required|json', // Expecting a JSON array of dates
        ]);

        // Decode the JSON array of selected dates
        $selectedDates = json_decode($request->selected_dates, true);

        // Loop through each selected date
        foreach ($selectedDates as $dateString) {
            $date = Carbon::parse($dateString);
            $startTime = Carbon::parse($dateString . ' ' . $request->start_time);
            $endTime = Carbon::parse($dateString . ' ' . $request->end_time);

            // Check for overlapping schedules
            $overlappingSchedule = DentistSchedule::where('dentist_id', $request->dentist_id)
                ->whereDate('date', $date)
                ->where(function($query) use ($startTime, $endTime) {
                    $query->where(function($q) use ($startTime, $endTime) {
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

            // Save the schedule for the specific date
            DentistSchedule::create([
                'dentist_id' => $request->dentist_id,
                'branch_id' => $request->branch_id,
                'date' => $date,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'appointment_duration' => $request->appointment_duration,
            ]);
        }

        return redirect()->route('schedule')->with('success', 'Schedules added successfully.');
    }

    //Working with Checkboxes approach
    public function storeSchedule111(Request $request)
    {
        $request->validate([
            'dentist_id' => 'required|exists:dentists,id',
            'branch_id' => 'required|exists:branches,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'appointment_duration' => 'required|integer|min:15',
            'base_date' => 'required|date', // Base date for scheduling
            'days_of_week' => 'required|array', // Selected days of the week
            'days_of_week.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday', // Valid days
        ]);

        // Parse the base date
        $baseDate = Carbon::parse($request->base_date);

        // Loop through each selected day of the week
        foreach ($request->days_of_week as $day) {
            // Calculate the date for the specific day of the week
            $dayOfWeek = Carbon::parse($day);
            $daysToAdd = ($dayOfWeek->dayOfWeek - $baseDate->dayOfWeek + 7) % 7; // Calculate days to add
            $scheduleDate = $baseDate->copy()->addDays($daysToAdd); // Get the correct date for the day of the week

            // Create start and end time for the schedule
            $startTime = Carbon::parse($scheduleDate->toDateString() . ' ' . $request->start_time);
            $endTime = Carbon::parse($scheduleDate->toDateString() . ' ' . $request->end_time);

            // Check for overlapping schedules
            $overlappingSchedule = DentistSchedule::where('dentist_id', $request->dentist_id)
                ->whereDate('date', $scheduleDate)
                ->where(function($query) use ($startTime, $endTime) {
                    $query->where(function($q) use ($startTime, $endTime) {
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

            // Save the schedule for the specific day
            DentistSchedule::create([
                'dentist_id' => $request->dentist_id,
                'branch_id' => $request->branch_id,
                'date' => $scheduleDate,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'appointment_duration' => $request->appointment_duration,
            ]);
        }

        return redirect()->route('schedule')->with('success', 'Schedules added successfully.');
    }

    //Working with Date Range Picker Approach
    public function storeSchedule11(Request $request)
    {
        $request->validate([
            'dentist_id' => 'required|exists:dentists,id',
            'branch_id' => 'required|exists:branches,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'appointment_duration' => 'required|integer|min:15',
            'start_date' => 'required|date', // Start date for scheduling
            'end_date' => 'required|date|after_or_equal:start_date', // End date for scheduling
        ]);

        // Parse the start and end dates
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        // Loop through each date in the range
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            // Create start and end time for the schedule
            $scheduleStartTime = Carbon::parse($date->toDateString() . ' ' . $request->start_time);
            $scheduleEndTime = Carbon::parse($date->toDateString() . ' ' . $request->end_time);

            // Check for overlapping schedules
            $overlappingSchedule = DentistSchedule::where('dentist_id', $request->dentist_id)
                ->whereDate('date', $date)
                ->where(function($query) use ($scheduleStartTime, $scheduleEndTime) {
                    $query->where(function($q) use ($scheduleStartTime, $scheduleEndTime) {
                        $q->where('start_time', '<', $scheduleEndTime)
                        ->where('end_time', '>', $scheduleStartTime);
                    });
                })
                ->exists();

            if ($overlappingSchedule) {
                return back()->withErrors([
                    'start_time' => 'This schedule overlaps with an existing one.',
                    'end_time' => 'This schedule overlaps with an existing one.',
                ])->withInput();
            }

            // Save the schedule for the specific day
            DentistSchedule::create([
                'dentist_id' => $request->dentist_id,
                'branch_id' => $request->branch_id,
                'date' => $date,
                'start_time' => $scheduleStartTime,
                'end_time' => $scheduleEndTime,
                'appointment_duration' => $request->appointment_duration,
            ]);
        }

        return redirect()->route('schedule')->with('success', 'Schedules added successfully.');
    }



    //AuditLog Testing
    public function storeSchedule2(Request $request)
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
             ->where(function($query) use ($startTime, $endTime) {
                 $query->where(function($q) use ($startTime, $endTime) {
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
         $schedule = DentistSchedule::create([
             'dentist_id' => $request->dentist_id,
             'branch_id' => $request->branch_id,
             'date' => $date,
             'start_time' => $startTime,
             'end_time' => $endTime,
             'appointment_duration' => $request->appointment_duration,
         ]);

         // Log the action
    AuditLog::create([
        'action' => 'create',
        'model_type' => 'DentistSchedule',
        'model_id' => $schedule->id,
        'user_id' => auth()->id(),
        'changes' => json_encode($request->all()), // Log the request data
    ]);
 
         return redirect()->route('schedule')->with('success', 'Schedule added successfully.');
    }


    public function updateSchedule(Request $request, $id)
    {
        $schedule = DentistSchedule::findOrFail($id);

        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'appointment_duration' => 'required|integer|min:15',
        ]);

         // Parse the date and time
         $date = Carbon::parse($request->date);
         $startTime = Carbon::parse($request->date . ' ' . $request->start_time);
         $endTime = Carbon::parse($request->date . ' ' . $request->end_time);
 
         // Check for overlapping schedules
         $overlappingSchedule = DentistSchedule::where('dentist_id', $request->dentist_id)
             ->whereDate('date', $date)
             ->where(function($query) use ($startTime, $endTime) {
                 $query->where(function($q) use ($startTime, $endTime) {
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
         $schedule->update([
             'date' => $date,
             'start_time' => $startTime,
             'end_time' => $endTime,
             'appointment_duration' => $request->appointment_duration,
         ]);

          // Log the action
    AuditLog::create([
        'action' => 'update',
        'model_type' => 'DentistSchedule',
        'model_id' => $schedule->id,
        'user_id' => auth()->id(),
        'changes' => json_encode($request->all()), // Log the request data
    ]);
 
         return redirect()->route('schedule')->with('success', 'Schedule added successfully.');
    }

    public function deleteSchedule($id)
    {
        // Find the schedule by ID or fail
        $schedule = DentistSchedule::findOrFail($id);
        
        // Log the action
        AuditLog::create([
            'action' => 'delete',
            'model_type' => 'DentistSchedule',
            'model_id' => $schedule->id,
            'user_id' => auth()->id(),
            'changes' => 'Schedule Deleted', // No changes to log for deletion
        ]);

        // Delete the schedule
        $schedule->delete();

        // Redirect back with a success message
        return redirect()->route('schedule')->with('success', 'Schedule deleted successfully.');
    }
    
 }
