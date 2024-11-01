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
                return view('user.api_error')->with('error', 'Gagal mengambil data dari API');
            }

            $provinces = $responses[0]->json('data');
            $currencies = $responses[1]->json('data');
            $subCategories = $responses[2]->json('data');
            $jobStatuses = $responses[3]->json('data');
            $jobTypes = $responses[4]->json('data');
            $jobLevels = $responses[5]->json('data');
            return view('user.form_job', compact('provinces', 'currencies', 'subCategories', 'jobStatuses', 'jobTypes', 'jobLevels'));
        } catch (\Exception $e) {
            return redirect()->route('db_error');
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
                'jobLevelId' => $validated['posisi_level'],
                'description' => $validated['deskripsi'],
                'detail' => $validated['detail'],
                'qualification' => $validated['kualifikasi'],
                "display" => true,
                'status' => $validated['status'],
            ]);

            if ($response->successful()) {
                return redirect()->route('form_job')->with('success', 'Lowongan Berhasil Ditambahkan');
            }
            return redirect()->back()->with('error', 'Lowongan Gagal Ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
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

            return view('user.api_error');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
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
                return view('user.api_error')->with('error', 'Gagal mengambil data dari API');
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
            return redirect()->route('db_error');
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
            //echo $e->getMessage();
            return redirect()->route('db_error');
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
            return redirect()->route('db_error');
        }
    }

    public function detailJob($id)
    {
        $token = session('api_token');
        try {
            $response = Http::withToken($token)->get("https://api.carikerjo.id/jobs/{$id}");

            if ($response->successful()) {
                $jobs = $response->json();
                return view('user.detail_job', compact('jobs'));
            }

            return view('user.api_error');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function detail_pelamar()
    {
        return view('user.detail_pelamar');
    }
}
