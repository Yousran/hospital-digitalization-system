<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicines = Medicine::with('medicinePicture')->get();
        return view('pages.medicines.index',compact('medicines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.medicines.create');
    }
    
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string',
            'stock' => 'required|integer',
            'file_id' => 'nullable|exists:files,id',
        ]);
    
        // Buat medicine baru
        $medicine = Medicine::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'type' => $validated['type'],
            'stock' => $validated['stock'],
            'picture' => $validated['file_id'],
        ]);
    
        // Redirect ke halaman index setelah sukses membuat data medicine
        return redirect()->route('medicines.index')->with('success', 'Medicine created successfully.');
    }
    
    
    public function edit($id)
    {
        $medicine = Medicine::findOrFail($id);
        return view('pages.medicines.edit', compact('medicine'));
    }
    
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:medicines,name,' . $id,
            'description' => 'nullable|string',
            'type' => 'required|string',
            'stock' => 'required|integer',
            'file_id' => 'nullable|exists:files,id',
        ]);
    
        // Temukan dan perbarui informasi medicine
        $medicine = Medicine::findOrFail($id);
        $medicine->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'type' => $validated['type'],
            'stock' => $validated['stock'],
        ]);

        if ($validated['file_id']) {
            $medicine->update(['picture' => $validated['file_id']]);
        }
    
        // Redirect ke halaman index setelah sukses memperbarui data medicine
        return redirect()->route('medicines.index')->with('success', 'Medicine updated successfully.');
    }
      

    public function updateStock(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer',
            'stock' => 'required|integer|min:1|max:9999',
        ]);
        
        $medicine = Medicine::findOrFail($validated['id']);
        $medicine->stock = $validated['stock'];
        $medicine->save();

        return response()->json(['success' => true, 'message' => 'Stock updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Temukan pengguna berdasarkan ID
        $medicine = Medicine::find($id);

        // Periksa apakah pengguna ditemukan
        if (!$medicine) {
            return redirect()->route('medicines.index')->with('error', 'Medicine not found');
        }

        // Hapus pengguna
        $medicine->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->back()->with('success', 'User deleted successfully');
    }
}
