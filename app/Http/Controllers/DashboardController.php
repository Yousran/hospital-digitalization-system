<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
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

}
