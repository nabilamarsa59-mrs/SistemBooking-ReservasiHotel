<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterTamuController extends Controller
{
    public function show()
    {
        return view('pages.register_tamu');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required|min:6',
        ]);

        session([
            'tamu_registered' => [
                'nik' => $request->nik,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password,
            ]
        ]);

        return redirect()->route('login.tamu')
            ->with('success', 'Registrasi berhasil. Silakan login.');
    }
}