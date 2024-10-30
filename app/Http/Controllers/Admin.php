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
        try {
            $response = Http::post('https://api.carikerjo.id/auth/login', [
                'email' => $request->email,
                'password' => $request->password,
            ]);

            if ($response->successful()) {
                $data = $response->json();

                Session::put('api_token_admin',  $data['data']);
                $token = Session::get('api_token_admin');

                if ($request->remember) {
                    return redirect()->route('admin_dashboard')->withCookie(cookie('api_token_admin', $token, 60 * 24 * 30)); // 30 hari
                }
                return redirect()->route('admin_dashboard');
            }
            return redirect()->route('admin_login')->with('notifLogin', 'Please check your email and password and try again.');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function dashboard()
    {
        return view('admin.home');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin_login');
    }

    public function companyIndex()
    {
        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->get('https://api.carikerjo.id/companies');

            if ($response->successful()) {
                $company = $response->json();
                return view('admin.company', compact('company'));
            }
            return redirect()->back()->with('error', 'Gagal mengambil data Job Statuses');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function jobStatusesIndex()
    {
        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->get('https://api.carikerjo.id/job-statuses');

            if ($response->successful()) {
                $jobStatuses = $response->json(); // Mengambil data response sebagai array
                return view('admin.job-statuses', compact('jobStatuses'));
            }

            return redirect()->back()->with('error', 'Gagal mengambil data Job Statuses');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function jobStatusesStore(Request $request)
    {
        $validated = $request->validate([
            'job-statuses' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');

        $data = [
            'name' => $validated['job-statuses'],
        ];

        try {
            $response = Http::withToken($token)->post('https://api.carikerjo.id/job-statuses', $data);

            if ($response->successful()) {
                return redirect()->route('admin.job-statuses.index')->with('success', 'Job Status berhasil ditambahkan');
            }

            return redirect()->back()->with('error', 'Gagal menambahkan Job Status');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function jobStatusesUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'job-statuses' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');

        $data = [
            'name' => $validated['job-statuses'],
        ];
        try {
            $response = Http::withToken($token)->put("https://api.carikerjo.id/job-statuses/{$id}", $data);

            if ($response->successful()) {
                return redirect()->route('admin.job-statuses.index')->with('success', 'Job Status berhasil diupdate');
            }

            return redirect()->back()->with('error', 'Gagal memperbarui Job Status');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }


    public function jobStatusesDestroy($id)
    {
        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->delete("https://api.carikerjo.id/job-statuses/{$id}");

            if ($response->successful()) {
                return redirect()->route('admin.job-statuses.index')->with('success', 'Job Status berhasil dihapus');
            }

            return redirect()->back()->with('error', 'Gagal menghapus Job Status');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    // -------- Job Levels -------- //

    public function jobLevelsIndex()
    {
        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->get('https://api.carikerjo.id/job-levels');

            if ($response->successful()) {
                $jobLevels = $response->json();
                return view('admin.job-levels', compact('jobLevels'));
            }

            return redirect()->back()->with('error', 'Gagal mengambil data Job Levels');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function jobLevelsStore(Request $request)
    {
        $validated = $request->validate([
            'job-levels' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->post('https://api.carikerjo.id/job-levels', [
                'name' => $validated['job-levels'],
            ]);

            if ($response->successful()) {
                return redirect()->route('admin.job-levels.index')->with('success', 'Job Level berhasil ditambahkan');
            }

            return redirect()->back()->with('error', 'Gagal menambahkan Job Level');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function jobLevelsUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'job-levels' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->put("https://api.carikerjo.id/job-levels/{$id}", [
                'name' => $validated['job-levels'],
            ]);

            if ($response->successful()) {
                return redirect()->route('admin.job-levels.index')->with('success', 'Job Level berhasil diupdate');
            }

            return redirect()->back()->with('error', 'Gagal memperbarui Job Level');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function jobLevelsDestroy($id)
    {
        $token = session('api_token_admin'); // Ambil token dari session
        try {
            $response = Http::withToken($token)->delete("https://api.carikerjo.id/job-levels/{$id}");

            if ($response->successful()) {
                return redirect()->route('admin.job-levels.index')->with('success', 'Job Level berhasil dihapus');
            }

            return redirect()->back()->with('error', 'Gagal menghapus Job Level');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    // -------- Job Types -------- //

    public function jobTypesIndex()
    {
        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->get('https://api.carikerjo.id/job-types');

            if ($response->successful()) {
                $jobTypes = $response->json();
                return view('admin.job-types', compact('jobTypes'));
            }

            return redirect()->back()->with('error', 'Gagal mengambil data Job Types');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function jobTypesStore(Request $request)
    {
        $validated = $request->validate([
            'job-types' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->post('https://api.carikerjo.id/job-types', [
                'name' => $validated['job-types'],
            ]);

            if ($response->successful()) {
                return redirect()->route('admin.job-types.index')->with('success', 'Job Type berhasil ditambahkan');
            }

            return redirect()->back()->with('error', 'Gagal menambahkan Job Type');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function jobTypesUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'job-types' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->put("https://api.carikerjo.id/job-types/{$id}", [
                'name' => $validated['job-types'],
            ]);

            if ($response->successful()) {
                return redirect()->route('admin.job-types.index')->with('success', 'Job Type berhasil diupdate');
            }

            return redirect()->back()->with('error', 'Gagal memperbarui Job Type');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }


    public function jobTypesDestroy($id)
    {
        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->delete("https://api.carikerjo.id/job-types/{$id}");

            if ($response->successful()) {
                return redirect()->route('admin.job-types.index')->with('success', 'Job Type berhasil dihapus');
            }

            return redirect()->back()->with('error', 'Gagal menghapus Job Type');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    //==========================================Province
    public function provinceIndex()
    {
        $token = Session::get('api_token_admin');
        try {
            $response = Http::withToken($token)->get('https://api.carikerjo.id/provinces');
            if ($response->successful()) {
                $provinces = $response->json();
                return view('admin.provinces', compact('provinces'));
            }

            return redirect()->back()->with('error', 'Gagal mengambil data Provinces');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function provinceStore(Request $request)
    {
        $validated = $request->validate([
            'provinces' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->post('https://api.carikerjo.id/provinces', [
                'name' => $validated['provinces'],
            ]);

            if ($response->successful()) {
                return redirect()->route('admin.provinces.index')->with('success', 'Province berhasil ditambahkan');
            }

            return redirect()->back()->with('error', 'Gagal menambahkan Province');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function provinceShow($id)
    {
        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->delete("https://api.carikerjo.id/provinces/{$id}");
            if ($response->successful()) {
                $province = $response->json();
                return view('admin.regencies', compact('province'));
            }

            return redirect()->back()->with('error', 'Gagal mengambil data Province');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function provinceUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'provinces' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->put("https://api.carikerjo.id/provinces/{$id}", [
                'name' => $validated['provinces'],
            ]);

            if ($response->successful()) {
                return redirect()->route('admin.provinces.index')->with('success', 'Province berhasil diupdate');
            }

            return redirect()->back()->with('error', 'Gagal memperbarui Province');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function provinceDestroy($id)
    {
        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->delete("https://api.carikerjo.id/provinces/{$id}");

            if ($response->successful()) {
                return redirect()->route('admin.provinces.index')->with('success', 'Province berhasil dihapus');
            }

            return redirect()->back()->with('error', 'Gagal menghapus Province');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }


    //==========================================Regencies
    public function regencyIndex()
    {
        try {
            $response = Http::get('https://api.carikerjo.id/regencies');
            if ($response->successful()) {
                $regencies = $response->json();
                return view('admin.regencies.index', compact('regencies'));
            }

            return redirect()->back()->with('error', 'Gagal mengambil data Regencies');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function regencyStore(Request $request)
    {
        $validated = $request->validate([
            'provinces' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->post('https://api.carikerjo.id/regencies', [
                'name' => $validated['provinces'],
            ]);

            if ($response->successful()) {
                return redirect()->route('admin.regencies.index')->with('success', 'Regency berhasil ditambahkan');
            }

            return redirect()->back()->with('error', 'Gagal menambahkan Regency');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function regencyShow($id)
    {
        try {
            $response = Http::get("https://api.carikerjo.id/regencies/{$id}");
            if ($response->successful()) {
                $regency = $response->json();
                return view('admin.regencies.show', compact('regency'));
            }

            return redirect()->back()->with('error', 'Gagal mengambil data Regency');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function regencyUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'provinces' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->put("https://api.carikerjo.id/regencies/{$id}", [
                'name' => $validated['provinces'],
            ]);

            if ($response->successful()) {
                return redirect()->route('admin.regencies.index')->with('success', 'Regency berhasil diupdate');
            }

            return redirect()->back()->with('error', 'Gagal memperbarui Regency');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function regencyDestroy($id)
    {
        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->delete("https://api.carikerjo.id/regencies/{$id}");

            if ($response->successful()) {
                return redirect()->route('admin.regencies.index')->with('success', 'Regency berhasil dihapus');
            }

            return redirect()->back()->with('error', 'Gagal menghapus Regency');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    //==========================================Category
    public function categoryIndex()
    {
        $token = Session::get('api_token_admin');
        try {
            $response = Http::withToken($token)->get('https://api.carikerjo.id/categories');
            if ($response->successful()) {
                $categories = $response->json();
                return view('admin.categories', compact('categories'));
            }

            return redirect()->back()->with('error', 'Gagal mengambil data Categories');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function categoryStore(Request $request)
    {
        $validated = $request->validate([
            'categories' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->post('https://api.carikerjo.id/categories', [
                'name' => $validated['categories'],
            ]);

            if ($response->successful()) {
                return redirect()->route('admin.categories.index')->with('success', 'Category berhasil ditambahkan');
            }

            return redirect()->back()->with('error', 'Gagal menambahkan Category');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function categoryUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'categories' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->put("https://api.carikerjo.id/categories/{$id}", [
                'name' => $validated['categories'],
            ]);

            if ($response->successful()) {
                return redirect()->route('admin.categories.index')->with('success', 'Category berhasil diupdate');
            }

            return redirect()->back()->with('error', 'Gagal memperbarui Category');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function categoryDestroy($id)
    {
        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->delete("https://api.carikerjo.id/categories/{$id}");

            if ($response->successful()) {
                return redirect()->route('admin.categories.index')->with('success', 'Category berhasil dihapus');
            }

            return redirect()->route('admin.categories.index')->with('error', 'Gagal menghapus Category');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    //==========================================subCategory
    public function subCategoryIndex($id)
    {
        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->get("https://api.carikerjo.id/categories/{$id}");
            if ($response->successful()) {
                $categories = $response->json();
                return view('admin.sub_categories', compact('categories', 'id'));
            }

            return redirect()->back()->with('error', 'Gagal mengambil data Category');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function subCategoryStore(Request $request)
    {
        $validated = $request->validate([
            'sub-categories' => 'required|string|max:255',
            'id' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->post('https://api.carikerjo.id/sub-categories', [
                'name' => $validated['sub-categories'],
                'categoryId' => $validated['id'],
            ]);

            if ($response->successful()) {
                return redirect()->route('admin.sub-categories.show', $validated['id'])->with('success', 'Category berhasil ditambahkan');
            }

            return redirect()->route('admin.sub-categories.show', $validated['id'])->with('error', 'Gagal menambahkan Category');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function subCategoryUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'sub-categories' => 'required|string|max:255',
            'id' => 'required|string',  // Pastikan ID kategori ada
        ]);

        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->put("https://api.carikerjo.id/sub-categories/{$id}", [
                'name' => $validated['sub-categories'],
                'categoryId' => $validated['id'],
            ]);

            if ($response->successful()) {
                return redirect()->route('admin.sub-categories.show', $validated['id'])->with('success', 'Subcategory berhasil diupdate');
            }

            return redirect()->route('admin.sub-categories.show', $validated['id'])->with('error', 'Gagal memperbarui Subcategory');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }


    //==========================================Industries
    public function industryIndex()
    {
        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->get('https://api.carikerjo.id/industries');
            if ($response->successful()) {
                $industries = $response->json();
                return view('admin.industries', compact('industries'));
            }

            return redirect()->back()->with('error', 'Gagal mengambil data Industries');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function industryStore(Request $request)
    {
        $validated = $request->validate([
            'industries' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->post('https://api.carikerjo.id/industries', [
                'name' => $validated['industries'],
            ]);

            if ($response->successful()) {
                return redirect()->route('admin.industries.index')->with('success', 'Industry berhasil ditambahkan');
            }

            return redirect()->back()->with('error', 'Gagal menambahkan Industry');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function industryShow($id)
    {
        try {
            $response = Http::get("https://api.carikerjo.id/industries/{$id}");
            if ($response->successful()) {
                $industry = $response->json();
                return view('admin.industries.show', compact('industry'));
            }

            return redirect()->back()->with('error', 'Gagal mengambil data Industry');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function industryUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'industries' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->put("https://api.carikerjo.id/industries/{$id}", [
                'name' => $validated['industries'],
            ]);

            if ($response->successful()) {
                return redirect()->route('admin.industries.index')->with('success', 'Industry berhasil diupdate');
            }

            return redirect()->back()->with('error', 'Gagal memperbarui Industry');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function industryDestroy($id)
    {
        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->delete("https://api.carikerjo.id/industries/{$id}");

            if ($response->successful()) {
                return redirect()->route('admin.industries.index')->with('success', 'Industry berhasil dihapus');
            }

            return redirect()->back()->with('error', 'Gagal menghapus Industry');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }


    // -------- Currencies -------- //

    public function currenciesIndex()
    {
        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->get('https://api.carikerjo.id/currencies');

            if ($response->successful()) {
                $currencies = $response->json();
                return view('admin.currencies', compact('currencies'));
            }

            return redirect()->back()->with('error', 'Gagal mengambil data Currencies');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function currenciesStore(Request $request)
    {
        $validated = $request->validate([
            'currencies' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->post('https://api.carikerjo.id/currencies', [
                'name' => $validated['currencies'],
            ]);

            if ($response->successful()) {
                return redirect()->route('admin.currencies.index')->with('success', 'Currencies berhasil ditambahkan');
            }

            return redirect()->back()->with('error', 'Gagal menambahkan currencies');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function currenciesUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'currencies' => 'required|string|max:255',
        ]);

        $token = session('api_token_admin');

        try {
            $response = Http::withToken($token)->put("https://api.carikerjo.id/currencies/{$id}", [
                'name' => $validated['currencies'],
            ]);

            if ($response->successful()) {
                return redirect()->route('admin.currencies.index')->with('success', 'Currencies berhasil diupdate');
            }

            return redirect()->back()->with('error', 'Gagal memperbarui currencies');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }

    public function currenciesDestroy($id)
    {
        $token = session('api_token_admin');
        try {
            $response = Http::withToken($token)->delete("https://api.carikerjo.id/currencies/{$id}");

            if ($response->successful()) {
                return redirect()->route('admin.currencies.index')->with('success', 'currencies berhasil dihapus');
            }

            return redirect()->back()->with('error', 'Gagal menghapus currencies');
        } catch (\Exception $e) {
            return redirect()->route('db_error');
        }
    }
}
