<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorizedMedicalRecordController extends Controller
{
    public function patient()
    {
        // Mengambil ID pengguna yang sedang login
        $user = Auth::user();

        // Query untuk mengambil medical records yang terkait dengan doctor
        $medicalRecords = MedicalRecord::with([
                'patient.biograph:id,nik,surename',
                'doctor.biograph:id,nik,surename'
            ])
            ->whereHas('patient', function ($query) use ($user) {
                // Menyaring berdasarkan biograph yang terkait dengan user yang login
                $query->where('user_id', $user->id); // sesuaikan dengan kolom yang berhubungan dengan pengguna
            })
            ->get()
            ->map(function ($record) {
                return [
                    'id' => $record->id,
                    'diagnosis' => $record->diagnosis ?? '-', 
                    'action' => $record->action ?? '-',
                ];
            });

        // Mengonversi ke koleksi jika perlu
        $medicalRecords = new \Illuminate\Database\Eloquent\Collection($medicalRecords);

        // Mengembalikan view dengan data medical records yang sudah difilter
        return view('pages.medical-records.index', compact('medicalRecords'));
    }

    public function doctor()
    {
        // Mengambil ID pengguna yang sedang login
        $user = Auth::user();

        // Query untuk mengambil medical records yang terkait dengan doctor
        $medicalRecords = MedicalRecord::with([
                'patient.biograph:id,nik,surename',
                'doctor.biograph:id,nik,surename'
            ])
            ->whereHas('doctor', function ($query) use ($user) {
                // Menyaring berdasarkan biograph yang terkait dengan user yang login
                $query->where('user_id', $user->id); // sesuaikan dengan kolom yang berhubungan dengan pengguna
            })
            ->get()
            ->map(function ($record) {
                return [
                    'id' => $record->id,
                    'patient_surename' => $record->patient->biograph->surename ?? '-', 
                    'patient_nik' => $record->patient->biograph->nik ?? '-',
                ];
            });

        // Mengonversi ke koleksi jika perlu
        $medicalRecords = new \Illuminate\Database\Eloquent\Collection($medicalRecords);

        // Mengembalikan view dengan data medical records yang sudah difilter
        return view('pages.medical-records.index', compact('medicalRecords'));
    }

}
