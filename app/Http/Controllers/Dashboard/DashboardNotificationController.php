<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardNotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = Auth::user()->notifications;

        return response()->json($notifications);
    }

    public function markAsRead(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();

        return response()->json(['message' => 'Notifikasi berhasil ditandai sebagai dibaca.']);
    }
}
