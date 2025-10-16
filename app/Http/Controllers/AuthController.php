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
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Coba login
        if (Auth::attempt($infologin)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // 🔥 Redirect berdasarkan role
            if ($user->role === 'superadmin') {
                return redirect()->route('superAdmin.dashboard');
            } elseif ($user->role === 'finance') {
                return redirect()->route('finance.dashboard');
            } else {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Role tidak dikenali.');
            }
        } else {
            return back()->with('error', 'Email atau password salah.');
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
