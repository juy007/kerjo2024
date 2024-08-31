<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class Akun extends Controller
{
    public function index()
    {
        // Mendapatkan data dari model
       // $data = NamaModel::all();

        // Mengembalikan view dengan data yang diambil
        return view('form_login.form_login');
    }

    public function signup()
    {
        // Mendapatkan data dari model
       // $data = NamaModel::all();

        // Mengembalikan view dengan data yang diambil
        return view('form_login.form_signup');
    }

    public function profile_perusahaan_part1(Request $request)
    {
        return view('form_login.profile_perusahaan_part1');
    }

    public function profile_perusahaan_part2()
    {
        return view('form_login.profile_perusahaan_part2');
    }
}
