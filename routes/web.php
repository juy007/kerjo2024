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

    //companies
    Route::get('/companies', [Admin::class, 'companyIndex'])->name('admin.companies.index');
    Route::post('/companies', [Admin::class, 'companyStore'])->name('admin.companies.store');
    Route::get('/companies/{id}', [Admin::class, 'companyShow'])->name('admin.companies.show');
    Route::put('/companies/{id}', [Admin::class, 'companyUpdate'])->name('admin.companies.update');
    Route::delete('/companies/{id}', [Admin::class, 'companyDestroy'])->name('admin.companies.destroy');

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

    // Job Types
    Route::get('/admin/job-types', [Admin::class, 'jobTypesIndex'])->name('admin.job-types.index');
    Route::post('/admin/job-types', [Admin::class, 'jobTypesStore'])->name('admin.job-types.store');
    Route::put('/admin/job-types/{id}', [Admin::class, 'jobTypesUpdate'])->name('admin.job-types.update');
    Route::delete('/admin/job-types/{id}', [Admin::class, 'jobTypesDestroy'])->name('admin.job-types.destroy');

    //categories
    Route::get('/categories', [Admin::class, 'categoryIndex'])->name('admin.categories.index');
    Route::post('/categories', [Admin::class, 'categoryStore'])->name('admin.categories.store');
    Route::put('/categories/{id}', [Admin::class, 'categoryUpdate'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [Admin::class, 'categoryDestroy'])->name('admin.categories.destroy');

    //Sub Categories
    Route::get('/sub-categories/{id}', [Admin::class, 'subCategoryIndex'])->name('admin.sub-categories.show');
    Route::post('/sub-categories', [Admin::class, 'subCategoryStore'])->name('admin.sub-categories.store');  // Menyimpan subcategory baru
    Route::put('/sub-categories/{id}', [Admin::class, 'subCategoryUpdate'])->name('admin.sub-categories.update');  // Update subcategory
    Route::delete('/sub-categories/{id}', [Admin::class, 'subCategoryDestroy'])->name('admin.sub-categories.destroy');  // Hapus subcategory

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

    //currencies
    Route::get('/currencies', [Admin::class, 'currenciesIndex'])->name('admin.currencies.index');
    Route::post('/currencies', [Admin::class, 'currenciesStore'])->name('admin.currencies.store');
    Route::put('/currencies/{id}', [Admin::class, 'currenciesUpdate'])->name('admin.currencies.update');
    Route::delete('/currencies/{id}', [Admin::class, 'currenciesDestroy'])->name('admin.currencies.destroy');

    Route::get('/proxy-image/logo/{path}', function ($path) {
        $url = "https://api.carikerjo.id/upload/logo/" . $path;

        // Gunakan Guzzle HTTP Client untuk mengambil gambar dari URL asli
        $client = new \GuzzleHttp\Client();
        $response = $client->get($url);

        return response($response->getBody(), 200)
            ->header('Content-Type', $response->getHeader('Content-Type')[0]);
    });

    Route::post('/adminlogout', [Admin::class, 'logout'])->name('admin_logout');
});
Route::get('/ok', [Admin::class, 'ok'])->name('ok');

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

        Route::get('/job', [User::class, 'indexJob'])->name('index_job');
        Route::get('/tambah-job', [User::class, 'formJob'])->name('form_job');
        Route::post('/save-job', [User::class, 'saveJob'])->name('save_job');
        Route::get('/edit-job/{id}', [User::class, 'editJob'])->name('edit_job');
        Route::put('/save-update-job/{id}', [User::class, 'saveUpdateJob'])->name('save_update_job');
        Route::delete('/delete-job/{id}', [User::class, 'deleteJob'])->name('delete_job');
        Route::get('/detail-job', [User::class, 'detail_Job'])->name('detail_job');

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

// Login & Register User
Route::get('/db', [Account::class, 'dbNotFound'])->name('db_error');
Route::get('/input', [Account::class, 'input'])->name('input');
