<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Account;
use App\Http\Controllers\User;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/-admin-', [Admin::class, 'index'])->name('admin_login');
Route::post('/login-validation', [Admin::class, 'login_validation'])->name('login_validation');
Route::get('/dashboarddddd', [Admin::class, 'dashboard'])->name('admin_dashboard');
Route::post('/adminlogout', [Admin::class, 'logout'])->name('admin_logout');

// Login & Register User
Route::get('/', [Account::class, 'index'])->name('login');
Route::post('/user-validation', [Account::class, 'loginValidation'])->name('userValidation');
Route::get('/signup', [Account::class, 'signup'])->name('signup');
Route::post('/signup-save', [Account::class, 'signup_save'])->name('signup_save');

//OTP User
Route::get('/otp', [Account::class, 'otp'])->name('otp');
Route::post('/verify_otp', [Account::class, 'verify_otp'])->name('verify_otp');

Route::middleware('auth.token')->group(function () {
    Route::middleware(['check.company.industries'])->group(function () {
        Route::get('/dashboard', [User::class, 'index'])->name('dashboard_user');
        Route::get('/tambah-lowongan', [User::class, 'form_lowongan'])->name('form_lowongan');
        Route::get('/posting-lowongan', [User::class, 'posting_lowongan'])->name('posting_lowongan');
        Route::get('/detail-lowongan', [User::class, 'detail_lowongan'])->name('detail_lowongan');
        Route::get('/detail-pelamar', [User::class, 'detail_pelamar'])->name('detail_pelamar');
    });
    Route::get('/part-1', [Account::class, 'company_profile_part1'])->name('company_profile_part1');
    Route::post('/part-2', [Account::class, 'company_profile_part2'])->name('company_profile_part2');
    Route::post('/logout', [Account::class, 'logout'])->name('user_logout');
});

//Forgot Password User
Route::get('password/forgot', [Account::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [Account::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('passwordReset/{token}', [Account::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [Account::class, 'reset'])->name('password.update');