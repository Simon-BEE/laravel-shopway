<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
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

    public function show(User $user)
    {
        return view('admin.users.show', [
            'user' => $user->load(['orders']),
        ]);
    }
}
