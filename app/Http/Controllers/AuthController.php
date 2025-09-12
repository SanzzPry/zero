<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\CssSelector\Node\FunctionNode;

class AuthController extends Controller
{
    public function registerView()
    {
        return view('auth.sign-up');
    }

    public function loginView()
    {
        return view('auth.sign-in');
    }
    public function login(Request $request)
    {
        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            return redirect('super-admin/dashboard');
        } else {
            return redirect('auth/login');
        }
    }
    public function register(Request $request)
    {
        User::create($request->all());
        return redirect('auth/register')->with('success', 'Selamat! Akun anda berhasil dibuat.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('auth/login');
    }
}
