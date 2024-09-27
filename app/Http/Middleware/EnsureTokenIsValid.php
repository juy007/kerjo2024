<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;


class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Periksa apakah token ada di session
         if (!Session::has('api_token')) {
            return redirect()->route('login')->withErrors(['notifLogin' => 'Unauthorized. Please log in.']);
        }
         /*$token = session('token');

         if (!$token) {
             return redirect('/')->withErrors(['error' => 'You must be logged in to access this page.']);
         }
            */
         // Kirim permintaan GET ke API eksternal untuk memeriksa validitas token
         //$response = Http::withToken($token)->get('https://api.carikerjo.id/auth/validateToken');
 
         /*if ($response->failed()) {
             // Jika token tidak valid atau kadaluarsa
             session()->forget('token');
             return redirect('/')->withErrors(['error' => 'Invalid or expired token.']);
         }*/
 
         // Lanjutkan request jika token valid
         return $next($request);

    }
}
