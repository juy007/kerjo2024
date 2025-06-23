<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CompanyService
{
   
    protected $apiUser = 'https://api.carikerjo.id/users';
    protected $apiUserById = 'https://api.carikerjo.id/users/';

    protected $apiAuthLogin = 'https://api.carikerjo.id/auth/login';
    protected $apiAuthRegister = 'https://api.carikerjo.id/auth/register';
    protected $apiAuthForPassword = 'https://api.carikerjo.id/auth/forPassword';
    protected $apiAuthResetPassword = 'https://api.carikerjo.id/auth/resetPassword';
    protected $apiAuthVerifyOtp = 'https://api.carikerjo.id/auth/verifyOtp';
    protected $apiAuthRequestOtp = 'https://api.carikerjo.id/auth/requestOtp';
    protected $apiAuthOAuth2 = 'https://api.carikerjo.id/auth/OAuth2';
    protected $apiAuthGoogleCallback = 'https://api.carikerjo.id/auth/google/callback';
    protected $apiAuthMyProfile = 'https://api.carikerjo.id/auth/my-profile';
    protected $apiAuthMyProfileFilter = 'https://api.carikerjo.id/auth/my-profile-filter';
    protected $apiAuthRegisterCompany = 'https://api.carikerjo.id/auth/register-company';
    protected $apiAuthMyCompanyProfile = 'https://api.carikerjo.id/auth/my-company-profile';

    protected $apiJobStatus = 'https://api.carikerjo.id/job-statuses';
    protected $apiJobStatusById = 'https://api.carikerjo.id/job-statuses/';

    protected $apiJobLevel = 'https://api.carikerjo.id/job-levels';
    protected $apiJobLevelById = 'https://api.carikerjo.id/job-levels/';

    protected $apiJobType = 'https://api.carikerjo.id/job-types';
    protected $apiJobTypeById = 'https://api.carikerjo.id/job-types/';

    protected $apiCurrency = 'https://api.carikerjo.id/currencies';
    protected $apiCurrencyById = 'https://api.carikerjo.id/currencies/';

    protected $apiRegency = 'https://api.carikerjo.id/regencies';
    protected $apiRegencyById = 'https://api.carikerjo.id/regencies/';

    protected $apiProvince = 'https://api.carikerjo.id/provinces';
    protected $apiProvinceById = 'https://api.carikerjo.id/provinces/';

    protected $apiCategory = 'https://api.carikerjo.id/categories';
    protected $apiCategoryById = 'https://api.carikerjo.id/categories/';

    protected $apiSubCategory = 'https://api.carikerjo.id/sub-categories';
    protected $apiSubCategoryById = 'https://api.carikerjo.id/sub-categories/';

    protected $apiDatabase = 'https://api.carikerjo.id/database';

    protected $apiCv = 'https://api.carikerjo.id/cvs';
    protected $apiCvById = 'https://api.carikerjo.id/cvs/';
    protected $apiCvGenerateMy = 'https://api.carikerjo.id/cvs/generate-my-cv';
    protected $apiCvDefault = 'https://api.carikerjo.id/cvs/default-cv/';

    protected $apiEducation = 'https://api.carikerjo.id/educations';
    protected $apiEducationById = 'https://api.carikerjo.id/educations/';

    protected $apiExperience = 'https://api.carikerjo.id/experiences';
    protected $apiExperienceById = 'https://api.carikerjo.id/experiences/';

    protected $apiBookmarkMy = 'https://api.carikerjo.id/bookmarks/my-bookmarks';

    protected $apiNotification = 'https://api.carikerjo.id/notifications';
    protected $apiNotificationById = 'https://api.carikerjo.id/notifications/';
    protected $apiNotificationAccept = 'https://api.carikerjo.id/notifications/accept-notification';
    protected $apiNotificationDisable = 'https://api.carikerjo.id/notifications/disable-notification/';
    protected $apiNotificationMy = 'https://api.carikerjo.id/notifications/my-notification';

    protected $apiMediaUploadAvatar = 'https://api.carikerjo.id/medias/upload-avatar';
    protected $apiMediaUploadAvatarMobile = 'https://api.carikerjo.id/medias/upload-avatar-mobile';
    protected $apiMediaUploadLogo = 'https://api.carikerjo.id/medias/upload-logo';
    protected $apiMediaUploadGallery = 'https://api.carikerjo.id/medias/upload-gallery';
    protected $apiMediaUploadCv = 'https://api.carikerjo.id/medias/upload-cv';
    protected $apiMediaUploadCvMobile = 'https://api.carikerjo.id/medias/upload-cv-mobile';
    protected $apiMediaSlider = 'https://api.carikerjo.id/medias/slider';

    protected $apiIndustry = 'https://api.carikerjo.id/industries';
    protected $apiIndustryById = 'https://api.carikerjo.id/industries/';

    protected $apiCompany = 'https://api.carikerjo.id/companies';
    protected $apiCompanyById = 'https://api.carikerjo.id/companies/';

    protected $apiJob = 'https://api.carikerjo.id/jobs';
    protected $apiJobById = 'https://api.carikerjo.id/jobs/';

    protected $apiApplicationMy = 'https://api.carikerjo.id/applications/my-application';
    protected $apiApplicationByJob = 'https://api.carikerjo.id/applications/job/';
    protected $apiApplication = 'https://api.carikerjo.id/applications';
    protected $apiApplicationById = 'https://api.carikerjo.id/applications/';

    protected $apiMessage = 'https://api.carikerjo.id/messages';
    protected $apiMessageById = 'https://api.carikerjo.id/messages/';
    protected $apiMessageMy = 'https://api.carikerjo.id/messages/my-message';
    protected $apiMessageSend = 'https://api.carikerjo.id/messages/send-message';

    protected $apiSlider = 'https://api.carikerjo.id/slider';
    protected $apiSliderById = 'https://api.carikerjo.id/slider/';


    public function getUsers($token, $queryParams = [])
    {
        $userId = session('user_id') ?? 'guest';

        // Log sebelum request dikirim
        /*Log::channel('company_user')->info('Memulai request daftar user ke API', [
            'user_id' => $userId,
            'filters' => $queryParams,
            'page' => $page,
        ]);*/

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

    public function getCategories($token, $queryParams)
    {
        $userId = session('user_id') ?? 'guest';
        try {
            $response = Http::retry(3, 100)->withToken($token)->get($this->apiCategory, $queryParams);

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
            $response = Http::retry(3, 100)->withToken($token)->get($this->apiCategoryById . $id_categories);

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
            $response = Http::retry(3, 100)->withToken($token)->get($this->apiSubCategory);

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
            $response = Http::retry(3, 100)->withToken($token)->get($this->apiProvince, [
                'query' => 'jawa',
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
            $response = Http::retry(3, 100)->withToken($token)->get($this->apiProvinceById . $id_provinces);

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

    public function getJob($token, $queryParams = [])
    {
        $userId = session('user_id') ?? 'guest';

        try {
            $response = Http::retry(3, 100)->withToken($token)->get($this->apiJob, $queryParams);

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

    public function getJobsById($token, $id)
    {
        $userId = session('user_id') ?? 'guest';
        try {
            $response = Http::retry(3, 100)->withToken($token)->get($this->apiJobById . $id);
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

    public function getApplicationsByJob($token, $id)
    {
        $userId = session('user_id') ?? 'guest';
        try {
            $response = Http::retry(3, 100)->withToken($token)->get($this->apiApplicationByJob . $id);
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

    public function getRegenciesById($token, $id)
    {
        $userId = session('user_id') ?? 'guest';
        try {
            $response = Http::retry(3, 100)->withToken($token)->get($this->apiRegencyById . $id);
            if (!$response->successful()) {
                Log::channel('company_api_error')->warning('Get Regencies By Id', [
                    'user_id' => $userId,
                    'status_code' => $response->status(),
                    'response_body' => $response->body(),
                ]);
                return ['success' => false, 'message' => 'Gagal mengambil data Regencies dari API'];
            }

            return ['success' => true, 'data' => $response->json()['data']];
        } catch (\Exception $e) {
            Log::channel('company_api_error')->error('Get Regencies', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
            ]);
            return ['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data Regencies'];
        }
    }
}
