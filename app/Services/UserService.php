<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class UserService
{
    protected $apiUrl = 'https://api.carikerjo.id/users';

    public function getUsers($token, $filters = [], $page = 1)
    {
        $queryParams = array_merge($filters,[
            'limit' => 1, // Menentukan jumlah data per halaman
            'page' => $page,
        ]);

        $response = Http::withToken($token)->get($this->apiUrl, $queryParams);

        if (!$response->successful()) {
            return ['success' => false, 'message' => 'Gagal mengambil data dari API'];
        }

        return ['success' => true, 'data' => $response->json()['data']];
    }
}
