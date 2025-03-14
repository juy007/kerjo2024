<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Mail\OtpMail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Collection;


class User extends Controller
{
    public function index()
    {
        return view('user.home');
    }

    public function formJob()
    {
        $token = Session::get('api_token');
        try {
            $responses = Http::pool(fn($pool) => [
                $pool->withToken($token)->get('https://api.carikerjo.id/provinces'),
                $pool->withToken($token)->get('https://api.carikerjo.id/currencies'),
                $pool->withToken($token)->get('https://api.carikerjo.id/sub-categories'),
                $pool->withToken($token)->get('https://api.carikerjo.id/job-statuses'),
                $pool->withToken($token)->get('https://api.carikerjo.id/job-types'),
                $pool->withToken($token)->get('https://api.carikerjo.id/job-levels'),
            ]);

            if (!$responses[0]->successful() || !$responses[1]->successful() || !$responses[2]->successful() || !$responses[3]->successful() || !$responses[4]->successful() || !$responses[5]->successful()) {
                session()->flash('notifAPI', 'Halaman Form Job');
                return view('user.api_error');
            }

            $provinces = $responses[0]->json('data');
            $currencies = $responses[1]->json('data');
            $subCategories = $responses[2]->json('data');
            $jobStatuses = $responses[3]->json('data');
            $jobTypes = $responses[4]->json('data');
            $jobLevels = $responses[5]->json('data');
            return view('user.form_job', compact('provinces', 'currencies', 'subCategories', 'jobStatuses', 'jobTypes', 'jobLevels'));
        } catch (\Exception $e) {
            session()->flash('notifAPI', 'Halaman Form Job');
            return view('user.api_error');
        }
    }

    public function saveJob(Request $request)
    {
        $request->merge([
            'gaji_min' => str_replace('.', '', $request->input('gaji_min')),
            'gaji_max' => str_replace('.', '', $request->input('gaji_max')),
            'date_start' => date('Y-m-d\TH:i:s.v\Z', strtotime($request->input('date_start'))),
            'date_end' => date('Y-m-d\TH:i:s.v\Z', strtotime($request->input('date_end'))),
        ]);

        $validated = $request->validate([
            'lowongan' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'mata_uang' => 'required|string|max:255',
            'gaji_min' => 'required|numeric',
            'gaji_max' => 'required|numeric',
            'lokasi' => 'required|string|max:255',
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

        /*foreach ($validated as $key => $value) {
            echo "$key: $value<br>";
        }*/
        // Ambil token dari session
        $token = session('api_token');
        try {
            // Kirim request POST ke API
            $response = Http::withToken($token)->post('https://api.carikerjo.id/jobs', [
                'title' => $validated['lowongan'],
                'subCategoryId' => $validated['kategori'],
                'companyId' => Session::get('company_id'),
                'provinceId' => $validated['lokasi'],
                'jobTypeId' => $validated['tipe_pekerjaan'],
                'jobStatusId' => $validated['status_karyawan'],
                'currencyId' => $validated['mata_uang'],
                'startDate' => $validated['date_start'],
                'endDate' => $validated['date_end'],
                'salaryStart' => $validated['gaji_min'],
                'salaryEnd' => $validated['gaji_max'],
                'salaryFrequency' => "200000",
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

    public function indexJob()
    {
        $token = session('api_token');
        try {
            $response = Http::withToken($token)->get('https://api.carikerjo.id/jobs');

            if ($response->successful()) {
                $jobs = $response->json();
                return view('user.posting_job', compact('jobs'));
            }

            session()->flash('notifAPI', 'Halaman Postingan Pekerjaan');
            return view('user.api_error');
        } catch (\Exception $e) {
            session()->flash('notifAPI', 'Halaman Postingan Pekerjaan');
            return view('user.api_error');
        }
    }

    public function editJob($id)
    {
        $token = Session::get('api_token');
        try {
            $responses = Http::pool(fn($pool) => [
                $pool->withToken($token)->get('https://api.carikerjo.id/provinces'),
                $pool->withToken($token)->get('https://api.carikerjo.id/currencies'),
                $pool->withToken($token)->get('https://api.carikerjo.id/sub-categories'),
                $pool->withToken($token)->get('https://api.carikerjo.id/job-statuses'),
                $pool->withToken($token)->get('https://api.carikerjo.id/job-types'),
                $pool->withToken($token)->get('https://api.carikerjo.id/job-levels'),
                $pool->withToken($token)->get("https://api.carikerjo.id/jobs/{$id}"),
            ]);

            // Jika salah satu request gagal, handle di sini
            $failedResponse = array_filter($responses, fn($response) => !$response->successful());
            if (count($failedResponse) > 0) {
                session()->flash('notifAPI', 'Halaman Form Job');
                return view('user.api_error');
            }

            // Ambil semua hasil request sekaligus
            $provinces = $responses[0]->json('data');
            $currencies = $responses[1]->json('data');
            $subCategories = $responses[2]->json('data');
            $jobStatuses = $responses[3]->json('data');
            $jobTypes = $responses[4]->json('data');
            $jobLevels = $responses[5]->json('data');
            $jobs = $responses[6]->json('data');

            // Sub-kategori yang sesuai dengan job
            $subCategoriesShow = collect($subCategories)->firstWhere('_id', $jobs['subCategory']);

            return view('user.form_edit_job', compact('subCategoriesShow', 'provinces', 'currencies', 'subCategories', 'jobStatuses', 'jobTypes', 'jobLevels', 'jobs'));
        } catch (\Exception $e) {
            session()->flash('notifAPI', 'Halaman Form Job');
            return view('user.api_error');
        }
    }

    public function saveUpdateJob(Request $request, $id)
    {
        $request->merge([
            'gaji_min' => str_replace('.', '', $request->input('gaji_min')),
            'gaji_max' => str_replace('.', '', $request->input('gaji_max')),
            'date_start' => date('Y-m-d\TH:i:s.v\Z', strtotime($request->input('date_start'))),
            'date_end' => date('Y-m-d\TH:i:s.v\Z', strtotime($request->input('date_end'))),
        ]);

        $validated = $request->validate([
            'lowongan' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'mata_uang' => 'required|string|max:255',
            'gaji_min' => 'required|numeric',
            'gaji_max' => 'required|numeric',
            'lokasi' => 'required|string|max:255',
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
            $response = Http::withToken($token)->put("https://api.carikerjo.id/jobs/{$id}", [
                'title' => $validated['lowongan'],
                'subCategoryId' => $validated['kategori'],
                'companyId' => Session::get('company_id'),
                'provinceId' => $validated['lokasi'],
                'jobTypeId' => $validated['tipe_pekerjaan'],
                'jobStatusId' => $validated['status_karyawan'],
                'currencyId' => $validated['mata_uang'],
                'startDate' => $validated['date_start'],
                'endDate' => $validated['date_end'],
                'salaryStart' => $validated['gaji_min'],
                'salaryEnd' => $validated['gaji_max'],
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

    public function detailJob($id)
    {
        $token = session('api_token');
        try {
            $responses = Http::pool(fn($pool) => [
                $pool->withToken($token)->get("https://api.carikerjo.id/jobs/{$id}"),
                $pool->withToken($token)->get('https://api.carikerjo.id/sub-categories'),
                $pool->withToken($token)->get("https://api.carikerjo.id/applications/job/{$id}"),
            ]);

            // Jika salah satu request gagal, handle di sini
            $failedResponse = array_filter($responses, fn($response) => !$response->successful());
            if (count($failedResponse) > 0) {
                session()->flash('notifAPI', 'Halaman Detail Job');
                return view('user.api_error');
            }

            // Ambil semua hasil request sekaligus
            $jobs = $responses[0]->json('data');
            $subCategories = $responses[1]->json('data');
            $applications = $responses[2]->json('data');
            $experiences = $responses[2]['data'][0]['user']['experiences'];


            // Sub-kategori yang sesuai dengan job
            $subCategoriesShow = collect($subCategories)->firstWhere('_id', $jobs['subCategory']);
            return view('user.detail_job', compact('jobs', 'applications', 'experiences', 'subCategoriesShow'));
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

    public function detail_pelamar($id, $jobId)
    {

        $token = session('api_token');
        try {
            $responses = Http::pool(fn($pool) => [
                $pool->withToken($token)->get("https://api.carikerjo.id/applications/job/{$jobId}"),
            ]);

            // Jika salah satu request gagal, handle di sini
            $failedResponse = array_filter($responses, fn($response) => !$response->successful());
            if (count($failedResponse) > 0) {
                session()->flash('notifAPI', 'Halaman Detail Pelamar');
                return view('user.api_error');
            }

            $applications = $responses[0]->json('data');
            $userData = collect($applications)->firstWhere('_id', $id);
            return view('user.detail_pelamar', compact('userData'));
        } catch (\Exception $e) {
            session()->flash('notifAPI', 'Halaman Detail Pelamar');
            return view('user.api_error');
        }
    }

    public function indexUser()
    {
        $token = session('api_token');
        try {
            // Ambil data pengguna
            $response = Http::withToken($token)->get('https://api.carikerjo.id/users');

            // Cek jika response gagal
            if (!$response->successful()) {
                session()->flash('notifAPI', 'Halaman Data User');
                return view('user.api_error');
            }

            // Dapatkan data dari response
            $users = $response->json()['data'];
            // Pass the data to the view
            return view('user.user', compact('users'));
        } catch (\Exception $e) {
            session()->flash('notifAPI', 'Halaman Data User');
            return view('user.api_error');
        }
    }

    function indexMessage()
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
            $messages = collect($responseMessages->json()['data']); // Ubah menjadi Collection untuk kemudahan manipulasi

            // Ambil data pengguna dari API
            $responseUsers = Http::withToken($token)->get('https://api.carikerjo.id/users');
            if (!$responseUsers->successful()) {
                session()->flash('notifAPI', 'Gagal mengambil data pengguna');
                return view('user.api_error');
            }
            $users = collect($responseUsers->json()['data']);

            // Gabungkan data pesan dengan nama pengirim dan avatar, kemudian kelompokkan berdasarkan 'from'
            $groupedMessages = $messages->map(function ($message) use ($users) {
                $sender = $users->firstWhere('_id', $message['from']);
                return [
                    '_id' => $message['_id'],
                    'content' => $message['content'],
                    'status' => $message['status'],
                    'from' => $message['from'],
                    'createdAt' => $message['createdAt'],
                    'sender_name' => $sender['name'] ?? 'Unknown',
                    'sender_avatar' => $sender['avatar'] ?? '../public/upload/avatar/default.jpg',
                ];
            })
            ->sortByDesc('createdAt') // Mengurutkan dari yang terbaru ke lama
            ->groupBy('from');

            // Kirim data terkelompok ke view
            return view('user.message', compact('groupedMessages'));
        } catch (\Exception $e) {
            session()->flash('notifAPI', 'Terjadi kesalahan saat memuat data pesan');
            return view('user.api_error');
        }
    }

    public function detailMessage($id)
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
            $messages = collect($responseMessages->json()['data']); // Ubah menjadi Collection untuk kemudahan manipulasi

            // Ambil data pengguna dari API
            $responseUsers = Http::withToken($token)->get('https://api.carikerjo.id/users');
            if (!$responseUsers->successful()) {
                session()->flash('notifAPI', 'Gagal mengambil data pengguna');
                return view('user.api_error');
            }
            $users = collect($responseUsers->json()['data']);

            // Gabungkan data pesan dengan nama pengirim dan avatar, kemudian kelompokkan berdasarkan 'from'
            $groupedMessages = $messages->map(function ($message) use ($users) {
                $sender = $users->firstWhere('_id', $message['from']);
                return [
                    '_id' => $message['_id'],
                    'content' => $message['content'],
                    'status' => $message['status'],
                    'from' => $message['from'],
                    'createdAt' => $message['createdAt'],
                    'sender_name' => $sender['name'] ?? 'Unknown',
                    'sender_avatar' => $sender['avatar'],
                ];
            })
            ->sortByDesc('createdAt') // Mengurutkan dari yang terbaru ke lama
            ->groupBy('from');

            $rUser = $users->firstWhere('_id', $id);
            // Kirim data terkelompok ke view
            return view('user.message_read', compact('groupedMessages','rUser'));
        } catch (\Exception $e) {
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


    function message_send(Request $request)
    {
        $token = session('api_token');
        // Kirim request POST ke API
        // Validasi input
        $validated = $request->validate([
            'userId' => 'required',
            'content' => 'required|string',
        ]);

        // Data yang akan dikirim ke API
        $data = [
            'fromId' => session('user_id'),
            'content' => $validated['content'],
            'status' => 'unread',
            'userId' => $validated['userId'],
        ];

        try {
            $response = Http::withToken($token)->post('https://api.carikerjo.id/messages/send-message', $data);

            // Cek jika API mengembalikan response sukses
            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pesan berhasil dikirim!',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengirim pesan. Coba lagi nanti.',
                ], 500);
            }
        } catch (\Exception $e) {
            // Tangani error jika request ke API gagal
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan jaringan. Coba lagi nanti.',
            ], 500);
        }
    }
}
