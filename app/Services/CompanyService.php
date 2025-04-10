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
    protected $apiJobs = 'https://api.carikerjo.id/jobs';

    public function getUsers($token, $filters = [], $page = 1)
    {
        $userId = session('user_id') ?? 'guest';

        // Log sebelum request dikirim
        /*Log::channel('company_user')->info('Memulai request daftar user ke API', [
            'user_id' => $userId,
            'filters' => $filters,
            'page' => $page,
        ]);*/

        $queryParams = array_merge($filters, [
            'limit' => 20,
            'page' => $page,
        ]);

        try {
            $response = Http::retry(3, 100)->withToken($token)->get($this->apiUser, $queryParams);

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

    public function getJob($token, $filters = [], $page = 1)
    {
        $userId = session('user_id') ?? 'guest';

        $queryParams = array_merge($filters, [
            'limit' => 20,
            'page' => $page,
        ]);

        try {
            $response = Http::retry(3, 100)->withToken($token)->get($this->apiJobs, $queryParams);

            if (!$response->successful()) {
                Log::channel('company_user')->warning('Gagal mendapatkan data Job dari API', [
                    'user_id' => $userId,
                    'status_code' => $response->status(),
                    'response_body' => $response->body(),
                ]);

                return ['success' => false, 'message' => 'Gagal mengambil data dari API'];
            }

            Log::channel('company_user')->info('Berhasil mendapatkan data JOb dari API', [
                'user_id' => $userId,
                'status_code' => $response->status(),
            ]);

            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            // Log jika terjadi error (timeout, DNS, dll)
            Log::channel('company_user')->error('Exception saat mengambil data Job dari API', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
            ]);

            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data Job'];
        }
    }

    public function getCurrencies($token)
    {
        try {
            $response = Http::retry(3, 100)->withToken($token)->get('https://api.carikerjo.id/currencies', [
                'limit' => 100,
            ]);

            if (!$response->successful()) {
                return ['success' => false, 'message' => 'Gagal mengambil data mata uang dari API'];
            }

            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data mata uang'];
        }
    }

    public function getJobStatuses($token)
    {
        try {
            $response = Http::retry(3, 100)->withToken($token)->get('https://api.carikerjo.id/job-statuses', [
                'limit' => 100,
            ]);

            if (!$response->successful()) {
                return ['success' => false, 'message' => 'Gagal mengambil data status pekerjaan dari API'];
            }

            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data status pekerjaan'];
        }
    }

    public function getJobTypes($token)
    {
        try {
            $response = Http::retry(3, 100)->withToken($token)->get('https://api.carikerjo.id/job-types', [
                'limit' => 100,
            ]);

            if (!$response->successful()) {
                return ['success' => false, 'message' => 'Gagal mengambil data tipe pekerjaan dari API'];
            }

            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data tipe pekerjaan'];
        }
    }

    public function getJobLevels($token)
    {
        try {
            $response = Http::retry(3, 100)->withToken($token)->get('https://api.carikerjo.id/job-levels');

            if (!$response->successful()) {
                return ['success' => false, 'message' => 'Gagal mengambil data level pekerjaan dari API'];
            }

            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data level pekerjaan'];
        }
    }
}
