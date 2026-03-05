<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Tanah;
use App\Models\Kantor;
use App\Models\Barak;
use App\Models\Rumdin;
use App\Models\Mushola;
use App\Models\Garasi;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        return view('auth.login'); // ✅ SESUAI STRUKTUR FOLDER (auth/login.blade.php)
    }

    // Proses login dengan Remember Me
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username harus diisi',
            'password.required' => 'Password harus diisi',
        ]);

        $credentials = $request->only('username', 'password');
        $remember = $request->has('remember'); // ✅ Cek checkbox "Ingat saya"

        // ✅ Login dengan parameter $remember (untuk fitur "Ingat saya")
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Login berhasil! Selamat datang ' . Auth::user()->name);
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput($request->only('username'));
    }

    // 🔥 TAMPILKAN DASHBOARD DENGAN 3 CARD SAJA
    public function dashboard()
    {
        // Card 1: Total data tanah
        $totalTanah = Tanah::count();
        
        // Card 2: Total bangunan dari SEMUA tabel bangunan
        // (Kantor + Rumdin + Barak + Mushola + Garasi)
        $totalBangunan = Kantor::count() 
                       + Rumdin::count() 
                       + Barak::count()
                       + Mushola::count()
                       + Garasi::count();
        
        // Card 3: Data terbaru (yang diupdate hari ini dari semua tabel)
        $updateHariIni = Tanah::whereDate('updated_at', today())->count()
                       + Kantor::whereDate('updated_at', today())->count()
                       + Rumdin::whereDate('updated_at', today())->count()
                       + Barak::whereDate('updated_at', today())->count()
                       + Mushola::whereDate('updated_at', today())->count()
                       + Garasi::whereDate('updated_at', today())->count();
        
        return view('dashboard', compact(
            'totalTanah',
            'totalBangunan', 
            'updateHariIni'
        ));
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}