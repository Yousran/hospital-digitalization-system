<?php

namespace App\Http\Controllers;

use App\Models\Biograph;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('pages.manage.users', compact('users'));
    }

    // public function datatable(){
    //     $users = User::all()->first();
    //     return compact('users');
    // }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $data = User::where('name', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%")
                    ->get();

        $columns = !empty($data) ? array_keys($data->first()->getAttributes()) : [];
        return view('components.datatable-content', [
            'data' => $data,
            'columns' => $columns,
            'routeDelete' => 'users.destroy'
        ])->render();

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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'file_id' => 'nullable|integer',
            
        ]);

        // Buat user baru dan login otomatis
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'picture' => $request->file_id,
        ]);

        $roles = UserRole::create([
            'user_id' => $user->id,
            'role_id' => 3,
        ]);

        // Redirect ke halaman utama setelah sukses registrasi
        return redirect()->back()->with('message', 'User registered successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'current_password' => 'required|string',
            'password' => 'nullable|string|min:8|confirmed',
            'file_id' => 'nullable|integer',
        ]);

        $user = User::findOrFail($id);

        // Cek apakah password lama sesuai
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Data untuk update
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'picture' => $request->file_id,
        ];

        // Cek jika password baru diisi dan sesuai konfirmasi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password); // Hash password baru
        }

        // Update user
        $user->update($data);

        return redirect()->back()->with('message', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Temukan pengguna berdasarkan ID
        $user = User::find($id);

        // Periksa apakah pengguna ditemukan
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found');
        }

        // Hapus pengguna
        $user->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->back()->with('success', 'User deleted successfully');
    }

    public function showProfile($username)
    {
        $user = User::with(['roles', 'doctor', 'profilPicture', 'patient', 'biograph'])->where('name', $username)->firstOrFail();

        // return dd($user->profilPicture->path);
        return view('pages.profile', compact('user'));
    }
}
