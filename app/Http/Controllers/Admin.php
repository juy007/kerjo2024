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

class Admin extends Controller
{
    public function index()
    {
        return view('admin.form_login');
    }

    public function login_validation(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $response = Http::post('https://api.carikerjo.id/auth/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            Session::put('api_token_admin',  $data['data']);
            $token = Session::get('api_token_admin');
            
            if ($request->remember) {
                // Simpan token ke cookie
                return redirect()->route('admin_dashboard')->withCookie(cookie('api_token_admin', $token, 60 * 24 * 30)); // 30 hari
            }
            return redirect()->route('admin_dashboard');
        }
        return redirect()->route('admin_login')->with('notifLogin', 'Please check your email and password and try again.');
    }

    public function dashboard()
    {
        return view('admin.home');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();  // Ubah 'web' dengan guard yang sesuai

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin_login');
    }

 
    public function jobStatusesIndex()
    {
        // Ambil token dari session (atau sumber lain yang relevan)
        $token = session('api_token_admin');

        // Kirim GET request ke API dengan menyertakan token
        $response = Http::withToken($token)->get('https://api.carikerjo.id/job-statuses');

        if ($response->successful()) {
            $jobStatuses = $response->json(); // Mengambil data response sebagai array
            return view('admin.job-statuses', compact('jobStatuses'));
        }

        return redirect()->back()->with('error', 'Gagal mengambil data Job Statuses');
    }

    public function jobStatusesStore(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'job' => 'required|string|max:255',
        ]);

        // Ambil token dari session
        $token = session('api_token_admin');

        // Ubah nama 'job' menjadi 'name' sesuai dengan yang diminta API
        $data = [
            'name' => $validated['job'], // Map field job_statuses ke name
        ];

        // Kirim request POST ke API dengan token
        $response = Http::withToken($token)->post('https://api.carikerjo.id/job-statuses', $data);

        if ($response->successful()) {
            return redirect()->route('admin.job-statuses.index')->with('success', 'Job Status berhasil ditambahkan');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan Job Status');
    }

    public function jobStatusesUpdate(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'job' => 'required|string|max:255',
        ]);

        // Ambil token dari session
        $token = session('api_token_admin');

        // Ubah nama 'job' menjadi 'name' sesuai dengan yang diminta API
        $data = [
            'name' => $validated['job'], // Map field job_statuses ke name
        ];

        // Kirim request PUT ke API dengan token
        $response = Http::withToken($token)->put("https://api.carikerjo.id/job-statuses/{$id}", $data);

        if ($response->successful()) {
            return redirect()->route('admin.job-statuses.index')->with('success', 'Job Status berhasil diupdate');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui Job Status');
    }


    public function jobStatusesDestroy($id)
    {
        // Ambil token dari session (atau dari sumber lain yang relevan)
        $token = session('api_token_admin');

        // Kirim DELETE request ke API dengan menyertakan token
        $response = Http::withToken($token)->delete("https://api.carikerjo.id/job-statuses/{$id}");

        if ($response->successful()) {
            return redirect()->route('admin.job-statuses.index')->with('success', 'Job Status berhasil dihapus');
        }

        return redirect()->back()->with('error', 'Gagal menghapus Job Status');
    }

    // -------- Job Levels -------- //

    public function jobLevelsIndex()
    {
        $token = session('api_token_admin'); // Ambil token dari session
        $response = Http::withToken($token)->get('https://api.carikerjo.id/job-levels');

        if ($response->successful()) {
            $jobLevels = $response->json();
            return view('admin.job-levels', compact('jobLevels'));
        }

        return redirect()->back()->with('error', 'Gagal mengambil data Job Levels');
    }

    public function jobLevelsStore(Request $request)
    {
        // Validasi input dengan nama field 'job'
        $validated = $request->validate([
            'job' => 'required|string|max:255', // Validasi untuk field 'job'
        ]);

        $token = session('api_token_admin'); // Ambil token dari session

        // Kirim request POST ke API dengan memetakan 'job' ke 'name'
        $response = Http::withToken($token)->post('https://api.carikerjo.id/job-levels', [
            'name' => $validated['job'], // Memetakan 'job' ke 'name'
        ]);

        if ($response->successful()) {
            return redirect()->route('admin.job-levels.index')->with('success', 'Job Level berhasil ditambahkan');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan Job Level');
    }

    public function jobLevelsUpdate(Request $request, $id)
    {
        // Validasi input dengan nama field 'job'
        $validated = $request->validate([
            'job' => 'required|string|max:255', // Validasi untuk field 'job'
        ]);

        $token = session('api_token_admin'); // Ambil token dari session

        // Kirim request PUT ke API dengan memetakan 'job' ke 'name'
        $response = Http::withToken($token)->put("https://api.carikerjo.id/job-levels/{$id}", [
            'name' => $validated['job'], // Memetakan 'job' ke 'name'
        ]);

        if ($response->successful()) {
            return redirect()->route('admin.job-levels.index')->with('success', 'Job Level berhasil diupdate');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui Job Level');
    }


    public function jobLevelsDestroy($id)
    {
        $token = session('api_token_admin'); // Ambil token dari session
        $response = Http::withToken($token)->delete("https://api.carikerjo.id/job-levels/{$id}");

        if ($response->successful()) {
            return redirect()->route('admin.job-levels.index')->with('success', 'Job Level berhasil dihapus');
        }

        return redirect()->back()->with('error', 'Gagal menghapus Job Level');
    }


    // -------- Job Types -------- //

    public function jobTypesIndex()
    {
        $token = session('api_token_admin'); // Ambil token dari session
        $response = Http::withToken($token)->get('https://api.carikerjo.id/job-types');

        if ($response->successful()) {
            $jobTypes = $response->json();
            return view('admin.job-types', compact('jobTypes'));
        }

        return redirect()->back()->with('error', 'Gagal mengambil data Job Types');
    }

    public function jobTypesStore(Request $request)
    {
        // Validasi input dengan nama field 'job'
        $validated = $request->validate([
            'job' => 'required|string|max:255', // Validasi untuk field 'job'
        ]);

        $token = session('api_token_admin'); // Ambil token dari session

        // Kirim request POST ke API dengan memetakan 'job' ke 'name'
        $response = Http::withToken($token)->post('https://api.carikerjo.id/job-types', [
            'name' => $validated['job'], // Memetakan 'job' ke 'name'
        ]);

        if ($response->successful()) {
            return redirect()->route('admin.job-types.index')->with('success', 'Job Type berhasil ditambahkan');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan Job Type');
    }

    public function jobTypesUpdate(Request $request, $id)
    {
        // Validasi input dengan nama field 'job'
        $validated = $request->validate([
            'job' => 'required|string|max:255', // Validasi untuk field 'job'
        ]);

        $token = session('api_token_admin'); // Ambil token dari session

        // Kirim request PUT ke API dengan memetakan 'job' ke 'name'
        $response = Http::withToken($token)->put("https://api.carikerjo.id/job-types/{$id}", [
            'name' => $validated['job'], // Memetakan 'job' ke 'name'
        ]);

        if ($response->successful()) {
            return redirect()->route('admin.job-types.index')->with('success', 'Job Type berhasil diupdate');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui Job Type');
    }


    public function jobTypesDestroy($id)
    {
        $token = session('api_token_admin'); // Ambil token dari session
        $response = Http::withToken($token)->delete("https://api.carikerjo.id/job-types/{$id}");

        if ($response->successful()) {
            return redirect()->route('admin.job-types.index')->with('success', 'Job Type berhasil dihapus');
        }

        return redirect()->back()->with('error', 'Gagal menghapus Job Type');
    }

    //==========================================Province
    public function provinceIndex()
    {
        $token = Session::get('api_token_admin');
        $response = Http::withToken($token)->get('https://api.carikerjo.id/provinces');
        if ($response->successful()) {
            $provinces = $response->json();
            return view('admin.provinces', compact('provinces'));
        }

        return redirect()->back()->with('error', 'Gagal mengambil data Provinces');
    }

    public function provinceStore(Request $request)
    {
        $validated = $request->validate([
            'provinces' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');
        $response = Http::withToken($token)->post('https://api.carikerjo.id/provinces', [
            'name' => $validated['provinces'],
        ]);

        if ($response->successful()) {
            return redirect()->route('admin.provinces.index')->with('success', 'Province berhasil ditambahkan');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan Province');
    }

    public function provinceShow($id)
    {
        $token = session('api_token_admin');
        $response = Http::withToken($token)->delete("https://api.carikerjo.id/provinces/{$id}");
        if ($response->successful()) {
            $province = $response->json();
            return view('admin.regencies', compact('province'));
        }

        return redirect()->back()->with('error', 'Gagal mengambil data Province');
    }

    public function provinceUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'provinces' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');
        $response = Http::withToken($token)->put("https://api.carikerjo.id/provinces/{$id}", [
            'name' => $validated['provinces'],
        ]);

        if ($response->successful()) {
            return redirect()->route('admin.provinces.index')->with('success', 'Province berhasil diupdate');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui Province');
    }

    public function provinceDestroy($id)
    {
        $token = session('api_token_admin');
        $response = Http::withToken($token)->delete("https://api.carikerjo.id/provinces/{$id}");

        if ($response->successful()) {
            return redirect()->route('admin.provinces.index')->with('success', 'Province berhasil dihapus');
        }

        return redirect()->back()->with('error', 'Gagal menghapus Province');
    }
    //==========================================Regencies
    public function regencyIndex()
    {
        $response = Http::get('https://api.carikerjo.id/regencies');
        if ($response->successful()) {
            $regencies = $response->json();
            return view('admin.regencies.index', compact('regencies'));
        }

        return redirect()->back()->with('error', 'Gagal mengambil data Regencies');
    }

    public function regencyStore(Request $request)
    {
        $validated = $request->validate([
            'provinces' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');
        $response = Http::withToken($token)->post('https://api.carikerjo.id/regencies', [
            'name' => $validated['provinces'],
        ]);

        if ($response->successful()) {
            return redirect()->route('admin.regencies.index')->with('success', 'Regency berhasil ditambahkan');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan Regency');
    }

    public function regencyShow($id)
    {
        $response = Http::get("https://api.carikerjo.id/regencies/{$id}");
        if ($response->successful()) {
            $regency = $response->json();
            return view('admin.regencies.show', compact('regency'));
        }

        return redirect()->back()->with('error', 'Gagal mengambil data Regency');
    }

    public function regencyUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'provinces' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');
        $response = Http::withToken($token)->put("https://api.carikerjo.id/regencies/{$id}", [
            'name' => $validated['provinces'],
        ]);

        if ($response->successful()) {
            return redirect()->route('admin.regencies.index')->with('success', 'Regency berhasil diupdate');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui Regency');
    }

    public function regencyDestroy($id)
    {
        $token = session('api_token_admin');
        $response = Http::withToken($token)->delete("https://api.carikerjo.id/regencies/{$id}");

        if ($response->successful()) {
            return redirect()->route('admin.regencies.index')->with('success', 'Regency berhasil dihapus');
        }

        return redirect()->back()->with('error', 'Gagal menghapus Regency');
    }

    public function industryIndex()
    {
        $token = session('api_token_admin');
        $response = Http::withToken($token)->get('https://api.carikerjo.id/industries');
        if ($response->successful()) {
            $industries = $response->json();
            return view('admin.industries', compact('industries'));
        }

        return redirect()->back()->with('error', 'Gagal mengambil data Industries');
    }

    public function industryStore(Request $request)
    {
        $validated = $request->validate([
            'industries' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');
        $response = Http::withToken($token)->post('https://api.carikerjo.id/industries', [
            'name' => $validated['industries'],
        ]);

        if ($response->successful()) {
            return redirect()->route('admin.industries.index')->with('success', 'Industry berhasil ditambahkan');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan Industry');
    }

    public function industryShow($id)
    {
        $response = Http::get("https://api.carikerjo.id/industries/{$id}");
        if ($response->successful()) {
            $industry = $response->json();
            return view('admin.industries.show', compact('industry'));
        }

        return redirect()->back()->with('error', 'Gagal mengambil data Industry');
    }

    public function industryUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'industries' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');
        $response = Http::withToken($token)->put("https://api.carikerjo.id/industries/{$id}", [
            'name' => $validated['industries'],
        ]);

        if ($response->successful()) {
            return redirect()->route('admin.industries.index')->with('success', 'Industry berhasil diupdate');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui Industry');
    }

    public function industryDestroy($id)
    {
        $token = session('api_token_admin');
        $response = Http::withToken($token)->delete("https://api.carikerjo.id/industries/{$id}");

        if ($response->successful()) {
            return redirect()->route('admin.industries.index')->with('success', 'Industry berhasil dihapus');
        }

        return redirect()->back()->with('error', 'Gagal menghapus Industry');
    }
}
