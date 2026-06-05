<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
class NotificationController extends Controller
{

public function history()
{
    $readNotifications = Auth::user()->readNotifications()->latest()->paginate(10);

    return view('notifications.history', compact('readNotifications'));
}

}
