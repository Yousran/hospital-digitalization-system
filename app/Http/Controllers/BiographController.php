<?php

namespace App\Http\Controllers;

use App\Models\Biograph;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiographController extends Controller
{

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'user_id' => 'nullable|integer',
            'nik' => 'required|string|max:255',
            'surename' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|max:50',
            'address' => 'required|string',
            'religion' => 'required|string|max:100',
            'marriage_status' => 'required|string|max:100',
            'job' => 'required|string|max:100',
            'file_id' => 'nullable|integer',
            'speciality_id' => 'nullable|integer',
            'relatives' => 'nullable|string',
        ]);

        $biograph = Biograph::updateOrCreate(
            [
                'user_id' => $request->input('user_id'),
                'nik' => $request->input('nik'),
                'surename' => $request->input('surename'),
                'date_of_birth' => $request->input('date_of_birth'),
                'gender' => $request->input('gender'),
                'address' => $request->input('address'),
                'religion' => $request->input('religion'),
                'marriage_status' => $request->input('marriage_status'),
                'job' => $request->input('job'),
                'file_id' => $request->input('file_id'),
            ]
        );

        // Update speciality if speciality_id is provided
        if (!empty($validated['speciality_id']) && $biograph) {
            Doctor::create(
                [
                    'speciality_id' => $validated['speciality_id'],
                    'biograph_id' => $biograph->id,
                ]);
        }

        // Update patient relatives if patient_id and relatives are provided
        if (!empty($validated['relatives']) && $biograph) {
            $relatives = User::where('name', $validated['relatives'])->first();
            if ($relatives) {
                Patient::create(
                    [
                        'relatives' => $relatives->id,
                        'biograph_id' => $biograph->id,
                    ]);
            } else {
                // Handle the case when no relative is found (optional)
                return redirect()->back()->withErrors(['relatives' => 'Relative not found']);
            }
        }

        // Redirect with success message
        return redirect()->back()->with('success', 'Biograph created successfully.');
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'nik' => 'required|string|max:255',
            'surename' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string',
            'religion' => 'required|string',
            'marriage_status' => 'required|string',
            'job' => 'required|string',
            'file_id' => 'nullable|integer',
            'doctor_id' => 'nullable|integer',
            'speciality_id' => 'nullable|integer',
            'patient_id' => 'nullable|integer',
            'relatives' => 'nullable|string', // Assuming 'relatives' is an ID of another user
        ]);

        // Update speciality if speciality_id is provided
        if (!empty($validated['speciality_id']) && !empty($validated['doctor_id'])) {
            $doctor = Doctor::findOrFail($validated['doctor_id']);
            $doctor->update(['speciality_id' => $validated['speciality_id']]);
        }

        // Update patient relatives if patient_id and relatives are provided
        if (!empty($validated['relatives']) && !empty($validated['patient_id'])) {
            $patient = Patient::findOrFail($validated['patient_id']);
            
            // Find the relative based on the name
            $relatives = User::where('name', $validated['relatives'])->first();  // Use `first()` to get the actual user
            
            if ($relatives) {
                $patient->update(['relatives' => $relatives->id]);
            } else {
                // Handle the case when no relative is found (optional)
                return redirect()->back()->withErrors(['relatives' => 'Relative not found']);
            }
        }

        // Find the biograph entry
        $biograph = Biograph::findOrFail($id);

        // Update the biograph with validated data
        $biograph->update([
            'nik' => $request->input('nik'),
            'surename' => $request->input('surename'),
            'date_of_birth' => $request->input('date_of_birth'),
            'gender' => $request->input('gender'),
            'address' => $request->input('address'),
            'religion' => $request->input('religion'),
            'marriage_status' => $request->input('marriage_status'),
            'job' => $request->input('job'),
            'file_id' => $request->input('file_id'),
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Biograph updated successfully.');
    }
}
