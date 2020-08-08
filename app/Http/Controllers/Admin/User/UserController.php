<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        auth()->user()->unreadNotifications->each(function ($notification){
            if($notification->type === 'App\Notifications\NewUserNotification'){
                $notification->markAsRead();
            }
        });

        return view('admin.users.index');
    }
}
