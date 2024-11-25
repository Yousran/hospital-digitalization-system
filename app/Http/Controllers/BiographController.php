<?php

namespace App\Http\Controllers;

use App\Models\Biograph;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiographController extends Controller
{

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'user_id' => 'nullable|integer',
            'nik' => 'required|string|max:255',
            'surename' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|max:50',
            'address' => 'required|string',
            'religion' => 'required|string|max:100',
            'marriage_status' => 'required|string|max:100',
            'job' => 'required|string|max:100',
            'file_id' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Create or update the biograph
        $biograph = Biograph::create(
            ['user_id' => $validated['user_id'] ?? null],
            [
            'nik' => $validated['nik'],
            'surename' => $validated['surename'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'address' => $validated['address'],
            'religion' => $validated['religion'],
            'marriage_status' => $validated['marriage_status'],
            'job' => $validated['job'],
            'file_id' => $validated['file_id'] ?? null,
            ]
        );

        // Redirect with success message
        return redirect()->back()->with('success', 'Biograph created successfully.');
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'surename' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'religion' => 'required|string|max:255',
            'job' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'gender' => 'required|string|in:laki-laki,perempuan',
            'marriage_status' => 'required|string|max:255',
            'file_id' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'user_id' => 'nullable|integer',
        ]);

        // Cari biografi berdasarkan ID
        $biograph = Biograph::findOrFail($id);

        // Update data biografi
        $biograph->update([
            'user_id' => $validated['user_id'],
            'surename' => $validated['surename'],
            'date_of_birth' => $validated['date_of_birth'],
            'address' => $validated['address'],
            'religion' => $validated['religion'],
            'job' => $validated['job'],
            'nik' => $validated['nik'],
            'gender' => $validated['gender'],
            'marriage_status' => $validated['marriage_status'],
            'file_id' => $validated['file_id'] ?? $biograph->file_id,
        ]);

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->back()->with('success', 'Biografi berhasil diperbarui.');
    }
}
