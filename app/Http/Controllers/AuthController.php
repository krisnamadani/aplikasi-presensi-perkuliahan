<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){

        $user = $request->validate([
            'email'         => 'required|email',
            'password'      => 'required'
        ]);

        if (Auth::guard('dosen')->attempt($user)) {
            $request->session()->regenerate();

            return redirect('/dashboard');
        }

        return back()->with('loginSalah', 'Data Login Salah!');
    }
}
