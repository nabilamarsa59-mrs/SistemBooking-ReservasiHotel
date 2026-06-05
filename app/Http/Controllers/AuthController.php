<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Halaman login - selalu tampilkan form login
    public function showLogin()
    {
        if (Auth::check()) {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
        }

        return view('pages.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'role'     => 'required',
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt([
            'email'    => $request->email,
            'password' => $request->password,
        ])) {
            return back()->withErrors([
                'email' => 'Email atau password salah.'
            ])->withInput();
        }

        $request->session()->regenerate();

        $user = Auth::user();

        // Cek role yang dipilih saat login
        if ($user->role !== $request->role) {
            Auth::logout();
            return back()->withErrors([
                'role' => 'Role yang dipilih tidak sesuai dengan akun.'
            ])->withInput();
        }

        // Pastikan hanya admin dan resepsionis yang bisa login di sini
        if (!in_array($user->role, ['admin', 'resepsionis'])) {
            Auth::logout();
            return back()->withErrors([
                'role' => 'Akun ini tidak memiliki akses sebagai Admin atau Resepsionis.'
            ])->withInput();
        }

        // Simpan role ke session
        session(['role' => $user->role]);

        return $this->redirectByRole($user->role);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing');
    }

    // Redirect berdasarkan role
    private function redirectByRole($role)
    {
        switch ($role) {
            case 'admin':
                return redirect()->route('statistik.admin');
            case 'resepsionis':
                return redirect()->route('home.resepsionis');
            default:
                return redirect()->route('login');
        }
    }
}
