<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use Authenticatable;

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        // Ambil kredensial
        $credentials = $request->only('username', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->intended('/dashboard');
        }

        $user = \App\Models\User::where('username', $request->username)->first();
        $errors = [];

        if (!$user) {
            $errors['username'] = 'Username yang Anda masukkan tidak cocok dengan catatan kami.';
        } elseif (!Auth::validate(['username' => $request->username, 'password' => $request->password])) {
            $errors['password'] = 'Password yang Anda masukkan salah.';
        }

        return back()->withErrors($errors)->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout user
        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Regenerate CSRF token
        $request->session()->flash('status', 'Anda berhasil keluar dari Halaman Website Careventory');
        return redirect('/login'); // Redirect ke halaman login setelah logout
    }
}
