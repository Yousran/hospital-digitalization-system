<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $medicalRecords = MedicalRecord::with([
            'patient.biograph:id,nik,surename',
            'doctor.biograph:id,nik,surename'
        ])
        ->get()
        ->map(function ($record) {
            return [
                'id' => $record->id,
                'patient_surename' => $record->patient->biograph->surename ?? '-', 
                'patient_nik' => $record->patient->biograph->nik ?? '-',
                'doctor_surename' => $record->doctor->biograph->surename ?? '-',
                'doctor_nik' => $record->doctor->biograph->nik ?? '-',
            ];
        });

        $medicalRecords = new \Illuminate\Database\Eloquent\Collection($medicalRecords);

        return view('pages.tables.medical-records.index', compact('medicalRecords'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.tables.medical-records.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'doctor_name' => 'required|string|max:255',
            'patient_surename' => 'required|string|max:255',
            'diagnosis' => 'required|string',
            'action' => 'required|string',
        ]);

        // Retrieve the doctor and patient based on the provided names
        $doctor = Doctor::whereHas('biograph', function ($query) use ($validated) {
            $query->where('surename', $validated['doctor_name']);
        })->first();

        $patient = Patient::whereHas('biograph', function ($query) use ($validated) {
            $query->where('surename', $validated['patient_surename']);
        })->first();

        // Check if the doctor and patient exist
        if (!$doctor) {
            return redirect()->back()->withErrors(['doctor_name' => 'Doctor not found']);
        }

        if (!$patient) {
            return redirect()->back()->withErrors(['patient_surename' => 'Patient not found']);
        }

        // Create the MedicalRecord entry
        MedicalRecord::create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'diagnosis' => $validated['diagnosis'],
            'action' => $validated['action'],
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('message', 'Medical record created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalRecord $medicalRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        // Find the medical record by its ID, including the related doctor and patient
        $medicalRecord = MedicalRecord::with(['doctor.biograph', 'patient.biograph'])->findOrFail($id);
    
        // Return the edit view with the medical record data
        return view('pages.tables.medical-records.edit', compact('medicalRecord'));
    }    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'doctor_name' => 'required|string|max:255',
            'patient_surename' => 'required|string|max:255',
            'diagnosis' => 'required|string',
            'action' => 'required|string',
        ]);
    
        // Find the medical record by its ID
        $medicalRecord = MedicalRecord::findOrFail($id);
    
        // Find the doctor and patient by their names (assumed you want to update them based on names)
        $doctor = Doctor::whereHas('biograph', function ($query) use ($validated) {
            $query->where('surename', $validated['doctor_name']);
        })->first();
    
        $patient = Patient::whereHas('biograph', function ($query) use ($validated) {
            $query->where('surename', $validated['patient_surename']);
        })->first();
    
        // Check if the doctor and patient exist
        if (!$doctor) {
            return redirect()->back()->withErrors(['doctor_name' => 'Doctor not found']);
        }
    
        if (!$patient) {
            return redirect()->back()->withErrors(['patient_surname' => 'Patient not found']);
        }
    
        // Update the medical record with the validated data
        $medicalRecord->update([
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
            'diagnosis' => $validated['diagnosis'],
            'action' => $validated['action'],
        ]);
    
        // Redirect back with a success message
        return redirect()->route('medical-records.index')->with('message', 'Medical record updated successfully');
    }    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan pengguna berdasarkan ID
        $medicalRecord = MedicalRecord::find($id);

        // Periksa apakah pengguna ditemukan
        if (!$medicalRecord) {
            return redirect()->route('medical-records.index')->with('error', 'Medical record not found');
        }

        // Hapus pengguna
        $medicalRecord->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->back()->with('success', 'Medical record deleted successfully');
    }
}
