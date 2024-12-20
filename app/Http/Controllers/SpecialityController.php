<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialities = Speciality::all();
        return view('pages.tables.specialities.index', compact('specialities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.tables.specialities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:specialities',
            'description' => 'nullable|string',
        ]);

        // Buat user baru dan login otomatis
        $speciality = Speciality::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('message', 'Speciality registered successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Speciality $speciality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $speciality = Speciality::findOrFail($id);
    
        return view('pages.tables.specialities.edit', compact(['speciality']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:specialities,name,' . $id,
            'description' => 'nullable|string',
        ]);

        // Find the speciality by ID
        $speciality = Speciality::findOrFail($id);

        // Update the existing speciality with the validated data
        $speciality->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        return redirect()->back()->with('message', 'Speciality updated successfully');
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan pengguna berdasarkan ID
        $speciality = Speciality::find($id);

        // Periksa apakah pengguna ditemukan
        if (!$speciality) {
            return redirect()->route('specialities.index')->with('error', 'Speciality not found');
        }

        // Hapus pengguna
        $speciality->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->back()->with('success', 'Speciality deleted successfully');
    }
}
