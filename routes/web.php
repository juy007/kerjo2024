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

Route::get('/adminkerjo', [Admin::class, 'index'])->name('admin_login');
Route::post('/login-validation', [Admin::class, 'login_validation'])->name('login_validation');

Route::middleware('admin.token')->group(function () {
    Route::get('/admin-dashboard', [Admin::class, 'dashboard'])->name('admin_dashboard');

    // Job Statuses
    Route::get('/admin/job-statuses', [Admin::class, 'jobStatusesIndex'])->name('admin.job-statuses.index');
    Route::post('/admin/job-statuses', [Admin::class, 'jobStatusesStore'])->name('admin.job-statuses.store');
    Route::put('/admin/job-statuses/{id}', [Admin::class, 'jobStatusesUpdate'])->name('admin.job-statuses.update');
    Route::delete('/admin/job-statuses/{id}', [Admin::class, 'jobStatusesDestroy'])->name('admin.job-statuses.destroy');

    // Job Levels
    Route::get('/admin/job-levels', [Admin::class, 'jobLevelsIndex'])->name('admin.job-levels.index');
    Route::post('/admin/job-levels', [Admin::class, 'jobLevelsStore'])->name('admin.job-levels.store');
    Route::put('/admin/job-levels/{id}', [Admin::class, 'jobLevelsUpdate'])->name('admin.job-levels.update');
    Route::delete('/admin/job-levels/{id}', [Admin::class, 'jobLevelsDestroy'])->name('admin.job-levels.destroy');

    //provinces
    Route::get('/provinces', [Admin::class, 'provinceIndex'])->name('admin.provinces.index');
    Route::post('/provinces-post', [Admin::class, 'provinceStore'])->name('admin.provinces.store');
    Route::get('/provinces/{id}', [Admin::class, 'provinceShow'])->name('admin.provinces.show');
    Route::put('/provinces/{id}', [Admin::class, 'provinceUpdate'])->name('admin.provinces.update');
    Route::delete('/provinces/{id}', [Admin::class, 'provinceDestroy'])->name('admin.provinces.destroy');

    //industries
    Route::get('/industries', [Admin::class, 'industryIndex'])->name('admin.industries.index');
    Route::post('/industries', [Admin::class, 'industryStore'])->name('admin.industries.store');
    Route::get('/industries/{id}', [Admin::class, 'industryShow'])->name('admin.industries.show');
    Route::put('/industries/{id}', [Admin::class, 'industryUpdate'])->name('admin.industries.update');
    Route::delete('/industries/{id}', [Admin::class, 'industryDestroy'])->name('admin.industries.destroy');

    Route::post('/adminlogout', [Admin::class, 'logout'])->name('admin_logout');
});
Route::get('/ok', [Admin::class, 'ok'])->name('ok');





// Job Types
Route::get('/admin/job-types', [Admin::class, 'jobTypesIndex'])->name('admin.job-types.index');
Route::post('/admin/job-types', [Admin::class, 'jobTypesStore'])->name('admin.job-types.store');
Route::put('/admin/job-types/{id}', [Admin::class, 'jobTypesUpdate'])->name('admin.job-types.update');
Route::delete('/admin/job-types/{id}', [Admin::class, 'jobTypesDestroy'])->name('admin.job-types.destroy');



// Regencies
Route::get('/regencies', [Admin::class, 'regencyIndex'])->name('admin.regencies.index');
Route::post('/regencies', [Admin::class, 'regencyStore'])->name('admin.regencies.store');
Route::get('/regencies/{id}', [Admin::class, 'regencyShow'])->name('admin.regencies.show');
Route::put('/regencies/{id}', [Admin::class, 'regencyUpdate'])->name('admin.regencies.update');
Route::delete('/regencies/{id}', [Admin::class, 'regencyDestroy'])->name('admin.regencies.destroy');



// Login & Register User
Route::get('/', [Account::class, 'index'])->name('login');
Route::post('/user-validation', [Account::class, 'loginValidation'])->name('userValidation');
Route::get('/signup', [Account::class, 'signup'])->name('signup');
Route::post('/signup-save', [Account::class, 'signup_save'])->name('signup_save');

//OTP User
Route::get('/otp', [Account::class, 'otp'])->name('otp');
Route::post('/verify_otp', [Account::class, 'verify_otp'])->name('verify_otp');

//Forgot Password User
Route::get('password/forgot', [Account::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [Account::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('passwordReset/{token}', [Account::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [Account::class, 'reset'])->name('password.update');

Route::middleware('auth.token')->group(function () {
    Route::middleware(['check.company.industries'])->group(function () {
        Route::get('/dashboard', [User::class, 'index'])->name('dashboard_user');
        Route::get('/tambah-lowongan', [User::class, 'form_lowongan'])->name('form_lowongan');
        Route::get('/posting-lowongan', [User::class, 'posting_lowongan'])->name('posting_lowongan');
        Route::get('/detail-lowongan', [User::class, 'detail_lowongan'])->name('detail_lowongan');
        Route::get('/detail-pelamar', [User::class, 'detail_pelamar'])->name('detail_pelamar');
    });
    Route::get('/part-1', [Account::class, 'company_profile_part1'])->name('company_profile_part1');
    Route::post('/submit-part-1', [Account::class, 'submitCompany_profile_part1'])->name('submit_company_profile_part1');
    Route::get('/part-2', [Account::class, 'company_profile_part2'])->name('company_profile_part2');
    Route::post('/submit-part-2', [Account::class, 'submitCompany_profile_part2'])->name('submit_company_profile_part2');
    Route::post('/logout', [Account::class, 'logout'])->name('user_logout');

    Route::get('/proxy-image/logo/{path}', function ($path) {
        $url = "https://api.carikerjo.id/upload/logo/" . $path;

        // Gunakan Guzzle HTTP Client untuk mengambil gambar dari URL asli
        $client = new \GuzzleHttp\Client();
        $response = $client->get($url);

        return response($response->getBody(), 200)
            ->header('Content-Type', $response->getHeader('Content-Type')[0]);
    });

    Route::get('/proxy-image/gallery/{path}', function ($path) {
        $url = "https://api.carikerjo.id/upload/gallery/" . $path;

        // Gunakan Guzzle HTTP Client untuk mengambil gambar dari URL asli
        $client = new \GuzzleHttp\Client();
        $response = $client->get($url);

        return response($response->getBody(), 200)
            ->header('Content-Type', $response->getHeader('Content-Type')[0]);
    });
});

Route::get('/input', [Account::class, 'input'])->name('input');
