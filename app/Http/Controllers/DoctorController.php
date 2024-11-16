<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Speciality;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::with(['biograph', 'speciality'])
            ->get(['id','speciality_id', 'biograph_id']) // Ambil hanya kolom yang dibutuhkan dari tabel doctors
            ->map(function ($doctor) {
                return [
                    'id' => $doctor->id,
                    'surename' => $doctor->biograph->surename ?? '-', // Tampilkan default jika biograph tidak ada
                    'nik' => $doctor->biograph->nik ?? '-', // Tampilkan default jika nik tidak ada
                    'speciality' => $doctor->speciality->name ?? '-', // Tampilkan default jika speciality tidak ada
                ];
            });
    
        $doctors = new \Illuminate\Database\Eloquent\Collection($doctors); // Pastikan koleksi kompatibel dengan Laravel Collection
        return view('pages.tables.doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialities = Speciality::all();
        return view('pages.tables.doctors.create',compact('specialities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $specialities = Speciality::all();
        return view('pages.tables.doctors.edit', compact(['doctor','specialities']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Temukan pengguna berdasarkan ID
        $doctor = Doctor::find($id);

        // Periksa apakah pengguna ditemukan
        if (!$doctor) {
            return redirect()->route('doctors.index')->with('error', 'Doctor not found');
        }

        // Hapus pengguna
        $doctor->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->back()->with('success', 'Doctor deleted successfully');
    }
}
