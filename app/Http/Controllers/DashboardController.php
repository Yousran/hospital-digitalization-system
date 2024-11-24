<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $users = User::with('roles:id,name')
                ->get(['id', 'name', 'email'])
                ->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'roles' => $user->roles->pluck('name')->join(' '), // Ubah array menjadi string
                    ];
                });
        $users = new \Illuminate\Database\Eloquent\Collection($users);
        return view('pages.dashboard.index',compact('users'));
    }

    public function chartMedicalRecords()
    {
        $data = DB::table('medical_records')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
    
        return response()->json($data);
    }

    public function fetchActiveUsers()
    {
        $users = User::whereIn(
            'id',
            DB::table('sessions')->pluck('user_id')->toArray()
        )->with('profilPicture')->get();

        return response()->json($users);
    }

    public function fetchActiveDoctors()
    {
        $doctors = User::whereIn(
            'id',
            DB::table('sessions')->pluck('user_id')->toArray()
        )->whereHas('roles', function ($query) {
            $query->where('name', 'dokter');
        })->with('profilPicture')->get();

        return response()->json($doctors);
    }

    public function fetchActivePatients()
    {
        $doctors = User::whereIn(
            'id',
            DB::table('sessions')->pluck('user_id')->toArray()
        )->whereHas('roles', function ($query) {
            $query->where('name', 'pasien');
        })->with('profilPicture')->get();

        return response()->json($doctors);
    }

    public function fetchLatestPatients()
    {
        $doctorId = Auth::user()->doctor->id;

        $latestPatients = Doctor::find($doctorId)
            ->medicalRecords()
            ->with([
                'patient.user:id,name,email,picture', 
                'patient.user.profilPicture:id,path'
            ])
            ->whereHas('patient.user', function ($query) {
                $query->whereNotNull('user_id'); // Pastikan user_id tidak null
            })
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($record) {
                return [
                    'profil_picture' => $record->patient->user->profilPicture,
                    'name' => $record->patient->user->name ?? 'N/A',
                    'email' => $record->patient->user->email ?? 'N/A',
                    'created_at' => $record->created_at->format('Y-m-d H:i:s'),
                ];
            });

        return response()->json($latestPatients);
    }

    public function fetchPatientLatestMedicines()
    {
        $user = Auth::user();
    
        // Pastikan user adalah pasien
        $patient = $user->patient;
    
        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }
    
        // Ambil medical record terbaru
        $latestMedicalRecord = $patient->medicalRecords()->latest()->first();
    
        if (!$latestMedicalRecord) {
            return response()->json(['error' => 'No medical records found'], 404);
        }
    
        // Ambil medicines dari medical record terbaru
        $medicines = $latestMedicalRecord->medicines()
            ->with(['medicinePicture']) // Ambil relasi medicinePicture
            ->withPivot(['quantity', 'description'])
            ->get()
            ->map(function ($medicine) {
                return [
                    'name' => $medicine->name,
                    'type' => $medicine->type,
                    'quantity' => $medicine->pivot->quantity,
                    'prescription_description' => $medicine->pivot->description,
                    'medicine_picture' => $medicine->medicinePicture ? asset('/storage/'.$medicine->medicinePicture->path) : 'https://picsum.photos/200',
                ];
            });
    
        // Format created_at menjadi hanya tanggal
        $formattedCreatedAt = $latestMedicalRecord->created_at->format('Y-m-d');
    
        // Kembalikan data medical record bersama dengan daftar obat-obatan
        return response()->json([
            'diagnosis' => $latestMedicalRecord->diagnosis,
            'created_at' => $formattedCreatedAt,
            'action' => $latestMedicalRecord->action,
            'medicines' => $medicines,
        ]);
    }
    
    public function fetchLatestUnratedMedicalRecord()
    {
        $user = Auth::user();

        // Pastikan user adalah pasien
        $patient = $user->patient;

        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }

        // Ambil medical record terbaru yang belum memiliki rate
        $latestUnratedRecord = $patient->medicalRecords()
            ->whereDoesntHave('rates')
            ->latest()
            ->with(['doctor.user']) // Ambil relasi dengan dokter dan user dokter
            ->first();

        if (!$latestUnratedRecord) {
            return response()->json(['error' => 'No unrated medical records found'], 404);
        }

        return response()->json([
            'id' => $latestUnratedRecord->id,
            'diagnosis' => $latestUnratedRecord->diagnosis,
            'created_at' => $latestUnratedRecord->created_at->format('Y-m-d'),
            'doctor' => [
                'name' => $latestUnratedRecord->doctor->biograph->surename,
                'profile_picture' => $latestUnratedRecord->doctor->user->profilePicture 
                    ? asset($latestUnratedRecord->doctor->user->profilePicture->path) 
                    : 'https://picsum.photos/200', // Gambar default
            ],
        ]);
    }

    public function storeRate(Request $request)
    {
        $validated = $request->validate([
            'medical_record_id' => 'required|exists:medical_records,id',
            'rate' => 'required|integer|min:1|max:5',
        ]);

        $medicalRecord = MedicalRecord::findOrFail($validated['medical_record_id']);

        // Cek apakah sudah ada rate untuk medical record ini
        if ($medicalRecord->rates) {
            return response()->json(['error' => 'Rate already exists for this medical record'], 400);
        }

        // Tambahkan rate
        $rate = $medicalRecord->rates()->create([
            'rate' => $validated['rate'],
        ]);

        // Ambil dokter dari rekam medis
        $doctor = $medicalRecord->doctor;

        if ($doctor) {
            // Hitung rating rata-rata baru untuk dokter
            $doctorRatings = $doctor->medicalRecords()
                ->whereHas('rates') // Ambil rekam medis yang memiliki rate
                ->with('rates')     // Ambil data rate dari setiap rekam medis
                ->get()
                ->pluck('rates.rate'); // Ambil nilai rate saja

            $averageRating = round($doctorRatings->average(), 2); // Hitung rata-rata

            // Update rating dokter
            $doctor->update([
                'rating' => $averageRating,
            ]);
        }

        return response()->json(['message' => 'Rate added successfully', 'rate' => $rate]);
    }

    public function chartUserGender()
    {
        $data = DB::table('biographs')
            ->select(DB::raw('COALESCE(gender, "Not Specified") as gender'), DB::raw('COUNT(*) as total'))
            ->groupBy('gender')
            ->get();

        return response()->json($data);
    }

    public function fetchUpcomingSchedule()
    {
        $user = Auth::user();

        // Check if the user is a doctor
        $doctor = $user->doctor;

        if ($doctor) {
            // Fetch all upcoming schedules for the doctor
            $upcomingSchedules = Schedule::where('doctor_id', $doctor->id)
                ->where('date', '>=', now()->toDateString())
                ->orderBy('date', 'asc')
                ->orderBy('time', 'asc')
                ->with(['patient.user']) // Include the patient user relation
                ->get();

            if ($upcomingSchedules->isEmpty()) {
                return response()->json(['error' => 'No upcoming schedules found'], 404);
            }

            $schedules = $upcomingSchedules->map(function ($schedule) {
                return [
                    'doctor_name' => $schedule->patient->user->name,
                    'date' => \Carbon\Carbon::parse($schedule->date)->format('Y-m-d'),
                    'time' => \Carbon\Carbon::parse($schedule->time)->format('H:i'),
                    'status' => $schedule->status,
                ];
            });

            return response()->json($schedules);
        }

        // Check if the user is a patient
        $patient = $user->patient;

        if ($patient) {
            // Fetch all upcoming schedules for the patient
            $upcomingSchedules = Schedule::where('patient_id', $patient->id)
                ->where('date', '>=', now()->toDateString())
                ->orderBy('date', 'asc')
                ->orderBy('time', 'asc')
                ->with(['doctor.biograph']) // Include the biograph relation
                ->get();

            if ($upcomingSchedules->isEmpty()) {
                return response()->json(['error' => 'No upcoming schedules found'], 404);
            }

            $schedules = $upcomingSchedules->map(function ($schedule) {
                return [
                    'doctor_name' => $schedule->doctor->biograph->surename,
                    'date' => \Carbon\Carbon::parse($schedule->date)->format('Y-m-d'),
                    'time' => \Carbon\Carbon::parse($schedule->time)->format('H:i'),
                    'status' => $schedule->status,
                ];
            });

            return response()->json($schedules);
        }

        return response()->json(['error' => 'User is neither a patient nor a doctor'], 404);
    }
}
