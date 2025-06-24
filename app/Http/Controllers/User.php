<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

use App\Mail\OtpMail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Collection;

use Livewire\Component;
use App\Services\CompanyService;


class User extends Controller
{
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function index()
    {
        return view('user.home');
    }

    public function formJob(CompanyService $companyService)
    {
        $token = Session::get('api_token');

        try {
            $provinces = $companyService->getProvinces($token);
            $currencies = $companyService->getCurrencies($token);
            $categories = $companyService->getCategories($token, ['query' => 'buruh', 'limit' => 500]);
            $jobStatuses = $companyService->getJobStatuses($token);
            $jobTypes = $companyService->getJobTypes($token);
            $jobLevels = $companyService->getJobLevels($token);

            // Cek apakah semua request sukses
            /*if (
                !$provinces['success'] || !$currencies['success'] || !$categories['success'] ||
                !$jobStatuses['success'] || !$jobTypes['success'] || !$jobLevels['success']
            ) {
                session()->flash('notifAPI', 'Halaman Form Job');
                return view('user.api_error');
            }
            */
            return view('user.form_job', [
                'provinces'     => $provinces['data'],
                'currencies'    => $currencies['data'],
                'categories'    => $categories['data'],
                'jobStatuses'   => $jobStatuses['data'],
                'jobTypes'      => $jobTypes['data'],
                'jobLevels'     => $jobLevels['data'],
            ]);
        } catch (\Exception $e) {
            Log::channel('company_api_error')->info('Form Job.', ['error_api' =>  $e->getMessage(),]);
            session()->flash('notifAPI', 'Halaman Form Job');
            return view('user.api_error');
            //echo "Terjadi error: " . $e->getMessage() . "<br>"; echo "Di file: " . $e->getFile() . " pada baris " . $e->getLine() . "<br>";echo "<pre>" . $e->getTraceAsString() . "</pre>";
        }
    }

    public function categoriesDetailJson(CompanyService $companyService, Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id_categories' => 'required',
            'string',
            'max:255',
        ]);

        $token = Session::get('api_token');
        $categoryId = $validated['id_categories'];

        try {
            $subCategories = /*Cache::remember("subcategories_{$categoryId}", now()->addMinutes(30), function () use ($companyService, $token, $categoryId) {
                return */ $companyService->getCategoriesDetail($token, $categoryId);
            //});
            return response()->json([
                'success' => true,
                'subCategories' => collect($subCategories['data']['subCategories'] ?? [])->map(function ($sub) {
                    return [
                        '_id' => $sub['_id'],
                        'name' => $sub['name'],
                    ];
                })->values(),
            ]);
        } catch (\Throwable $e) {
            Log::channel('company_api_error')->error('Gagal mengambil subkategori', [
                'kategori_id' => $categoryId,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil subkategori.'
            ], 500);
        }
    }

    public function provincesDetailJson(CompanyService $companyService, Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id_provinces' => 'required',
            'string',
            'max:255',
        ]);

        $token = Session::get('api_token');
        $provincesId = $validated['id_provinces'];

        try {
            $provinces = /*Cache::remember("subcategories_{$categoryId}", now()->addMinutes(30), function () use ($companyService, $token, $categoryId) {
                return */ $companyService->getProvincesDetail($token, $provincesId);
            //});
            return response()->json([
                'success' => true,
                'regencies' => collect($provinces['data']['regencies'] ?? [])->map(function ($sub) {
                    return [
                        '_id' => $sub['_id'],
                        'name' => $sub['name'],
                    ];
                })->values(),
            ]);
        } catch (\Throwable $e) {
            Log::channel('company_api_error')->error('Gagal mengambil subkategori', [
                'kategori_id' => $provincesId,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil subkategori.'
            ], 500);
        }
    }


    public function saveJob(Request $request)
    {
        $request->merge([
            'gaji_min' => str_replace('.', '', $request->input('gaji_min')),
            'gaji_max' => str_replace('.', '', $request->input('gaji_max')),
            'date_start' => Carbon::parse($request->input('date_start'))->startOfDay()->toIso8601ZuluString(),
            'date_end' => Carbon::parse($request->input('date_end'))->startOfDay()->toIso8601ZuluString(),
        ]);

        $validated = $request->validate([
            'lowongan' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'sub_kategori' => 'required|string|max:255',
            'mata_uang' => 'required|string|max:255',
            'gaji_min' => 'required|numeric',
            'gaji_max' => 'required|numeric',
            'frekuensi_pembayaran' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'tipe_pekerjaan' => 'required|string|max:255',
            'status_karyawan' => 'required|string|max:255',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'posisi_level' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'detail' => 'required|string',
            'kualifikasi' => 'required|string',
            'status' => 'required|string|max:255',
        ]);

        // Ambil token dari session
        $token = session('api_token');
        try {
            // Kirim request POST ke API
            $response = Http::withToken($token)->post('https://api.carikerjo.id/jobs', [
                'title' => $validated['lowongan'],
                'categoryId' => $validated['kategori'],
                'subCategoryId' => $validated['sub_kategori'],
                'companyId' => Session::get('company_id'),
                'provinceId' => $validated['provinsi'],
                'regencyId' => $validated['kota'],
                'jobTypeId' => $validated['tipe_pekerjaan'],
                'jobStatusId' => $validated['status_karyawan'],
                'currencyId' => $validated['mata_uang'],
                'startDate' => $validated['date_start'],
                'endDate' => $validated['date_end'],
                'salaryStart' => $validated['gaji_min'],
                'salaryEnd' => $validated['gaji_max'],
                'salaryFrequency' => $validated['frekuensi_pembayaran'],
                'jobLevelId' => $validated['posisi_level'],
                'description' => $validated['deskripsi'],
                'detail' => $validated['detail'],
                'qualification' => $validated['kualifikasi'],
                "display" => true,
                'status' => $validated['status'],
            ]);

            if ($response->successful()) {
                return redirect()->route('form_job')->with('success', 'Lowongan Berhasil Ditambahkan');
            } //echo $response->body();
            return redirect()->back()->with('error', 'Lowongan Gagal Ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Tidak terhubung ke server');
        }
    }


    public function indexJob(Request $request)
    {
        $token = session('api_token');
        $requestedPage = filter_var($request->query('page', 1), FILTER_VALIDATE_INT) ?: 1;

        // Siapkan parameter query awal
        $queryParams = [
            'query'      => $request->query('nama', ''),
            'salary'     => str_replace('.', '', $request->query('gaji', '')),
            'location'   => $request->query('lokasi', ''),
            'categories' => $request->query('kategori', ''),
            'limit'      => 50,
            'page'       => $requestedPage,
        ];

        // Ambil halaman 1 untuk cek totalPages
        $initialResponse = $this->companyService->getJob($token, $queryParams);
        $subcategories = $this->companyService->getSubCategories($token);
        $provinces = $this->companyService->getProvinces($token);

        // Validasi respons API
        if (!$initialResponse['success'] || !$subcategories['success'] || !$provinces['success']) {
            session()->flash('notifAPI', 'Halaman Data Lowongan');
            return view('user.api_error');
        }

        $totalPages = $initialResponse['data']['totalPages'] ?? 1;

        // Validasi halaman aktif
        $page = min($requestedPage, $totalPages);
        $queryParams['page'] = $page; // update page yang valid

        // Ambil data halaman valid
        $response = ($page == 1)
            ? $initialResponse
            : $this->companyService->getJob($token, $queryParams);

        $dataJob = $response['data'] ?? [];
        $currentPage = $page;
        $subcategories = $subcategories['data'];
        $provinces = $provinces['data'];
        //echo "<pre>"; print_r($dataJob); echo "</pre>";
        return view('user.posting_job', compact('dataJob', 'subcategories', 'provinces', 'currentPage', 'totalPages', 'queryParams'));
    }

    public function editJob(CompanyService $companyService, $id)
    {
        $token = Session::get('api_token');
        try {
            $provinces = $companyService->getProvinces($token);
            $currencies = $companyService->getCurrencies($token);
            $categories = $companyService->getCategories($token, ['query' => 'buruh', 'limit' => 500]);
            $jobStatuses = $companyService->getJobStatuses($token);
            $jobTypes = $companyService->getJobTypes($token);
            $jobLevels = $companyService->getJobLevels($token);
            $jobs = $companyService->getJobsById($token, $id);
            $regencies = $companyService->getRegenciesById($token, $jobs['data']['regency']);
            $categoriesDetail = $companyService->getCategoriesDetail($token, $jobs['data']['subCategory']['category']['_id']);
            $provinceDetail = $companyService->getProvincesDetail($token, $jobs['data']['province']['_id']);

            if (!$provinces['success'] || !$currencies['success'] || !$jobStatuses['success'] || !$jobTypes['success'] || !$jobLevels['success'] || !$jobs['success'] || !$regencies['success'] || !$categoriesDetail['success'] || !$provinceDetail['success']) {
                session()->flash('notifAPI', 'Halaman Form Job');
                return view('user.api_error');
            }

            //echo '<pre>';print_r($regencies['data']); echo '</pre>';
            return view('user.form_edit_job', compact('categories', 'categoriesDetail', 'provinces', 'regencies', 'provinceDetail', 'currencies',  'jobStatuses', 'jobTypes', 'jobLevels', 'jobs'));
        } catch (\Exception $e) {
            //echo "Terjadi error: " . $e->getMessage() . "<br>"; echo "Di file: " . $e->getFile() . " pada baris " . $e->getLine() . "<br>";echo "<pre>" . $e->getTraceAsString() . "</pre>";
            session()->flash('notifAPI', 'Halaman Form Job');
            return view('user.api_error');
        }
    }

    public function saveUpdateJob(Request $request, $id)
    {
        $request->merge([
            'gaji_min' => str_replace('.', '', $request->input('gaji_min')),
            'gaji_max' => str_replace('.', '', $request->input('gaji_max')),
            'date_start' => Carbon::parse($request->input('date_start'))->startOfDay()->toIso8601ZuluString(),
            'date_end' => Carbon::parse($request->input('date_end'))->startOfDay()->toIso8601ZuluString(),
        ]);

        $validated = $request->validate([
            'lowongan' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'sub_kategori' => 'required|string|max:255',
            'mata_uang' => 'required|string|max:255',
            'gaji_min' => 'required|numeric',
            'gaji_max' => 'required|numeric',
            'frekuensi_pembayaran' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'tipe_pekerjaan' => 'required|string|max:255',
            'status_karyawan' => 'required|string|max:255',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'posisi_level' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'detail' => 'required|string',
            'kualifikasi' => 'required|string',
            'status' => 'required|string|max:255',
        ]);
        /*echo '<pre>';
        print_r($validated);
        echo '</pre>';*/

        // Ambil token dari session
        $token = session('api_token');
        try {
            $response = Http::withToken($token)->retry(3, 100)->put("https://api.carikerjo.id/jobs/{$id}", [
                'title' => $validated['lowongan'],
                'categoryId' => $validated['kategori'],
                'subCategoryId' => $validated['sub_kategori'],
                'companyId' => Session::get('company_id'),
                'provinceId' => $validated['provinsi'],
                'regencyId' => $validated['kota'],
                'jobTypeId' => $validated['tipe_pekerjaan'],
                'jobStatusId' => $validated['status_karyawan'],
                'currencyId' => $validated['mata_uang'],
                'startDate' => $validated['date_start'],
                'endDate' => $validated['date_end'],
                'salaryStart' => $validated['gaji_min'],
                'salaryEnd' => $validated['gaji_max'],
                'salaryFrequency' => $validated['frekuensi_pembayaran'],
                'jobLevelId' => $validated['posisi_level'],
                'description' => $validated['deskripsi'],
                'detail' => $validated['detail'],
                'qualification' => $validated['kualifikasi'],
                "display" => true,
                'status' => $validated['status'],
            ]);

            if ($response->successful()) {
                return redirect()->route('edit_job', $id)->with('success', 'Lowongan Berhasil Diupdate');
            }
            return redirect()->back()->with('error', 'Lowongan Gagal Diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Tidak terhubung ke server');
        }
    }

    public function deleteJob($id)
    {
        $token = session('api_token');
        try {
            $response = Http::withToken($token)->delete("https://api.carikerjo.id/jobs/{$id}");

            if ($response->successful()) {
                return redirect()->route('index_job')->with('success', 'Job berhasil dihapus');
            }

            return redirect()->back()->with('error', 'Gagal menghapus Job');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Tidak terhubung ke server');
        }
    }

    public function detailJob(CompanyService $companyService, $id)
    {
        $token = session('api_token');
        try {
            $jobs = $companyService->getJobsById($token, $id);
            $regencies = $companyService->getRegenciesById($token, $jobs['data']['regency']);
            $applications = $companyService->getApplicationsByJob($token, $id);

            if (!$jobs['success'] || !$regencies['success'] || !$applications['success']) {
                session()->flash('notifAPI', 'Halaman Detail Job');
                return view('user.api_error');
            }
            // $applications = $applications['data'];
            //echo $applications."<br><br><br><br>";
            // echo "<pre>";print_r($applications);echo "</pre>";
            return view('user.detail_job', compact('jobs', 'regencies', 'applications'));
        } catch (\Exception $e) {
            session()->flash('notifAPI', 'Halaman Detail Job');
            return view('user.api_error');
        }
    }

    public function saveUpdateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'userId' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'jobId' => 'required|string|max:255',
        ]);

        // Ambil token dari session
        $token = session('api_token');
        try {
            // Kirim request POST ke API
            $response = Http::withToken($token)->put("https://api.carikerjo.id/applications/{$id}", [
                'status' => $validated['status'],
                'userId' => $validated['userId'],
            ]);

            if ($response->successful()) {
                return redirect()->route('detail_job', $validated['jobId'])->with('success', 'Update Berhasil');
            }
            return redirect()->back()->with('error', 'Update gagal');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Tidak terhubung ke server');
        }
    }

    public function detail_pelamar(CompanyService $companyService, $id, $jobId)
    {

        $token = session('api_token');
        try {
            $response = Http::withToken($token)->retry(3, 100)->get("https://api.carikerjo.id/applications/job/{$jobId}");

            if (!$response->successful()) {
                session()->flash('notifAPI', 'Halaman Detail Pelamar');
                return view('user.api_error');
            }

            $applications = $response->json('data');
            $userData = collect($applications)->firstWhere('_id', $id);

            // Ambil data provinsi
            $provinces = '-';
            if (!empty($userData['user']['provinces'][0])) {
                $provinceId = $userData['user']['provinces'][0];
                $provinceResponse = app(CompanyService::class)->getProvincesDetail($token, $provinceId);
                $provinces = $provinceResponse['data']['name'] ?? '-';
            }

            return view('user.detail_pelamar', compact('userData', 'provinces'));
        } catch (\Exception $e) {
            session()->flash('notifAPI', 'Halaman Detail Pelamar');
            return view('user.api_error');
        }
    }

    //User
    /*public function indexUser(Request $request)
    {
        $token = session('api_token');
        $requestedPage = filter_var($request->query('page', 1), FILTER_VALIDATE_INT) ?: 1;

        $gaji = str_replace('.', '', $request->query('gaji', ''));

        $queryParams = [
            'limit'      => 50,
            'page'       => $requestedPage,
            'query'      => $request->query('title', ''),
            'salary'     => ($gaji == 0 ? '' : $gaji),
            'location'   => $request->query('lokasi', ''),
            'categories' => $request->query('kategori', ''),
        ];

        //dd($queryParams);

        // Ambil halaman 1 untuk cek totalPages
        $initialResponse = $this->companyService->getUsers($token, $queryParams, 1);
        $subcategories = $this->companyService->getSubCategories($token);
        $provinces = $this->companyService->getProvinces($token);

        if (!$initialResponse['success'] || !$subcategories['success'] || !$provinces['success']) {
            session()->flash('notifAPI', 'Halaman Data User');
            return view('user.api_error');
        }

        $totalPages = $initialResponse['data']['totalPages'] ?? 1;

        // Pilih halaman yang valid
        $page = min($requestedPage, $totalPages);

        // Ambil data hanya 1 kali, langsung dari halaman valid
        $response = ($page == 1)
            ? $initialResponse
            : $this->companyService->getUsers($token, $queryParams, $page);

        $data = $response['data'];
        $users = $data ?? [];
        $currentPage = $page;
        $subcategories = $subcategories = collect($subcategories['data'])->sortBy('name')->values()->all();
        $groupedSubCategories = collect($subcategories)->groupBy(fn($item) => $item['category']['name']);
        $provinces = $provinces['data'];
        return view('user.user', compact('users', 'groupedSubCategories', 'subcategories', 'provinces', 'currentPage', 'totalPages', 'queryParams'));
    }*/

    public function indexUser(Request $request)
    {
        $token = session('api_token');
        $requestedPage = filter_var($request->query('page', 1), FILTER_VALIDATE_INT) ?: 1;

        // Mengambil dan membersihkan parameter gaji
        $gaji = str_replace('.', '', $request->query('gaji', ''));

        // Membuat query parameters
        $queryParams = [
            'limit'      => 50,
            'page'       => $requestedPage,
            'query'      => $request->query('title', ''),
            'salary'     => ($gaji == 0 ? '' : $gaji),
            'location'   => $request->query('lokasi', ''),
            'categories' => $request->query('kategori', ''),
        ];

        // Mengambil data user, subcategories, dan provinces secara bersamaan
        $initialResponse = $this->companyService->getUsers($token, $queryParams);
        $subcategories = $this->companyService->getSubCategories($token);
        $provinces = $this->companyService->getProvinces($token);

        // Pengecekan apakah ada error di salah satu API
        if (!$initialResponse['success'] || !$subcategories['success'] || !$provinces['success']) {
            session()->flash('notifAPI', 'Halaman Data User');
            return view('user.api_error');
        }

        // Mendapatkan total halaman dari response API
        $totalPages = $initialResponse['data']['totalPages'] ?? 1;

        // Memilih halaman yang valid (tidak lebih dari totalPages)
        $page = min($requestedPage, $totalPages);

        // Mendapatkan data user berdasarkan halaman yang valid
        $response = $this->companyService->getUsers($token, $queryParams);
        $data = $response['data'] ?? [];

        // Menyiapkan data lainnya
        $users = $data;
        $currentPage = $page;
        $subcategories = collect($subcategories['data'])->sortBy('name')->values()->all();
        $groupedSubCategories = collect($subcategories)->groupBy(fn($item) => $item['category']['name']);
        $provinces = $provinces['data'];

        return view('user.user', compact('users', 'groupedSubCategories', 'subcategories', 'provinces', 'currentPage', 'totalPages', 'queryParams'));
    }


    public function user_show(CompanyService $companyService, $id)
    {
        $token = session('api_token');

        try {
            $response = Http::withToken($token)->retry(3, 100)->get("https://api.carikerjo.id/users/{$id}");

            if (!$response->successful()) {
                session()->flash('notifAPI', 'Halaman Detail User');
                return view('user.api_error');
            }

            $userData = $response->json()['data'];

            // Jika tidak ada data user
            if (empty($userData)) {
                session()->flash('notifAPI', 'Data user tidak ditemukan');
                return view('user.api_error');
            }

            // Ambil provinsi jika tersedia
            if (!empty($userData['provinces']) && isset($userData['provinces'][0])) {
                $provinceResponse = $companyService->getProvincesDetail($token, $userData['provinces'][0]);
                $provinces = $provinceResponse['data']['name'] ?? '-';
            } else {
                $provinces = '-';
            }

            return view('user.user_show', compact('userData', 'provinces'));
        } catch (\Exception $e) {
            session()->flash('notifAPI', 'Halaman Detail User');
            return view('user.api_error');
        }
    }

    //Message
    /*function indexMessage()
    {
        $token = session('api_token');
        try {
            $currentUserId = session('user_id');

            // Ambil pesan
            $resMessages = Http::withToken($token)->get('https://api.carikerjo.id/messages/my-message', ['limit' => 100]);
            if (!$resMessages->successful()) {
                session()->flash('notifAPI', 'Gagal mengambil pesan');
                return view('user.api_error');
            }
            $messages = collect($resMessages->json('data.list'));

            // Ambil user dan mapping berdasarkan _id untuk akses cepat
            $resUsers = Http::withToken($token)->get('https://api.carikerjo.id/users', ['limit' => 500]);
            if (!$resUsers->successful()) {
                session()->flash('notifAPI', 'Gagal mengambil user');
                return view('user.api_error');
            }
            $users = collect($resUsers->json('data.list'))->keyBy('_id');

            // Grup pesan berdasarkan lawan bicara
            $grouped = $messages->groupBy(function ($msg) use ($currentUserId) {
                return $msg['from'] === $currentUserId ? $msg['user'] : $msg['from'];
            });

            // Susun data kontak
            $contacts = $grouped->map(function ($msgs, $contactId) use ($users) {
                $last = $msgs->sortByDesc('createdAt')->first();
                $user = $users[$contactId] ?? null;

                return [
                    'contact_id'    => $contactId,
                    'sender_name'   => $user['name'] ?? 'Unknown',
                    'from'          => $last['from'],
                    'user'          => $last['user'],
                    'sender_avatar' => $user['avatar'] ?? null,
                    'content'       => $last['content'],
                    'status'        => $last['status'],
                    'createdAt'     => $last['createdAt'],
                ];
            })->values();
            //echo "<pre>"; print_r($contacts); echo "</pre>";
            return view('user.message', compact('contacts'));
        } catch (\Exception $e) {
            Log::channel('company_api_error')->info('Get Message', ['user_id' => session('user_id'), 'error_api' =>  $e->getMessage(),]);
            session()->flash('notifAPI', 'Terjadi kesalahan saat memuat data pesan');
            return view('user.api_error');
        }
    }*/

    /*public function detailMessage(Request $request, $id)
    {
        $token = session('api_token');
        $currentUserId = session('user_id');
        $page = $request->get('page', 1);
        $limit = 10;

        try {
            // Ambil semua pesan user
            $responseMessages = Http::withToken($token)->get('https://api.carikerjo.id/messages/my-message', [
                'limit' => $limit,
                'page' => $page
            ]);

            if (!$responseMessages->successful()) {
                Log::channel('company_api_error')->info('Detail Message.', [
                    'user_id' => $currentUserId,
                    'error_api' => $responseMessages->body(),
                ]);
                session()->flash('notifAPI', 'Halaman Message');
                return view('user.api_error');
            }

            $messageData = $responseMessages->json()['data'];
            $totalPages = $messageData['totalPages'];

            $messages = collect($messageData['list'])->sortBy('createdAt')->values();

            // Ambil data pengguna
            $responseUsers = Http::withToken($token)->get('https://api.carikerjo.id/users');

            if (!$responseUsers->successful()) {
                Log::channel('company_api_error')->info('Detail Message.', [
                    'user_id' => $currentUserId,
                    'error_api' => $responseUsers->body(),
                ]);
                session()->flash('notifAPI', 'Gagal mengambil data pengguna');
                return view('user.api_error');
            }

            $users = collect($responseUsers->json()['data']['list']);
            $rUser = $users->firstWhere('_id', $id);

            // Filter pesan yang melibatkan kedua user, baik kirim maupun terima,
            // sehingga chat tetap muncul meski hanya pesan dari satu pihak
            $filteredMessages = $messages->filter(function ($msg) use ($id, $currentUserId) {
                $involved = [$msg['from'], $msg['user']];
                return in_array($currentUserId, $involved) && in_array($id, $involved);
            })->values();

            if ($request->ajax()) {
                return response()->json([
                    'messages' => $filteredMessages,
                    'hasMore' => $page < $totalPages,
                ]);
            }

            //echo "<pre>";print_r($filteredMessages);echo "</pre>";
            return view('user.message_read', [
                'filteredMessages' => $filteredMessages,
                'rUser' => $rUser,
                'totalPages' => $totalPages
            ]);
        } catch (\Exception $e) {
            Log::channel('company_api_error')->info('Get Message', [
                'user_id' => session('user_id'),
                'error_api' => $e->getMessage(),
            ]);
            session()->flash('notifAPI', 'Terjadi kesalahan saat memuat data pesan');
            return view('user.api_error');
        }
    }*/

    function indexMessage(Request $request)
    {
        $token = session('api_token');
        try {
            $currentUserId = session('user_id');
            $page = $request->get('page', 1); // Ambil page dari query string

            // Ambil pesan
            $resMessages = Http::withToken($token)->get('https://api.carikerjo.id/messages/my-message-list', [
                'limit' => 10,
                'page' => $page,
            ]);

            if (!$resMessages->successful()) {
                session()->flash('notifAPI', 'Gagal mengambil pesan');
                return view('user.api_error');
            }

            $json = $resMessages->json();
            $contacts = collect($json['data']['list'])
                ->sortByDesc(fn($item) => $item['lastMessage']['createdAt'])
                ->values();

            $pagination = [
                'current_page' => $json['data']['current_page'] ?? 1,
                'last_page' => $json['data']['last_page'] ?? 1,
                'total' => $json['data']['total'] ?? 0,
            ];

            return view('user.message', compact('contacts', 'pagination'));
        } catch (\Exception $e) {
            Log::channel('company_api_error')->info('Get Message', ['user_id' => session('user_id'), 'error_api' =>  $e->getMessage()]);
            session()->flash('notifAPI', 'Terjadi kesalahan saat memuat data pesan');
            return view('user.api_error');
        }
    }


    public function detailMessage(Request $request, $id)
    {
        $token = session('api_token');
        $currentUserId = session('user_id');
        $page = $request->get('page', 1);
        $limit = 5;

        try {
            $responseMessages = Http::withToken($token)->get('https://api.carikerjo.id/messages/my-message-by-user', [
                'page' => $page,
                'other' => $id,
                'limit' => $limit,
            ]);

            //$responseMessages = Http::withToken($token)->get("https://api.carikerjo.id/messages/my-message-by-user?page=1&other={$id}");

            if (!$responseMessages->successful()) {
                Log::channel('company_api_error')->info('Detail Message.', [
                    'user_id' => $currentUserId,
                    'error_api' => $responseMessages->body(),
                ]);
                session()->flash('notifAPI', 'Halaman Message');
                return view('user.api_error');
            }

            $messageData = $responseMessages->json()['data'];
            $totalPages = $messageData['totalPages'];

            $messages = collect($messageData['list'])->sortBy('createdAt')->values();

            foreach ($messages as $msg) {
                // ✅ Cek: hanya lanjutkan jika user dan status sesuai
                if ($msg['user'] === $currentUserId && $msg['status'] === 'unread') {
                    $readResponse = Http::withToken($token)->get("https://api.carikerjo.id/messages/my-message-read/{$msg['_id']}");

                    if (!$readResponse->successful()) {
                        Log::channel('company_api_error')->warning('Gagal mengubah status pesan menjadi read', [
                            'message_id' => $msg['_id'],
                            'response' => $readResponse->body(),
                        ]);
                    }
                }
            }

            // Ambil data pengguna
            $responseUsers = Http::withToken($token)->retry(3, 100)->get("https://api.carikerjo.id/users/{$id}");

            if (!$responseUsers->successful()) {
                Log::channel('company_api_error')->info('Detail Message.', [
                    'user_id' => $currentUserId,
                    'error_api' => $responseUsers->body(),
                ]);
                session()->flash('notifAPI', 'Gagal mengambil data pengguna');
                return view('user.api_error');
            }

            $userData = collect($responseUsers['data']);

            if ($request->ajax()) {
                return response()->json([
                    'messages' => $messages,
                    'hasMore' => $page < $totalPages,
                ]);
            }

            return view('user.message_read', [
                'filteredMessages' => $messages,
                'userData' => $userData,
                'totalPages' => $totalPages
            ]);
            //echo "<pre>"; print_r($messages); echo "</pre>";
        } catch (\Exception $e) {
            Log::channel('company_api_error')->info('Get Message', [
                'user_id' => session('user_id'),
                'error_api' => $e->getMessage(),
            ]);
            session()->flash('notifAPI', 'Terjadi kesalahan saat memuat data pesan');
            return view('user.api_error');
        }
    }


    public function detailMessageAjax($id)
    {

        $token = session('api_token');

        try {

            // Ambil data pesan dari API
            $responseMessages = Http::withToken($token)->get('https://api.carikerjo.id/messages/my-message', [
                'limit' => 100,
            ]);
            if (!$responseMessages->successful()) {
                session()->flash('notifAPI', 'Halaman Message');
                return view('user.api_error');
            }

            // Decode response API
            $messages = $responseMessages->json()['data'];

            // Filter data pesan berdasarkan "from" menggunakan $id
            $filteredMessages = array_filter($messages, function ($message) use ($id) {
                return $message['from'] === $id;
            });

            // Ambil data pengguna dari API
            $responseUsers = Http::withToken($token)->get('https://api.carikerjo.id/users');
            if (!$responseUsers->successful()) {
                session()->flash('notifAPI', 'Gagal mengambil data pengguna');
                return view('user.api_error');
            }

            // Decode response API pengguna
            $users = $responseUsers->json()['data'];

            // Filter data pengguna berdasarkan "id"
            $filteredUser = array_filter($users, function ($user) use ($id) {
                return $user['_id'] === $id;
            });

            // Pastikan hanya ada satu pengguna yang ditemukan
            $user = reset($filteredUser); // Ambil elemen pertama dari hasil filter
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            $userHtml = '
            <div class="p-3 px-lg-4 border-bottom">
                <div class="row">
                    <div class="col-xl-4 col-7">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 avatar-sm me-3 d-sm-block d-none">
                                <img src="/upload/avatar/user.jpg" alt="" class="img-fluid d-block rounded-circle">
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="font-size-14 mb-1 text-truncate"><a href="#" class="text-dark"></a></h5>
                                <p class="text-muted text-truncate mb-0">Online</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';

            // Buat HTML untuk pesan
            $messageHtml = '
            <ul class="list-unstyled mb-0">
                <li class="right">
                    <div class="conversation-list">
                        <div class="d-flex">
                            <img src="/upload/avatar/user.jpg" class="rounded-circle avatar-sm" alt="">
                            <div class="flex-1">
                                <div class="ctext-wrap">
                                    <div class="ctext-wrap-content">
                                        <div class="conversation-name"><span class="time">12:00 PM</span></div>
                                        <p class="mb-0">Hello!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="left">
                    <div class="conversation-list">
                        <div class="d-flex">
                            <img src="/upload/avatar/admin.jpg" class="rounded-circle avatar-sm" alt="">
                            <div class="flex-1">
                                <div class="ctext-wrap">
                                    <div class="ctext-wrap-content">
                                        <div class="conversation-name"><span class="time">12:01 PM</span></div>
                                        <p class="mb-0">Hi, how are you?</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            ';

            dd([
                'userHtml' => $userHtml,
                'messageHtml' => $messageHtml,
            ]);

            return response()->json([
                'userHtml' => $userHtml,
                'messageHtml' => $messageHtml,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to load data'], 500);
        }
    }

    public function message_send(Request $request)
    {
        $token = session('api_token');

        // Validasi input
        $validated = $request->validate([
            'toId' => 'required',
            'content' => 'required|string',
        ]);

        // Data yang akan dikirim ke API
        $data = [
            'fromId' => session('user_id'),
            'content' => $validated['content'],
            'status' => 'unread',
            'userId' => $validated['toId'],
        ];

        try {
            $response = Http::withToken($token)->retry(3, 100)->post('https://api.carikerjo.id/messages/send-message', $data);

            if ($response->successful()) {
                Log::channel('company_message')->info('Pesan berhasil dikirim.', [
                    'from_id' => $data['fromId'],
                    'to_id' => $data['userId'],
                    'content' => $data['content'],
                    'status_code' => $response->status(),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Pesan berhasil dikirim!',
                ]);
            } else {
                Log::channel('company_message')->warning('Gagal mengirim pesan.', [
                    'from_id' => $data['fromId'],
                    'to_id' => $data['userId'],
                    'content' => $data['content'],
                    'status_code' => $response->status(),
                    'response_body' => $response->body(),
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengirim pesan. Coba lagi nanti.',
                ], 500);
            }
        } catch (\Exception $e) {
            Log::channel('company_message')->error('Kesalahan saat mengirim pesan ke API.', [
                'from_id' => $data['fromId'],
                'to_id' => $data['userId'],
                'content' => $data['content'],
                'error_message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan jaringan. Coba lagi nanti.',
            ], 500);
        }
    }
}
