<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function showCorrectHomepage() {
        if (auth()->check()) {
            return view('index');
        } else {
            return view('auth.login');
        }
    }

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba melakukan autentikasi
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            // Jika berhasil, redirect ke home atau halaman yang diinginkan
            return redirect()->route('admin.posts.index');
        }

        // Jika gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors(['email' => 'Email atau password salah']);
    }
}
