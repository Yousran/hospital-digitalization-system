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
        $doctors = Doctor::with(['biograph','speciality'])->get();
        $specialities = Speciality::all();
        return view('pages.manage.doctors',compact('doctors', 'specialities'));
    }

    public function datatable(Request $request)
    {
        $search = $request->input('search');

        // Fetch data with relationships and filtering if a search term is provided
        $query = Doctor::with(['user', 'biograph', 'speciality']); // Include related models

        if ($search) {
            $data = Doctor::with(['biograph', 'speciality'])
                    ->when($search, function ($query) use ($search) {
                        $query->whereHas('biograph', function ($q) use ($search) {
                            $q->where('nik', 'LIKE', "%{$search}%")
                              ->orWhere('surename', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('speciality', function ($q) use ($search) {
                            $q->where('name', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('user', function ($q) use ($search) {
                            $q->where('name', 'LIKE', "%{$search}%");
                        });
                    })
                    ->get();
        }else {
            $data = $query->get();
        }


        // Format response
        $result = $data->map(function ($doctor) {
            return [
                'id' => $doctor->id,
                'name' => optional($doctor->user)->name,
                'speciality' => optional($doctor->speciality)->name,
                'surename' => optional($doctor->biograph)->surename,
                'nik' => optional($doctor->biograph)->nik,
                'rating' => $doctor->rating,
            ];
        });

        return response()->json([
            'data' => $result,
            'columns' => ['id', 'name', 'speciality', 'surename', 'nik', 'rating']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        return view('pages.manage.doctors-edit', compact(['doctor','specialities']));
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
