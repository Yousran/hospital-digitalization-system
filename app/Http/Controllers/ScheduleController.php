<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ScheduleController extends Controller
{
    public function index()
    {
        $specialities = Speciality::with(['doctors' => function($query) {
            $query->with(['user.profilPicture', 'biograph', 'schedules' => function($q) {
            $q->orderBy('date', 'asc')
             ->orderBy('time', 'asc');
            }]);
        }])->get();
        return view('pages.schedule.index', compact('specialities'));
    }

    public function bookAppointment($id)
    {
        $doctor = Doctor::with(['user', 'biograph', 'schedules' => function($q) {
            $q->orderBy('date', 'asc')
            ->orderBy('time', 'asc');
        }])->find($id);

        if (!$doctor) {
            return redirect()->back();
        }

        $bookedSlots = [];
        if (request()->has('date')) {
            $bookedSlots = Schedule::where('doctor_id', $id)
                ->where('date', request('date'))
                ->pluck('time')
                ->toArray();
        }

        return view('pages.schedule.book-appointment', compact('doctor', 'bookedSlots'));
    }

    public function checkAvailability($doctor_id, $date)
    {
        $bookedSlots = Schedule::where('doctor_id', $doctor_id)
            ->where('date', $date)
            ->pluck('time')
            ->toArray();
        Log::info($bookedSlots);
        return response()->json(['bookedSlots' => $bookedSlots]);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'selected_date' => 'required|date',
            'selected_time' => 'required',
            'doctor_id' => 'required|exists:doctors,id'
        ]);
    
        Schedule::create([
            'doctor_id' => $validated['doctor_id'],
            'patient_id' => Auth::user()->id,
            'date' => $validated['selected_date'],
            'time' => $validated['selected_time'],
            'status' => 'pending'
        ]);
    
        return redirect()->back()
            ->with('success', 'Appointment booked successfully');
    }
}