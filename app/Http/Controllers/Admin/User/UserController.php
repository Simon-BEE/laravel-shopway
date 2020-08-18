<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
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

    public function destroy(User $user)
    {
        if ($user->hasRoles('admin')) {
            return back()->with([
                'type' => 'error',
                'message' => 'Admin user can\'t be removed.'
            ]);
        }

        $user->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'User has been removed successfully.'
        ]);
    }
}
