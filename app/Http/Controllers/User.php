<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class User extends Controller
{
    public function index()
    {
        return view('user.home');
    }

    public function form_lowongan()
    {
        return view('user.form_lowongan');
    }

    public function posting_lowongan()
    {
        return view('user.posting_lowongan');
    }

    public function detail_lowongan()
    {
        //return view('user.detail_lowongan');
        return view('user.detail_lowongan');
    }

    public function detail_pelamar()
    {
        return view('user.detail_pelamar');
    }
}
