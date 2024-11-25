<?php

namespace App\Http\Controllers;

use App\Models\Biograph;
use App\Models\Doctor;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'surename' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'religion' => 'required|string|max:100',
            'job' => 'required|string|max:100',
            'nik' => 'required|string|max:255|unique:biographs,nik',
            'gender' => 'required|string|max:50',
            'marriage_status' => 'required|string|max:100',
            'file_id' => 'nullable|integer|exists:files,id',
            'speciality_id' => 'required|integer|exists:specialities,id',
        ]);

        $biograph = Biograph::create([
            'nik' => $validated['nik'],
            'surename' => $validated['surename'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'address' => $validated['address'],
            'religion' => $validated['religion'],
            'marriage_status' => $validated['marriage_status'],
            'job' => $validated['job'],
            'file_id' => $validated['file_id'],
        ]);

        Doctor::create([
            'biograph_id' => $biograph->id,
            'speciality_id' => $validated['speciality_id'],
            'rating' => 0,
        ]);

        return redirect()->back()->with('success', 'Doctor created successfully.');
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
        // $users = User::doesntHave('biograph')->get();
        $users = User::all();
        $specialities = Speciality::all();
        return view('pages.tables.doctors.edit', compact(['doctor','specialities','users']));
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $validated = $request->validate([
            'user_id' => 'nullable|integer|exists:users,id',
            'surename' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'religion' => 'required|string|max:100',
            'job' => 'required|string|max:100',
            'nik' => 'required|string|max:255|unique:biographs,nik,' . $doctor->biograph->id,
            'gender' => 'required|string|max:50',
            'marriage_status' => 'required|string|max:100',
            'file_id' => 'nullable|integer|exists:files,id',
            'speciality_id' => 'required|integer|exists:specialities,id',
        ]);

        $doctor->biograph->update([
            'user_id' => $validated['user_id'],
            'nik' => $validated['nik'],
            'surename' => $validated['surename'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'address' => $validated['address'],
            'religion' => $validated['religion'],
            'marriage_status' => $validated['marriage_status'],
            'job' => $validated['job'],
            'file_id' => $validated['file_id'],
        ]);

        $doctor->update([
            'speciality_id' => $validated['speciality_id'],
            'user_id' => $validated['user_id'],
        ]);

        return redirect()->back()->with('success', 'Doctor updated successfully.');
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
