<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class AdminService
{
    protected $apiUser = 'https://api.carikerjo.id/users';
    protected $apiCompanies = 'https://api.carikerjo.id/companies';
    protected $apiJobs = 'https://api.carikerjo.id/jobs';

    protected $apiSubcateories = 'https://api.carikerjo.id/sub-categories';
    protected $apiProvinces = 'https://api.carikerjo.id/provinces';
    

    public function getUsers($token, $filters = [], $page = 1)
    {
        try {
            $response = Http::retry(3, 100)->withToken($token)->get($this->apiUser);

            if (!$response->successful()) {
                return ['success' => false, 'message' => 'Gagal mengambil data dari API'];
            }
            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data user'];
        }
    }

    public function getCompanies($token, $filters = [], $page = 1)
    {
        try {
            $response = Http::retry(3, 100)->withToken($token)->get($this->apiCompanies);

            if (!$response->successful()) {
                return ['success' => false, 'message' => 'Gagal mengambil data dari API'];
            }
            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data user'];
        }
    }

    public function getJob($token, $filters = [], $page = 1)
    {
        try {
            $response = Http::retry(3, 100)->withToken($token)->get($this->apiJobs);
            if (!$response->successful()) {
                return ['success' => false, 'message' => 'Gagal mengambil data dari API'];
            }
            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data Job'];
        }
    }

    

    public function getSubCategories($token)
    {
        $userId = session('user_id') ?? 'guest';
        try {
            $response = Http::retry(3, 100)->withToken($token)->get($this->apiSubcateories);

            if (!$response->successful()) {
                Log::channel('company_api_error')->warning('Get Categories', [
                    'user_id' => $userId,
                    'status_code' => $response->status(),
                    'response_body' => $response->body(),
                ]);
                return ['success' => false, 'message' => 'Gagal mengambil data subkategori dari API'];
            }

            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            Log::channel('company_api_error')->error('Get Categories', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
            ]);
            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data subkategori'];
        }
    }

    public function getProvinces($token)
    {
        $userId = session('user_id') ?? 'guest';
        try {
            $response = Http::retry(3, 100)->withToken($token)->get($this->apiProvinces, [
                'limit' => 100,
            ]);

            if (!$response->successful()) {
                Log::channel('company_api_error')->warning('Get Provinces', [
                    'user_id' => $userId,
                    'status_code' => $response->status(),
                    'response_body' => $response->body(),
                ]);
                return ['success' => false, 'message' => 'Gagal mengambil data provinsi dari API'];
            }

            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            Log::channel('company_api_error')->error('Get Provinces', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
            ]);
            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data provinsi'];
        }
    }

  

    public function getCurrencies($token)
    {
        $userId = session('user_id') ?? 'guest';
        try {
            $response = Http::retry(3, 100)->withToken($token)->get('https://api.carikerjo.id/currencies', [
                'limit' => 100,
            ]);

            if (!$response->successful()) {
                Log::channel('company_api_error')->warning('Get Currencies', [
                    'user_id' => $userId,
                    'status_code' => $response->status(),
                    'response_body' => $response->body(),
                ]);
                return ['success' => false, 'message' => 'Gagal mengambil data mata uang dari API'];
            }

            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            Log::channel('company_api_error')->error('Get Currencies', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
            ]);
            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data mata uang'];
        }
    }

    public function getJobStatuses($token)
    {
        $userId = session('user_id') ?? 'guest';
        try {
            $response = Http::retry(3, 100)->withToken($token)->get('https://api.carikerjo.id/job-statuses', [
                'limit' => 100,
            ]);

            if (!$response->successful()) {
                Log::channel('company_api_error')->warning('Get Job Statuses', [
                    'user_id' => $userId,
                    'status_code' => $response->status(),
                    'response_body' => $response->body(),
                ]);
                return ['success' => false, 'message' => 'Gagal mengambil data status pekerjaan dari API'];
            }

            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            Log::channel('company_api_error')->error('Get Job Statuses', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
            ]);
            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data status pekerjaan'];
        }
    }

    public function getJobTypes($token)
    {
        $userId = session('user_id') ?? 'guest';
        try {
            $response = Http::retry(3, 100)->withToken($token)->get('https://api.carikerjo.id/job-types', [
                'limit' => 100,
            ]);

            if (!$response->successful()) {
                Log::channel('company_api_error')->warning('Get Job Types', [
                    'user_id' => $userId,
                    'status_code' => $response->status(),
                    'response_body' => $response->body(),
                ]);
                return ['success' => false, 'message' => 'Gagal mengambil data tipe pekerjaan dari API'];
            }

            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            Log::channel('company_api_error')->error('Get Job Types', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
            ]);
            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data tipe pekerjaan'];
        }
    }

    public function getJobLevels($token)
    {
        $userId = session('user_id') ?? 'guest';
        try {
            $response = Http::retry(3, 100)->withToken($token)->get('https://api.carikerjo.id/job-levels');

            if (!$response->successful()) {
                Log::channel('company_api_error')->warning('Get Job Levels', [
                    'user_id' => $userId,
                    'status_code' => $response->status(),
                    'response_body' => $response->body(),
                ]);
                return ['success' => false, 'message' => 'Gagal mengambil data level pekerjaan dari API'];
            }

            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            Log::channel('company_api_error')->error('Get Job Levels', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
            ]);
            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data level pekerjaan'];
        }
    }
}
