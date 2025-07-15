<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('login.login'); // Ganti dengan path view login Anda
    }

    /**
     * Proses login.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Cek kredensial dan login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Regenerasi sesi untuk keamanan

            // Ambil data user yang sudah login
            $user = Auth::user();

            // Simpan role ke session untuk akses yang lebih mudah
            session(['user_role' => $user->role]);

            // Redirect berdasarkan role (integer)
            switch ($user->role) {
                case 1: // Regular user
                    return redirect()->route('rektor-dashboard');
                case 2: // Admin
                    return redirect()->route('admin-dashboard');
                case 3: // Petugas
                    return redirect()->route('petugas-dashboard');
                default:
                    return redirect()->route('login');
            }
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    /**
     * Logout pengguna.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $request->session()->invalidate(); // Hapus sesi user
        $request->session()->regenerateToken(); // Regenerate session token
        $request->user()->tokens()->delete();
        return redirect()->route('login'); // Redirect ke halaman login
    }

    /**
     * Menampilkan halaman dashboard pengguna setelah login.
     *
     * @return \Illuminate\View\View



     * Middleware untuk memastikan pengguna terautentikasi.
     */
    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['showLoginForm', 'login']);
    // }
}
