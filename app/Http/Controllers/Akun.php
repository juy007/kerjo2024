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
}
