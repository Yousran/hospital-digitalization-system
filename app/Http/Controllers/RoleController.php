<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('pages.manage.roles', compact('roles'));
    }

    public function datatable(Request $request)
    {
        $search = $request->input('search');

        // Jika ada pencarian, filter data berdasarkan nama atau email
        if ($search) {
            $data = Role::where('name', 'LIKE', "%{$search}%")
                        ->orWhere('description', 'LIKE', "%{$search}%")
                        ->get(['id', 'name', 'description', 'badge_colour']);
        } else {
            $data = Role::get(['id', 'name', 'description', 'badge_colour']);
        }


        // Membuat array untuk menyimpan data yang diinginkan
        $result = $data->map(function ($role) {
            return [
                'id' => $role->id,
                'name' => $role->name,
                'description' => $role->description,
                'badge_colour'=> $role->badge_colour,
            ];
        });

        return response()->json([
            'data' => $result,
            'columns' => ['id', 'name', 'description','badge_colour']  // Kolom yang ingin ditampilkan
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
        // Validasi data yang diterima dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'description' => 'nullable|string',
            'badge_colour' => 'nullable|string',
        ]);
        
        // Buat user baru dan login otomatis
        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
            'badge_colour' => $request->badge_colour,
        ]);

        return redirect()->back()->with('message', 'Role registered successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
    
        return view('pages.manage.roles-edit', compact(['role']));
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
            'badge_colour' => 'nullable|string',
        ]);

        // Find the speciality by ID
        $role = Role::findOrFail($id);

        // Update the existing speciality with the validated data
        $role->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'badge_colour' => $validated['badge_colour'],
        ]);

        return redirect()->back()->with('message', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan pengguna berdasarkan ID
        $role = Role::find($id);

        // Periksa apakah pengguna ditemukan
        if (!$role) {
            return redirect()->route('roles.index')->with('error', 'Role not found');
        }

        // Hapus pengguna
        $role->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->back()->with('success', 'Roles deleted successfully');
    }
}
