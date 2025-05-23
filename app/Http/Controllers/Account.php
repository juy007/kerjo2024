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
use App\Services\AuthService;

class Account extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
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

        try {
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
                //Session::put('company_provinces', $profileData['data']['company']['provinces']);
                //Session::put('company_regencies', $profileData['data']['company']['regencies']);

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

        } catch (\Exception $e) {
            Log::channel('company_login')->error('Login error - exception terdeteksi', [
                'email' => $request->email,
                'ip' => $request->ip(),
                'error_message' => $e->getMessage(),
            ]);

            return redirect()->route('db_error');
        }
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
            'email' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
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
        
            /*$otp = rand(100000, 999999);
            Http::post('https://api.carikerjo.id/auth/verifyOtp', [
                'userId' => $responseData['data']['_id'],
                'otp' => $otp,
            ]);
            Mail::to($request->email)->send(new OtpMail($otp));

            return redirect()->route('otp');*/
        
            return redirect()->route('company_profile_step1');
        
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
        //return redirect()->route('company_profile_step1');
    }

    public function company_profile_step1()
    {
        if (!empty(Session::get('company_industries'))) {
            $nameIndustries = Session::get('company_name');
            if (!empty($nameIndustries)) {
                return redirect()->route('dashboard_user');
            } else {
                return redirect()->route('company_profile_step2');
            }
        }
        try {
            $token = Session::get('api_token');
            $response = Http::withToken($token)->get('https://api.carikerjo.id/industries');
            $industries = $response->json('data');
            return view('user.form_company_profile_step1', compact('industries'));
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function submitCompany_profile_step1(Request $request)
    {
        $request->validate([
            'industries' => 'required|array',
            //'industries.*' => 'string',
        ]);
        session(['selected_industries' => $request->industries]);

        return redirect()->route('company_profile_step2');
    }

    public function company_profile_step2()
    {
        if (!empty(Session::get('company_industries'))) {
            $nameIndustries = Session::get('company_name');
            if (!empty($nameIndustries)) {
                return redirect()->route('dashboard_user');
            } else {
                return redirect()->route('company_profile_step2');
            }
        }
        try {
            $token = Session::get('api_token');
            $responseProvinces = Http::withToken($token)->get('https://api.carikerjo.id/provinces', ['limit' => 200]);
            $provinces = $responseProvinces->json('data');

            return view('user.form_company_profile_step2', compact('provinces'));
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function submitCompany_profile_step2(Request $request)
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
                $link = $response->json('data');
                
                //$parsed = parse_url($link);
                //parse_str($parsed['query'], $params);

                //$token = $params['token'] ?? null;
                //$id    = $params['id'] ?? null;
                //$full  = ltrim($parsed['path'], '/') . '?' . $parsed['query'];

                //$url = config('kerjo.url')."/" . $full;
                //$url = "http://127.0.0.1:8000/" . $full;
                
                //echo "<pre>";print_r($linkToken);echo "</pre>";
                Mail::to($request->email)->send(new ResetPasswordMail($link));

                return back()->with('status', 'Reset link sent to your email');
            }

            return back()->with(['email' => 'Failed to send reset link.']);
        } catch (\Exception $e) {
            //echo "Terjadi error: " . $e->getMessage() . "<br>"; echo "Di file: " . $e->getFile() . " pada baris " . $e->getLine() . "<br>";echo "<pre>" . $e->getTraceAsString() . "</pre>";
            return redirect()->route('db_error');
        }
    }

    public function showResetForm(Request $request)
    {
        $token = $request->query('token');
        $id = $request->query('id');
        return view('account.form_new_password',compact('token','id'));
    }

    public function reset(Request $request)
    {
        $request->validate([
            
            'userId' => 'required',
            'token' => 'required',
            'password' => 'required|string|confirmed|min:8',
        ]);
        
        try {
            $response = Http::post('https://api.carikerjo.id/auth/resetPassword', [
                'userId' => $request->userId,                
                'token' => $request->token,
                'password' => $request->password,
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
        $data = [ 
            [ "province_id" => "67d4e407b1f9532021a830c2", "name" => "Kota Lhokseumawe" ],
    [ "province_id" => "67d4e407b1f9532021a830c2", "name" => "Kota Langsa" ],
    [ "province_id" => "67d4e407b1f9532021a830c2", "name" => "Kota Subulussalam" ],
    [ "province_id" => "67d4e407b1f9532021a830c2", "name" => "Kabupaten Simeulue" ],
    [ "province_id" => "67d4e407b1f9532021a830c2", "name" => "Kabupaten Aceh Singkil" ],
    [ "province_id" => "67d4e407b1f9532021a830c2", "name" => "Kabupaten Aceh Selatan" ],
    [ "province_id" => "67d4e407b1f9532021a830c2", "name" => "Kabupaten Aceh Tenggara" ],
    [ "province_id" => "67d4e407b1f9532021a830c2", "name" => "Kabupaten Aceh Timur" ],
    [ "province_id" => "67d4e407b1f9532021a830c2", "name" => "Kabupaten Aceh Tengah" ],
    [ "province_id" => "67d4e407b1f9532021a830c2", "name" => "Kabupaten Aceh Barat" ],
    [ "province_id" => "67d4e407b1f9532021a830c2", "name" => "Kabupaten Aceh Besar" ],
    [ "province_id" => "67d4e407b1f9532021a830c2", "name" => "Kabupaten Pidie" ],
    [ "province_id" => "67d4e407b1f9532021a830c2", "name" => "Kabupaten Bireuen" ],
    [ "province_id" => "67d4e407b1f9532021a830c2", "name" => "Kabupaten Aceh Utara" ],
    [ "province_id" => "67d4e407b1f9532021a830c2", "name" => "Kabupaten Aceh Barat Daya" ],
    [ "province_id" => "67d4e407b1f9532021a830c2", "name" => "Kabupaten Gayo Lues" ],
    [ "province_id" => "67d4e407b1f9532021a830c2", "name" => "Kabupaten Aceh Tamiang" ],
    [ "province_id" => "67d4e407b1f9532021a830c2", "name" => "Kabupaten Nagan Raya" ],
    [ "province_id" => "67d4e407b1f9532021a830c2", "name" => "Kabupaten Aceh Jaya" ],
    [ "province_id" => "67d4e407b1f9532021a830c2", "name" => "Kabupaten Bener Meriah" ],
    [ "province_id" => "67d4e407b1f9532021a830c2", "name" => "Kabupaten Pidie Jaya" ],
    [ "province_id" => "67d4e39db1f9532021a830a4", "name" => "Kota Denpasar" ],
    [ "province_id" => "67d4e39db1f9532021a830a4", "name" => "Kabupaten Jembrana" ],
    [ "province_id" => "67d4e39db1f9532021a830a4", "name" => "Kabupaten Tabanan" ],
    [ "province_id" => "67d4e39db1f9532021a830a4", "name" => "Kabupaten Badung" ],
    [ "province_id" => "67d4e39db1f9532021a830a4", "name" => "Kabupaten Gianyar" ],
    [ "province_id" => "67d4e39db1f9532021a830a4", "name" => "Kabupaten Klungkung" ],
    [ "province_id" => "67d4e39db1f9532021a830a4", "name" => "Kabupaten Bangli" ],
    [ "province_id" => "67d4e39db1f9532021a830a4", "name" => "Kabupaten Karangasem" ],
    [ "province_id" => "67d4e39db1f9532021a830a4", "name" => "Kabupaten Buleleng" ]
        ];
        
        // Ambil token dari session (atau langsung isi manual untuk testing)
        $token = session('api_token_admin'); // Contoh: 'Bearer xyz123'
        
        foreach ($data as $item) {
            $response = Http::withToken($token)->retry(3, 100)->post('https://api.carikerjo.id/regencies', [
                'name' => $item['name'],
                'provinceId' => $item['province_id'],
            ]);
        
            if (!$response->successful()) {
                echo "Gagal input: " . $item['name'] . "<br>";
            } else {
                echo "Berhasil input: " . $item['name'] . "<br>";
            }
        }
        
    }
}
