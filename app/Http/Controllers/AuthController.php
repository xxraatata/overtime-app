<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\mskaryawan;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function showLoginForm(): View
    {
        return view('pages.Login.Login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'kry_username' => 'required',
            'kry_password' => 'required',
        ]);

        $karyawan = mskaryawan::where('kry_username', $credentials['kry_username'])
                             ->where('kry_password', $credentials['kry_password'])
                             ->where('kry_status', 'Aktif')
                             ->first();

        if ($karyawan) {
            Auth::login($karyawan);
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'kry_username' => 'The provided credentials do not match our records.',
        ])->onlyInput('kry_username');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
} 