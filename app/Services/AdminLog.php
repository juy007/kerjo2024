<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class AdminLog
{
    
    public function createLog(string $messageLog): array
    {       
        Log::channel('admin_log')->info($messageLog, [
            'ip'         => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
        return ['success' => true, 'message' => 'Log ditambahkan'];
    }
    
}
