<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function store(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Handle the uploaded file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            
            // Store the file in the 'uploads' directory of the public disk
            $path = $file->store('uploads', 'public');
            
            // Create a new record in the files table
            $fileRecord = File::create([
                'name' => $file->getClientOriginalName(),
                'category' => 'General', // You can modify this if needed
                'path' => $path,
                'alt' => $file->getClientOriginalName(), // You can add more metadata here
            ]);

            return response()->json(['success' => true, 'file' => $fileRecord]);
        }

        return response()->json(['success' => false, 'message' => 'No file uploaded.']);
    }
}
