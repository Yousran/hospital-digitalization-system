<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();
        return view('pages.manage.patients', compact('patients'));
    }

    public function datatable(Request $request)
    {
        $search = $request->input('search');

        // Fetch data with relationships and filtering if a search term is provided
        if ($search) {
            $data = Patient::with(['biograph']) // Load user and biograph relationships
                        ->whereHas('biograph', function ($query) use ($search) {
                            $query->where('nik', 'LIKE', "%{$search}%")
                                ->orWhere('surename', 'LIKE', "%{$search}%");
                        })
                        ->get();
        } else {
            $data = Patient::with(['biograph'])->get();
        }

        // Format response
        $result = $data->map(function ($patient) {
            return [
                'id' => $patient->id,
                'name' => optional($patient->user)->name,
                'surename' => optional($patient->biograph)->surename,
                'nik' => optional($patient->biograph)->nik,
                'gender' => optional($patient->biograph)->gender,
                'date_of_birth' => optional($patient->biograph)->date_of_birth,
            ];
        });

        return response()->json([
            'data' => $result,
            'columns' => ['id', 'name', 'surename', 'nik', 'gender', 'date_of_birth']
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
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $patient = Patient::with('relative')->findOrFail($id);
        return view('pages.manage.patients-edit', compact(['patient']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Temukan pengguna berdasarkan ID
        $patient = Patient::find($id);

        // Periksa apakah pengguna ditemukan
        if (!$patient) {
            return redirect()->route('patients.index')->with('error', 'Patient not found');
        }

        // Hapus pengguna
        $patient->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->back()->with('success', 'Patient deleted successfully');
    }
}
