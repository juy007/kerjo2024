<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CompanyService
{
    protected $apiUser = 'https://api.carikerjo.id/users';
    protected $apicategories = 'https://api.carikerjo.id/categories';
    protected $apicategoriesDetail = 'https://api.carikerjo.id/categories/';
    protected $apiSubcategories = 'https://api.carikerjo.id/sub-categories';
    protected $apiProvinces = 'https://api.carikerjo.id/provinces';
    protected $apiProvincesDetail = 'https://api.carikerjo.id/provinces/';
    protected $apiJobs = 'https://api.carikerjo.id/jobs';

    public function getUsers($token, $filter_user = [], $page = 1)
    {
        $userId = session('user_id') ?? 'guest';

        // Log sebelum request dikirim
        /*Log::channel('company_user')->info('Memulai request daftar user ke API', [
            'user_id' => $userId,
            'filters' => $filters,
            'page' => $page,
        ]);*/

        $queryParams = array_merge($filter_user, [
            'limit' => 50,
            'page' => $page,
        ]);

        try {
            $response = Http::retry(3, 100)->withToken($token)->get($this->apiUser, $queryParams);

            if (!$response->successful()) {
                Log::channel('company_api_error')->warning('Get User', [
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
            Log::channel('company_api_error')->error('Get User', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
            ]);

            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data user'];
        }
    }

    public function getCategories($token)
    {
        $userId = session('user_id') ?? 'guest';
        try {
            $response = Http::retry(3, 100)->withToken($token)->get($this->apicategories, ['limit' => 500]);

            if (!$response->successful()) {
                Log::channel('company_api_error')->warning('Get Categories', [
                    'user_id' => $userId,
                    'status_code' => $response->status(),
                    'response_body' => $response->body(),
                ]);
                return ['success' => false, 'message' => 'Gagal mengambil data kategori dari API'];
            }

            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            Log::channel('company_api_error')->error('Get Categories', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
            ]);
            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data kategori'];
        }
    }

    public function getCategoriesDetail($token, $id_categories)
    {
        $userId = session('user_id') ?? 'guest';
        try {
            $response = Http::retry(3, 100)->withToken($token)->get($this->apicategoriesDetail . $id_categories);

            if (!$response->successful()) {
                Log::channel('company_api_error')->warning('Get Categories', [
                    'user_id' => $userId,
                    'status_code' => $response->status(),
                    'response_body' => $response->body(),
                ]);
                return ['success' => false, 'message' => 'Gagal mengambil data detail kategori dari API'];
            }

            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            Log::channel('company_api_error')->error('Get Categories', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
            ]);
            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data kategori'];
        }
    }

    public function getSubCategories($token)
    {
        $userId = session('user_id') ?? 'guest';
        try {
            $response = Http::retry(3, 100)->withToken($token)->get($this->apiSubcategories);

            if (!$response->successful()) {
                Log::channel('company_api_error')->warning('Get Categories', [
                    'user_id' => $userId,
                    'status_code' => $response->status(),
                    'response_body' => $response->body(),
                ]);
                return ['success' => false, 'message' => 'Gagal mengambil data sub kategori dari API'];
            }

            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            Log::channel('company_api_error')->error('Get Categories Detail', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
            ]);
            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data sub kategori'];
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

    public function getProvincesDetail($token, $id_provinces)
    {
        $userId = session('user_id') ?? 'guest';
        try {
            $response = Http::retry(3, 100)->withToken($token)->get($this->apiProvincesDetail . $id_provinces);

            if (!$response->successful()) {
                Log::channel('company_api_error')->warning('Get Provinces Detail', [
                    'user_id' => $userId,
                    'status_code' => $response->status(),
                    'response_body' => $response->body(),
                ]);
                return ['success' => false, 'message' => 'Gagal mengambil data detail provinsi dari API'];
            }

            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            Log::channel('company_api_error')->error('Get Provinces Detail', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
            ]);
            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil detail provinsi'];
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
                Log::channel('company_api_error')->warning('Get Job', [
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
            Log::channel('company_api_error')->error('Get Job', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
            ]);

            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data Job'];
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

    public function getJobs($token, $id)
    {
        $userId = session('user_id') ?? 'guest';
        try {
            $response = Http::retry(3, 100)->withToken($token)->get($this->apiJobs."/{$id}");
            if (!$response->successful()) {
                Log::channel('company_api_error')->warning('Get Jobs', [
                    'user_id' => $userId,
                    'status_code' => $response->status(),
                    'response_body' => $response->body(),
                ]);
                return ['success' => false, 'message' => 'Gagal mengambil data Jobs dari API'];
            }

            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            Log::channel('company_api_error')->error('Get Job Levels', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
            ]);
            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data Job'];
        }
    }
}
