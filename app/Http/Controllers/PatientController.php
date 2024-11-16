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
        return view('pages.tables.patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.tables.patients.create');
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
        return view('pages.tables.patients.edit', compact(['patient']));
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
