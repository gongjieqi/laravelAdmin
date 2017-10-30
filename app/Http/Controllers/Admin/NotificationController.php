<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    //
    public function show(DatabaseNotification $notification)
    {

        $notification->markAsRead();

        return view('admin.notification.show',['notification'=>$notification]);
    }
}
