<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterTamuController extends Controller
{
    
    // Tampilkan form registrasi tamu.
    public function showRegisterForm()
    {
        if (Auth::guard('tamu')->check()) {
            return redirect()->route('dashboard.tamu');
        }

        return view('pages.register_tamu');
    }

    // Proses registrasi tamu baru.    
    public function register(Request $request)
    {
        $request->validate([
            'nik'      => 'required|string|digits:16|unique:tamu,nik',
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:tamu,email',
            'phone'    => 'required|string|max:20',
            'password' => 'required|min:6',
        ], [
            'nik.required'      => 'NIK wajib diisi.',
            'nik.digits'        => 'NIK harus 16 digit angka.',
            'nik.unique'        => 'NIK sudah terdaftar.',
            'name.required'     => 'Nama wajib diisi.',
            'email.required'    => 'Email wajib diisi.',
            'email.unique'      => 'Email sudah terdaftar.',
            'phone.required'    => 'Nomor telepon wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min'      => 'Kata sandi minimal 6 karakter.',
        ]);

        $tamu = Tamu::create([
            'nik'      => $request->nik,
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Login otomatis setelah registrasi berhasil
        Auth::guard('tamu')->login($tamu);
        $request->session()->regenerate();

        return redirect()->route('dashboard.tamu')
            ->with('success', 'Registrasi berhasil! Selamat datang, ' . $tamu->name . '.');
    }

    
    // Tampilkan form login tamu.
    public function showLoginForm()
    {
        if (Auth::guard('tamu')->check()) {
            return redirect()->route('dashboard.tamu');
        }

        return view('pages.login_tamu');
    }


    // Proses login tamu
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        if (Auth::guard('tamu')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.tamu')
                ->with('success', 'Selamat datang, ' . Auth::guard('tamu')->user()->name . '!');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Email atau kata sandi salah.']);
    }

    // Logout tamu
    public function logout(Request $request)
    {
        Auth::guard('tamu')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.tamu')
            ->with('success', 'Berhasil logout.');
    }
}
