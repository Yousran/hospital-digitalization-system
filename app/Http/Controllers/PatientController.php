<?php

namespace App\Http\Controllers;

use App\Models\Biograph;
use App\Models\Patient;
use App\Models\User;
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
            'relatives' => 'nullable|string|max:255',
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

        Patient::create([
            'biograph_id' => $biograph->id,
            'relative' => $validated['relatives'],
        ]);

        return redirect()->back()->with('success', 'Patient created successfully.');
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
        $users = User::all();
        return view('pages.tables.patients.edit', compact(['patient','users']));
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $validated = $request->validate([
            'surename' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'religion' => 'required|string|max:100',
            'job' => 'required|string|max:100',
            'nik' => 'required|string|max:255|unique:biographs,nik,' . $patient->biograph->id,
            'gender' => 'required|string|max:50',
            'marriage_status' => 'required|string|max:100',
            'file_id' => 'nullable|integer|exists:files,id',
            'relatives' => 'nullable|string|max:255',
        ]);

        $relatives = User::where('name', $validated['relatives'])->first();

        $patient->biograph->update([
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

        $patient->update([
            'relative' => $relatives->id ?? null,
        ]);

        return redirect()->back()->with('success', 'Patient updated successfully.');
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
