<?php

namespace App\Http\Controllers;

use App\Models\Biograph;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiographController extends Controller
{

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'nik' => 'required|string|max:255',
            'surename' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|max:50',
            'address' => 'required|string',
            'religion' => 'required|string|max:100',
            'marriage_status' => 'required|string|max:100',
            'job' => 'required|string|max:100',
            'file_id' => 'nullable|integer',
        ]);

        $user_id = Auth::id();

        Biograph::updateOrCreate(
            ['user_id' => $user_id],
            [
                'nik' => $request->input('nik'),
                'surename' => $request->input('surename'),
                'date_of_birth' => $request->input('date_of_birth'),
                'gender' => $request->input('gender'),
                'address' => $request->input('address'),
                'religion' => $request->input('religion'),
                'marriage_status' => $request->input('marriage_status'),
                'job' => $request->input('job'),
                'file_id' => $request->input('file_id'),
            ]
        );

        // Redirect with success message
        return redirect()->back()->with('success', 'Biograph created successfully.');
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'nik' => 'required|string|max:255',
            'surename' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string',
            'religion' => 'required|string',
            'marriage_status' => 'required|string',
            'job' => 'required|string',
            'file_id' => 'nullable|integer',
        ]);

        // Find the biograph entry
        $biograph = Biograph::findOrFail($id);

        // Update the biograph with validated data
        $biograph->update([
            'nik' => $request->input('nik'),
            'surename' => $request->input('surename'),
            'date_of_birth' => $request->input('date_of_birth'),
            'gender' => $request->input('gender'),
            'address' => $request->input('address'),
            'religion' => $request->input('religion'),
            'marriage_status' => $request->input('marriage_status'),
            'job' => $request->input('job'),
            'file_id' => $request->input('file_id'),
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Biograph updated successfully.');
    }
}
