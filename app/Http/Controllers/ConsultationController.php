<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ConsultationController extends Controller
{
    public function index()
    {
        return view('pages.consultation.index');
    }

    public function addMedicine(Request $request)
    {
        $medicineName = $request->input('name');
    
        // Cari medicine berdasarkan nama dengan relasi medicinePicture
        $medicine = Medicine::with('medicinePicture')->where('name', $medicineName)->first();
    
        // Pastikan medicine ditemukan
        if (!$medicine) {
            return response()->json(['error' => 'Medicine not found'], 404);
        }
    
    
        // Render komponen medicine-card
        $html = view('components.medicine-card', compact('medicine'))->render();
    
        // Kembalikan HTML sebagai respon
        return response($html);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_nik' => 'required|exists:biographs,nik',
            'diagnosis' => 'required|string',
            'action' => 'required|string',
            'medicines' => 'nullable|array',
            'medicines.*' => 'exists:medicines,id',  // Check if each medicine_id exists in the medicines table
            'quantity' => 'nullable|array',
            'quantity.*' => 'integer|min:1',
        ]);

        $patient = Patient::whereHas('biograph', function ($query) use ($validated) {
            $query->where('nik', '=', $validated['patient_nik']);
        })->first();

        $doctor = Doctor::where('user_id', Auth::id())->first();
        
        // Step 2: Create a new medical record
        $medicalRecord = MedicalRecord::create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'diagnosis' => $validated['diagnosis'],
            'action' => $validated['action'],
        ]);

        // Step 3: Process medicines and quantities for recipe entries if medicines are provided
        $medicines = $validated['medicines'] ?? [];
        $quantities = $validated['quantity'] ?? [];

        if (!empty($medicines)) {
            foreach ($medicines as $index => $medicineId) {
                Recipe::create([
                    'medicine_id' => $medicineId,
                    'medical_record_id' => $medicalRecord->id,
                    'quantity' => $quantities[$index] ?? 1,
                    'description' => 'Enter a default or specific description', // Adjust as necessary
                ]);
            }
        }
        return redirect()->route('consultation')->with('success', 'Consultation record saved successfully.');
    }


}
