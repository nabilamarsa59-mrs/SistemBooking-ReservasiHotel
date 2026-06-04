<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->role);
        }

        return view('pages.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'role'     => 'required|in:admin,resepsionis',
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'role.required'     => 'Pilih role terlebih dahulu.',
            'role.in'           => 'Role tidak valid.',
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            // Validasi role yang dipilih saat login
            if ($user->role !== $request->role) {

                Auth::logout();

                return back()
                    ->withInput($request->only('email', 'role'))
                    ->withErrors([
                        'role' => 'Role yang dipilih tidak sesuai dengan akun.'
                    ]);
            }

            return $this->redirectByRole($user->role);
        }

        return back()
            ->withInput($request->only('email', 'role'))
            ->withErrors([
                'email' => 'Email atau kata sandi salah.'
            ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Berhasil logout.');
    }

    // Redirect berdasarkan role
    private function redirectByRole(string $role)
    {
        return match ($role) {
            'admin'       => redirect()->route('statistik.admin'),
            'resepsionis' => redirect()->route('dashboard.resepsionis'),
            default       => redirect()->route('login'),
        };
    }
}