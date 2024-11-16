<?php

namespace App\Http\Controllers;

use App\Models\Biograph;
use App\Models\Role;
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
        $users = User::with('roles:id,name')
                ->get(['id', 'name', 'email'])
                ->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'roles' => $user->roles->pluck('name')->join(' '), // Ubah array menjadi string
                    ];
                });
        $users = new \Illuminate\Database\Eloquent\Collection($users);
        return view('pages.tables.users.index', compact('users'));
    }    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('pages.tables.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'file_id' => 'nullable|integer',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
            
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'picture' => $request->file_id,
        ]);

        if ($request->has('roles')) {
            $user->roles()->sync($validated['roles']);
        }else {
            $roles = UserRole::create([
                'user_id' => $user->id,
                'role_id' => 3,
            ]);
        }

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
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
    
        return view('pages.tables.users.edit', compact(['user', 'roles']));
    }     

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'file_id' => 'nullable|integer',
            'roles' => 'nullable|array', // Ensure roles is an array
            'roles.*' => 'exists:roles,id', // Ensure each role exists in the roles table
        ]);

        // Update the user information
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->picture = $validated['file_id'];

        // Update the password if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        // Sync the roles for the user (this will attach the selected roles and remove any unselected ones)
        if ($request->has('roles')) {
            $user->roles()->sync($validated['roles']);
        }

        return redirect()->back()->with('success', 'User updated successfully');
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
