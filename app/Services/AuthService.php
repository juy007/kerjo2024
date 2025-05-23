<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AuthService
{
    protected $baseUrl = 'https://api.carikerjo.id';

    public function registerCompany(array $data)
    {
        return Http::post("{$this->baseUrl}/auth/register-company", $data);
    }

    public function login(array $credentials)
    {
        return Http::post("{$this->baseUrl}/auth/login", $credentials);
    }

    public function getCompanyProfile(string $token)
    {
        return Http::withToken($token)->get("{$this->baseUrl}/auth/my-company-profile");
    }

    public function sendOtp(string $userId, string $otp)
    {
        return Http::post("{$this->baseUrl}/auth/verifyOtp", [
            'userId' => $userId,
            'otp' => $otp,
        ]);
    }

    public function verifyOtp(string $userId, string $otp)
    {
        return Http::get("{$this->baseUrl}/auth/verifyOtp", [
            'userId' => $userId,
            'otp' => $otp,
        ]);
    }

    public function deleteOtp(string $userId)
    {
        return Http::delete("{$this->baseUrl}/auth/deleteOtp", [
            'userId' => $userId,
        ]);
    }
}
