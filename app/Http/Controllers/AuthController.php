<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginChoice()
    {
        return view('pages.login-choice');
    }


    public function showLogin()
    {
        return view('pages.login');
    }


    // LOGIN ADMIN & RESEPSIONIS
    public function login(Request $request)
    {
        $request->validate([
            'role' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // LOGIN ADMIN
        if (
            $request->role === 'admin' &&
            $request->email === 'admin@gmail.com' &&
            $request->password === 'admin123'
        ) {
            return redirect()->route('dashboard.admin');
        }

        // LOGIN RESEPSIONIS
        if (
            $request->role === 'resepsionis' &&
            $request->email === 'resepsionis@gmail.com' &&
            $request->password === 'resepsionis123'
        ) {
            return redirect()->route('dashboard.resepsionis');
        }

        return back()->with('error', 'Email atau password salah.');
    }


    public function showLoginTamu()
    {
        return view('pages.login_tamu');
    }


    // LOGIN TAMU
    public function loginTamu(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // LOGIN TAMU DUMMY
        if (
            $request->email === 'tamu@gmail.com' &&
            $request->password === 'tamu123'
        ) {
            return redirect()->route('dashboard.tamu');
        }

        // LOGIN TAMU DARI SESSION REGISTER
        $tamu = session('tamu_registered');

        if (
            $tamu &&
            $request->email === $tamu['email'] &&
            $request->password === $tamu['password']
        ) {
            return redirect()->route('dashboard.tamu');
        }

        return back()->with('error', 'Email atau password salah.');
    }
}