<?php

namespace App\Http\Controllers;

use App\Models\Biograph;
use App\Models\File;
use App\Models\Patient;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

class AuthenticateController extends Controller
{

    public function showLoginForm()
    {
        return view('pages.login'); 
    }

    public function showRegisterForm()
    {
        return view('pages.register');
    }

    public function register(Request $request)
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

        $biograph = Biograph::create([
            'user_id' => $user->id,
        ]);

        $patient = Patient::create([
            'user_id' => $user->id,
            'biograph_id' => $biograph->id,
        ]);

        // Login otomatis setelah registrasi
        Auth::login($user);

        // Redirect ke halaman utama setelah sukses registrasi
        return redirect()->route('user.profile',$user->name)->with('message', 'User registered successfully');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial dan login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->route('home')->with('message', 'Logged in successfully');
        }

        // Jika kredensial tidak cocok, lemparkan pengecualian
        throw ValidationException::withMessages([
            'password' => ['The provided credentials do not match our records.'],
        ]);
    }

    public function logout(Request $request)
    {
        // Logout dan invalidate session
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman utama setelah logout
        return redirect()->route('home')->with('message', 'Logged out successfully');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                Auth::login($user);
                return redirect()->route('dashboard');
            } else {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(uniqid()),
                    'picture' => File::create([
                        'name' => $googleUser->getName(),
                        'path' => $googleUser->getAvatar(),
                    ])->id,
                ]);

                $roles = UserRole::create([
                    'user_id' => $user->id,
                    'role_id' => 3,
                ]);        

                // Create a biograph for the user
                $biograph = Biograph::create([
                    'user_id' => $user->id,
                ]);
                Log::info($biograph);

                // Create a patient record for the user
                $patient = Patient::create([
                    'user_id' => $user->id,
                    'biograph_id' => $biograph->id,
                ]);

                Auth::login($user);
                return redirect()->route('user.profile',$user->name);
            }

            
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['error' => 'Failed to login with Google.']);
        }
    }

    // Fungsi untuk mengirim link reset password bisa diaktifkan jika diperlukan
    /*
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $response = Password::sendResetLink(
            $request->only('email')
        );

        if ($response == Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Password reset link sent to your email.'], 200);
        } else {
            return response()->json(['message' => 'Unable to send reset link.'], 400);
        }
    }
    */
}