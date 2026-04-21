<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginChoice()
    {
        return view('login-choice');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'role' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($request->role === 'admin') {
            return redirect()->route('dashboard.admin');
        }

        if ($request->role === 'resepsionis') {
            return redirect()->route('dashboard.resepsionis');
        }

        return back()->with('error', 'Role tidak valid.');
    }

    public function showLoginTamu()
    {
        return view('login_tamu');
    }

    public function loginTamu(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        return redirect()->route('dashboard.tamu');
    }
}