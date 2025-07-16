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
    public function showRegisterForm()
    {
        return view('login.register'); // Ganti dengan path view register Anda
    }

    /**
     * Proses login.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validasi input
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'user_level_id' => 4, // Default role sebagai regular user
            'email_verified_at' => now(), // Set email terverifikasi
        ]);

        // Login user setelah registrasi
        Auth::login($user);

        return redirect()->route('public-dashboard'); // Ganti dengan route dashboard yang sesuai
        
    }
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

            // Simpan user_level_id ke session untuk akses yang lebih mudah
            session(['user_level_id' => $user->user_level_id]);

            // Redirect berdasarkan user_level_id
            switch ($user->user_level_id) {
                case 1: // Rektor
                    return redirect()->route('rektor-dashboard');
                case 2: // Admin
                    return redirect()->route('admin-dashboard');
                case 3: // Petugas
                    return redirect()->route('petugas-dashboard');
                case 4: // Regular user
                    return redirect()->route('public-dashboard');
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
        // Store user_level_id before invalidating session
        $userLevel = session('user_level_id');        
        Auth::logout(); // Logout user
        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Regenerate CSRF token
        
        // Redirect based on stored user level
        if ($userLevel == 4) {
            return redirect()->route('public.index');
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Menampilkan halaman dashboard pengguna setelah login.
     *
     * @return \Illuminate\View\View



     * Middleware untuk memastikan pengguna terautentikasi.
     */
}
