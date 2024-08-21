<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Home extends Controller
{
    public function index()
    {
        return view('user.home');
    }

    public function posting_lowongan()
    {
        return view('user.posting_lowongan');
    }

    public function detail_lowongan()
    {
        return view('user.detail_lowongan');
    }

    public function detail_pelamar()
    {
        return view('user.detail_pelamar');
    }

}
