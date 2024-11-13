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
        //
    }

    public function datatable(Request $request)
    {
        $query = $request->input('query');

        // Jika ada pencarian, filter data berdasarkan nama atau email
        if ($query) {
            $data = Patient::where('id', 'LIKE', "%{$query}%")
                        ->get();
        } else {
            $data = Patient::with('user')->get();
        }

        $columns = $data->isNotEmpty() ? array_keys($data->first()->getAttributes()) : [];

        return response()->json([
            'data' => $data,
            'columns' => $columns
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
    public function edit(Patient $patient)
    {
        //
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
    public function destroy(Patient $patient)
    {
        //
    }
}
