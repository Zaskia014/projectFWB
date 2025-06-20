<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Menampilkan halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Login berhasil, arahkan ke dashboard sesuai role
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        }

        // Login gagal
        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    // Proses register (khusus user & author)
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'role' => 'required|in:user,author', // Admin tidak bisa daftar sendiri
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil, silakan login!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // ✅ Redirect ke halaman utama setelah logout
        return redirect('/')->with('success', 'Berhasil logout.');
    }

    // Redirect ke dashboard berdasarkan role
    public function redirectToDashboard()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'author':
                return redirect()->route('author.dashboard');
            case 'user':
                return redirect()->route('user.dashboard');
            default:
                abort(403, 'Role tidak dikenali.');
        }
    }
}
