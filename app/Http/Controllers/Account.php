<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

use App\Mail\OtpMail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Carbon;
//use Illuminate\Support\Facades\URL;

class Account extends Controller
{
    //========================Login
    public function index()
    {
        return view('account.form_login');
    }

    public function loginValidation(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //try {
            Log::channel('company_login')->info('Memulai proses login', [
                'email' => $request->email,
                'ip' => $request->ip(),
            ]);

            $response = Http::retry(3, 100)->post('https://api.carikerjo.id/auth/login', [
                'email' => $request->email,
                'password' => $request->password,
            ]);

            if ($response->successful()) {
                $data = $response->json();

                Session::put('api_token',  $data['data']);
                $token = Session::get('api_token');

                $profileResponse = Http::withToken($token)->get('https://api.carikerjo.id/auth/my-company-profile');
                $profileData = $profileResponse->json();

                $statusCode = $profileData['statusCode'] ?? null;
                if ($statusCode === 403) {
                    Log::channel('company_login')->warning('Login gagal - role ADMIN tidak diizinkan', [
                        'email' => $request->email,
                        'ip' => $request->ip(),
                    ]);
                    return redirect()->route('login')->with('notifLogin', 'Please check your email and password and try again.');
                }

                $userId = $profileData['data']['_id'] ?? null;
                $companyId = $profileData['data']['company']['_id'] ?? null;
                $companyName = $profileData['data']['company']['name'] ?? null;

                // Simpan data ke session
                Session::put('user_id', $userId);
                Session::put('company_id', $companyId);
                Session::put('company_name', $companyName);
                Session::put('company_brand', $profileData['data']['company']['brand']);
                Session::put('company_logo', $profileData['data']['company']['logo']);
                Session::put('company_email', $profileData['data']['company']['email']);
                Session::put('company_phone', $profileData['data']['company']['phoneNumber']);
                Session::put('company_overview', $profileData['data']['company']['overview']);
                Session::put('company_industries', $profileData['data']['company']['industries']);
                Session::put('company_galleries', $profileData['data']['company']['galleries']);
                Session::put('company_active', $profileData['data']['company']['active']);
                Session::put('company_location', $profileData['data']['company']['location']);

                // Logging sukses login
                Log::channel('company_login')->info('Login berhasil', [
                    'user_id' => $userId,
                    'company_id' => $companyId,
                    'company_name' => $companyName,
                    'ip' => $request->ip(),
                ]);

                if ($request->remember) {
                    return redirect()->route('dashboard_user')
                        ->withCookie(cookie('api_token', $token, 60 * 24 * 30)); // 30 hari
                }

                return redirect()->route('dashboard_user');
            }

            // Login gagal
            Log::channel('company_login')->warning('Login gagal - kredensial salah', [
                'email' => $request->email,
                'ip' => $request->ip(),
            ]);

            return redirect()->route('login')->with('notifLogin', 'Please check your email and password and try again.');

        /*} catch (\Exception $e) {
            Log::channel('company_login')->error('Login error - exception terdeteksi', [
                'email' => $request->email,
                'ip' => $request->ip(),
                'error_message' => $e->getMessage(),
            ]);

            return redirect()->route('db_error');
        }*/
    }


    public function logout(Request $request)
    {
        $userId = Session::get('user_id');
        $companyId = Session::get('company_id');
        $companyName = Session::get('company_name');
    
        // 🔐 Logging proses logout dimulai
        Log::channel('company_login')->info('Memulai proses logout', [
            'user_id' => $userId,
            'company_id' => $companyId,
            'company_name' => $companyName,
            'ip' => $request->ip(),
        ]);
    
        try {
            // Hapus semua session dan cookie
            Session::flush();
    
            // Logging sukses logout
            Log::channel('company_login')->info('Logout berhasil', [
                'user_id' => $userId,
                'company_id' => $companyId,
                'company_name' => $companyName,
                'ip' => $request->ip(),
            ]);
    
            return redirect()->route('login')->with('notifLogout', 'Anda berhasil logout');
        } catch (\Exception $e) {
            // Logging error saat logout
            Log::channel('company_login')->error('Logout gagal - exception terjadi', [
                'user_id' => $userId,
                'company_id' => $companyId,
                'company_name' => $companyName,
                'ip' => $request->ip(),
                'error_message' => $e->getMessage(),
            ]);
    
            return redirect()->route('dashboard_user')->with('notifLogout', 'Logout gagal, silakan coba lagi');
        }
    }

    //========================Register
    public function signup()
    {
        return view('account.form_signup');
    }

    public function signup_save(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'string',
            'max:255',
            'phone' => 'required',
            'string',
            'max:255',
            'email' => 'required',
            'string',
            'password' => 'required',
            'string',
            'min:8',
            'confirmed',
        ]);

        $dataToSend = [
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'name' => $validatedData['name'],
            'phoneNumber' => $validatedData['phone'],
        ];
        
            $response = Http::post('https://api.carikerjo.id/auth/register-company', $dataToSend);
            if ($response->failed()) {
                return back()->withInput()->with('notifRegister', "The registration has failed, please try again later.");
            }
            $responseData = $response->json();

            if ($responseData['statusCode'] == '500') {
                return back()->withInput()->with('notifRegister', "Email already used");
            }

            $login = Http::post('https://api.carikerjo.id/auth/login', ['email' => $validatedData['email'], 'password' => $validatedData['password'],]);
            $dataLogin = $login->json();

            Session::put('api_token',  $dataLogin['data']);
            $token = Session::get('api_token');
            $dataProfile = Http::withToken($token)->get('https://api.carikerjo.id/auth/my-company-profile');
            $profileData = $dataProfile->json();

            Session::put('user_id', $profileData['data']['_id']);
            Session::put('company_id', $profileData['data']['company']['_id']);
            Session::put('company_name', $profileData['data']['company']['name']);
            Session::put('company_brand', $profileData['data']['company']['brand']);
            Session::put('company_logo', $profileData['data']['company']['logo']);
            Session::put('company_email', $profileData['data']['company']['email']);
            Session::put('company_phone', $profileData['data']['company']['phoneNumber']);
            Session::put('company_overview', $profileData['data']['company']['overview']);
            Session::put('company_industries', $profileData['data']['company']['industries']);
            Session::put('company_galleries', $profileData['data']['company']['galleries']);
            Session::put('company_active', $profileData['data']['company']['active']);
            //Session::put('company_established', $profileData['data']['company']['established']);
            //Session::put('company_location', $profileData['data']['company']['location']);

            // Generate OTP dan kirim ke API
            /*
            $otp = rand(100000, 999999);
            Http::post('https://api.carikerjo.id/auth/verifyOtp', [
                'userId' => $responseData['data']['_id'],
                'otp' => $otp,
            ]);
            session(['otp' => $otp]);

            return redirect()->route('otp');
            */
            return redirect()->route('company_profile_part1');
        
    }

    public function company_profile_part1()
    {
        if (!empty(Session::get('company_industries'))) {
            $nameIndustries = Session::get('company_name');
            if (!empty($nameIndustries)) {
                return redirect()->route('dashboard_user');
            } else {
                return redirect()->route('company_profile_part2');
            }
        }
        try {
            $token = Session::get('api_token');
            $response = Http::withToken($token)->get('https://api.carikerjo.id/industries');
            $industries = $response->json('data');
            return view('user.form_company_profile_part1', compact('industries'));
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function submitCompany_profile_part1(Request $request)
    {
        $request->validate([
            'industries' => 'required|array',
            //'industries.*' => 'string',
        ]);
        session(['selected_industries' => $request->industries]);

        return redirect()->route('company_profile_part2');
    }

    public function company_profile_part2()
    {
        if (!empty(Session::get('company_industries'))) {
            $nameIndustries = Session::get('company_name');
            if (!empty($nameIndustries)) {
                return redirect()->route('dashboard_user');
            } else {
                return redirect()->route('company_profile_part2');
            }
        }
        try {
            $token = Session::get('api_token');
            $responseProvinces = Http::withToken($token)->get('https://api.carikerjo.id/provinces');
            $provinces = $responseProvinces->json('data');

            return view('user.form_company_profile_part2', compact('provinces'));
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function submitCompany_profile_part2(Request $request)
    {
        $validatedData = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'nama_brand' => 'required|string|max:255',
            'tanggal_berdiri_perusahaan' => 'required|date',
            'lokasi_perusahaan' => 'required|string|max:255',
            'tentang_perusahaan' => 'required|string',
            'logo_perusahaan' => 'required|image|mimes:jpeg,png,jpg',
            'gallery.*' => 'image|mimes:jpeg,png,jpg',
        ]);

        $token = session('api_token');

        if ($request->hasFile('logo_perusahaan')) {
            $logo = $request->file('logo_perusahaan');
            try {
                $logoResponse = Http::withToken($token)
                    ->attach('file', file_get_contents($logo), $logo->getClientOriginalName())
                    ->post('https://api.carikerjo.id/medias/upload-logo');

                if (!$logoResponse->successful()) {
                    return redirect()->back()->withErrors(['error' => 'Failed to upload logo.']);
                }

                $logoUrl = $logoResponse->json('data.path');
                $galleryUrls = [];

                if ($request->hasFile('gallery')) {
                    foreach ($request->file('gallery') as $galleryImage) {
                        $galleryResponse = Http::withToken($token)
                            ->attach('file', file_get_contents($galleryImage), $galleryImage->getClientOriginalName())
                            ->post('https://api.carikerjo.id/medias/upload-gallery');

                        if ($galleryResponse->successful()) {
                            $galleryUrls[] = $galleryResponse->json('data.path'); // Path gambar galeri
                        } else {
                            return redirect()->back()->withErrors(['error' => 'Failed to upload gallery images.']);
                        }
                    }
                }

                $industries = session('selected_industries');

                $data = [
                    'name' => $validatedData['nama_perusahaan'],
                    'brand' => $validatedData['nama_brand'],
                    'overview' => $validatedData['tentang_perusahaan'],
                    'industries' => $industries,
                    'established' => $validatedData['tanggal_berdiri_perusahaan'],
                    'provinceId' => $validatedData['lokasi_perusahaan'],
                    'logo' => $logoUrl,
                    'galleries' => $galleryUrls, // Isi dengan URL galeri yang di-upload
                ];

                $response = Http::withToken($token)->put('https://api.carikerjo.id/auth/my-company-profile', $data);

                if ($response->successful()) {
                    Session::put('company_industries', $industries);
                    Session::put('name_industries', $validatedData['nama_perusahaan']);
                    return redirect()->route('dashboard_user')->with('success', 'Company profile updated successfully.');
                } else {
                    //echo $response->body();
                    return redirect()->back()->withErrors(['error' => 'Failed to update company profile.']);
                }
            } catch (\Exception $e) {
                return redirect()->route('db_error');
            }
        }
    }

    public function otp()
    {
        return view('account.form_otp');
    }

    public function verify_otp(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'user_id' => 'required|string',
            'otp' => 'required|string',
        ]);

        // Kirim request GET ke API eksternal untuk verifikasi OTP
        $response = Http::get('https://api.carikerjo.id/auth/verifyOtp', [
            'userId' => $request->input('user_id'),
            'otp' => $request->input('otp'),
        ]);

        // Periksa apakah request berhasil
        if ($response->successful()) {
            $responseData = $response->json();

            // Cek apakah API memberikan status sukses
            if (isset($responseData['success']) && $responseData['success']) {

                // Cek apakah API memberikan waktu kadaluarsa (misalnya 'expiredAt' dalam ISO8601 format)
                if (isset($responseData['expiredAt'])) {
                    $otpExpiredAt = Carbon::parse($responseData['expiredAt']);
                    $now = Carbon::now();

                    // Cek apakah OTP sudah kadaluarsa
                    if ($otpExpiredAt->isPast()) {
                        // Jika API mengembalikan error
                        return back()->withInput()->with('notifOtp', "Your OTP is expired. Please try again.");
                        /*return response()->json([
                            'message' => 'OTP has expired.',
                        ], 400);*/
                    } else {
                        // OTP valid dan belum kadaluarsa
                        $deleteResponse = Http::delete('https://api.carikerjo.id/auth/deleteOtp', [
                            'userId' => $request->input('user_id'),
                        ]);

                        return redirect()->route('login');
                        /*return response()->json([
                            'message' => 'OTP verified successfully!',
                            'data' => $responseData,
                        ], 200);*/
                    }
                } else {
                    // Jika tidak ada informasi tentang expiredAt dari API
                    $deleteResponse = Http::delete('https://api.carikerjo.id/auth/deleteOtp', [
                        'userId' => $request->input('user_id'),
                    ]);
                    return redirect()->route('login');
                    /*
                    return response()->json([
                        'message' => 'Could not retrieve expiration information.',
                    ], 400);*/
                }
            } else {
                // Jika verifikasi gagal, kirimkan respons error
                return back()->withInput()->with('notifOtp', "OTP verification failed, please check your data again.");
                /*
                return response()->json([
                    'message' => 'OTP verification failed: ' . ($responseData['message'] ?? 'Invalid OTP.'),
                ], 400);*/
            }
        } else {
            // Jika ada masalah dengan API eksternal, tangani errornya
            /*return response()->json([
                'message' => 'Error connecting to API: ' . $response->body(),
            ], $response->status());
            */
            return back()->withInput()->with('notifOtp', "OTP verification failed, please check your data again.");
        }
        //return redirect()->route('company_profile_part1');
    }

    //=================================ForgotPassword
    public function showLinkRequestForm()
    {
        return view('account.form_forgot_request');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        try {
            $response = Http::post('https://api.carikerjo.id/auth/forgetPassword', [
                'email' => $request->email,
            ]);

            if ($response->successful()) {
                $linkToken = $response->json()['data'];

                $parsed_url = parse_url($linkToken);
                $query = $parsed_url['query'];

                parse_str($query, $params);

                $token = $params['token'];
                $url = config('kerjo.url')."/passwordReset/" . $token;
                //$url = "http://127.0.0.1:8000/passwordReset/" . $token;
                

                Mail::to($request->email)->send(new ResetPasswordMail($url));

                return back()->with('status', 'Reset link sent to your email');
            }

            return back()->with(['email' => 'Failed to send reset link.']);
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function showResetForm(Request $request, $token)
    {
        return view('account.form_new_password', ['token' => $token, 'email' => $request->email]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|confirmed|min:8',
        ]);
        try {
            $response = Http::post('https://api.carikerjo.id/auth/resetPassword', [
                'email' => $request->email,
                'password' => $request->password,
                'token' => $request->token,
            ]);

            if ($response->successful()) {
                return redirect()->route('login')->with('status', 'Password has been reset successfully.');
            }

            return back()->withErrors(['email' => 'Failed to reset password.']);
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function dbNotFound()
    {
        return view('account.dbNotFound');
    }
    public function input()
    {
        $provinces = [
            'Nusa Tenggara Barat',
            'Nusa Tenggara Timur',
            'Papua',
            'Papua Barat',
            'Papua Pegunungan',
            'Papua Selatan',
            'Papua Tengah',
            'Riau',
            'Sulawesi Barat',
            'Sulawesi Selatan',
            'Sulawesi Tengah',
            'Sulawesi Tenggara',
            'Sulawesi Utara',
            'Sumatra Barat',
            'Sumatra Selatan',
            'Sumatra Utara',
        ];

        // Siapkan token API
        $token = session('api_token_admin'); // Atau hardcode jika token sudah diketahui

        // Looping untuk mengirim tiap provinsi satu per satu
        foreach ($provinces as $province) {
            $response = Http::withToken($token)->post('https://api.carikerjo.id/provinces', [
                'name' => $province,
            ]);

            if (!$response->successful()) {
                echo "gagal = " . $province;
            }
        }

        echo 'berhasil';
    }
}
