<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Messaging;

class NotificationController extends Controller
{
    protected $messaging;

    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    public function saveToken(Request $request)
    {
        // Simpan token ke database atau session
        // Misalnya, Anda bisa menyimpannya di session untuk contoh ini
        session(['fcm_token' => $request->token]);
        return response()->json(['success' => 'Token saved successfully.']);
    }
    
    public function sendNotification(Request $request)
    {
        $token = $request->input('token');
        $message = CloudMessage::withTarget('token', $token)
            ->withNotification([
                'title' => 'Hello!',
                'body' => 'This is a test notification.',
            ]);

        $this->messaging->send($message);

        return response()->json(['success' => 'Notification sent successfully.']);
    }
}