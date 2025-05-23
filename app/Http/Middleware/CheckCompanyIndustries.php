<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class CheckCompanyIndustries
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Session::get('company_industries') === null || empty(Session::get('company_industries'))) {
            return redirect()->route('company_profile_step1');
        }else{
            $nameIndustries = Session::get('company_name');
            if (is_null($nameIndustries) || empty($nameIndustries) || $nameIndustries === 'string') {
                return redirect()->route('company_profile_step2');
            }
        }
        return $next($request);
    }
}
