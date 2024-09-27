<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; 

class Admin extends Controller
{
    public function index()
    {
        return view('admin.form_login');
    }

    public function login_validation(Request $request)
    {
    
         // Validasi data yang masuk
         $credentials = $request->validate([
			'email' => 'required|email',
			'password' => 'required'
		]);

        // Coba autentikasi pengguna berdasarkan kredensial yang diberikan
        if (Auth::guard('web')->attempt($credentials)) {
            // Jika login berhasil
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Login berhasil!'); // Ganti dengan rute yang sesuai
        }

        // Jika login gagal, kirim pesan error
        return back()->with('error', 'Email atau password salah');


        /*
        $response = Http::post('https://api.carikerjo.id/auth/login', [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        // Periksa status kode respons
        if ($response->successful()) {
            // Jika login berhasil
            $data = $response->json();
            return response()->json($data);
        }

        // Jika login gagal, kirim pesan error
        return response()->json([
            'error' => 'Unauthorized'
        ], $response->status()); // Mengembalikan status kode yang sesuai
        */
    }

    public function dashboard()
    {
        return view('admin.home');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();  // Ubah 'web' dengan guard yang sesuai

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin_login');
    }

   

}
