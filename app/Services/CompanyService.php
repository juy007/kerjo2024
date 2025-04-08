<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CompanyService
{
    protected $apiUser = 'https://api.carikerjo.id/users';
    protected $apiSubcateories = 'https://api.carikerjo.id/sub-categories';
    protected $apiProvinces = 'https://api.carikerjo.id/provinces';

    public function getUsers($token, $filters = [], $page = 1)
    {
        $userId = session('user_id') ?? 'guest';

        // Log sebelum request dikirim
        Log::channel('company_user')->info('Memulai request daftar user ke API', [
            'user_id' => $userId,
            'filters' => $filters,
            'page' => $page,
        ]);

        $queryParams = array_merge($filters, [
            'limit' => 1,
            'page' => $page,
        ]);

        try {
            $response = Http::retry(3, 100)->withToken($token)->timeout(10)->get($this->apiUser, $queryParams);

            if (!$response->successful()) {
                Log::channel('company_user')->warning('Gagal mendapatkan data user dari API', [
                    'user_id' => $userId,
                    'status_code' => $response->status(),
                    'response_body' => $response->body(),
                ]);

                return ['success' => false, 'message' => 'Gagal mengambil data dari API'];
            }

            Log::channel('company_user')->info('Berhasil mendapatkan data user dari API', [
                'user_id' => $userId,
                'status_code' => $response->status(),
            ]);

            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            // Log jika terjadi error (timeout, DNS, dll)
            Log::channel('company_user')->error('Exception saat mengambil data user dari API', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
            ]);

            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data user'];
        }
    }

    public function getSubCategories($token)
    {
        try {
            $response = Http::retry(3, 100)->withToken($token)->get($this->apiSubcateories);

            if (!$response->successful()) {
                return ['success' => false, 'message' => 'Gagal mengambil data subkategori dari API'];
            }

            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data subkategori'];
        }
    }

    public function getProvinces($token)
    {
        try {
            $response = Http::retry(3, 100)->withToken($token)->get($this->apiProvinces, [
                'limit' => 100,
            ]);

            if (!$response->successful()) {
                return ['success' => false, 'message' => 'Gagal mengambil data provinsi dari API'];
            }

            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data provinsi'];
        }
    }


}
