<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Akun;
use App\Http\Controllers\Home;

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


// Login & Register
Route::get('/login', [Akun::class, 'index'])->name('login');
Route::get('/signup', [Akun::class, 'signup'])->name('signup');
Route::post('/part-1', [Akun::class, 'profile_perusahaan_part1'])->name('profile_perusahaan_part1');
Route::get('/part-2', [Akun::class, 'profile_perusahaan_part2'])->name('profile_perusahaan_part2');

//Home Page
Route::get('/', [Home::class, 'index'])->name('home1');
Route::get('/home', [Home::class, 'index'])->name('home');
Route::get('/posting-lowongan', [Home::class, 'posting_lowongan'])->name('posting_lowongan');
Route::get('/detail-lowongan', [Home::class, 'detail_lowongan'])->name('detail_lowongan');
Route::get('/detail-pelamar', [Home::class, 'detail_pelamar'])->name('detail_pelamar');
