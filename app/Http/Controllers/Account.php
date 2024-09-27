<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

        $response = Http::post('https://api.carikerjo.id/auth/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            /*
            if (isset($data['data']['_id'])) {
            $otpResponse = Http::post('https://api.carikerjo.id/auth/requestOtp', ['userId' => $data['data']['_id'],]);
            // Periksa respons OTP
            if ($otpResponse->json()['statusCode'] == 201) {return redirect()->route('otp');}}
            */

            Session::put('api_token',  $data['data']);
            $token = Session::get('api_token');
            $response = Http::withToken($token)->get('https://api.carikerjo.id/auth/my-company-profile');
            $profileData = $response->json();

            Session::put('user_id', $profileData['data']['_id']);
            Session::put('company_id', $profileData['data']['company']['_id']);
            Session::put('company_name', $profileData['data']['company']['name']);
            Session::put('phone', $profileData['data']['company']['phoneNumber']);
            Session::put('email', $profileData['data']['company']['email']);
            Session::put('company_industries', $profileData['data']['company']['industries']);

            if ($request->remember) {
                // Simpan token ke cookie
                return redirect()->route('dashboard_user')->withCookie(cookie('api_token', $token, 60 * 24 * 30)); // 30 hari
            }
            return redirect()->route('dashboard_user');
        }
        return redirect()->route('login')->with('notifLogin', 'Please check your email and password and try again.');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
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

        Session::put('user_id', $responseData['data']['_id']);
        Session::put('company_id', $dataProfile['data']['company']['_id']);
        Session::put('name', $validatedData['name']);
        Session::put('phone', $validatedData['phone']);
        Session::put('email', $validatedData['email']);

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
        return view('user.form_company_profile_part1');
    }

    public function company_profile_part2(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'industries' => 'required|array|min:1', // Pastikan setidaknya satu industri dipilih
            'industries.*' => 'string', // Setiap industri harus berupa string
        ]);

        // Ambil data industri yang dipilih
        $industries = $validated['industries'];

        // Siapkan payload untuk API eksternal
        $payload = [
            'name' => $industries,
        ];

       
        // Kirim request ke API eksternal
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . Session::get('api_token'), // Menggunakan token dari session
            'Content-Type' => 'application/json',
        ])->put("https://api.carikerjo.id/industries/".Session::get('company_id'), $payload);

        // Cek respons dari API
        if ($response->successful()) {echo 'ok-';echo Session::get('company_id');
            //return redirect()->back()->with('success', 'Industries updated successfully!');
        } else {echo 'gagal-'; echo Session::get('company_id');
            //return redirect()->back()->with('error', 'Failed to update industries. ' . $response->body());
        }
        //return view('user.form_company_profile_part2');
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

        // Mengirim permintaan ke API eksternal untuk mengirim email reset password
        $response = Http::post('https://api.carikerjo.id/auth/forgetPassword', [
            'email' => $request->email,
        ]);

        if ($response->successful()) {
            // Ambil token dari response API
            $linkToken = $response->json()['data'];

            // Buat URL reset password
            $url = $linkToken;

            // Kirim email dengan link reset password
            // Mail::to($request->email)->send(new ResetPasswordMail($url));

            return back()->with('status', 'Reset link sent to your email.');
        }

        return back()->with(['email' => 'Failed to send reset link.']);
    }

    public function showResetForm(Request $request, $token)
    {
        return view('account.form_new_password', ['token' => $token, 'email' => $request->email]);
    }

    // Proses update password baru
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Mengirim permintaan ke API eksternal untuk reset password
        $response = Http::post('https://api.carikerjo.id/auth/resetPassword', [
            'email' => $request->email,
            'password' => $request->password,
            'token' => $request->token,
        ]);

        if ($response->successful()) {
            return redirect()->route('login')->with('status', 'Password has been reset successfully.');
        }

        return back()->withErrors(['email' => 'Failed to reset password.']);
    }


    
}
