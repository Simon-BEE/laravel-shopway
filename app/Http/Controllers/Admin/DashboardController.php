<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $notificationsUnread = request()->user()->unreadNotifications()->get();

        list($orderNotifications, $userNotifications) = $notificationsUnread->partition(function ($notification){
            return $notification->type === 'App\Notifications\NewOrderNotification';
        });

        return view('admin.dashboard', [
            'orderNotifications' => $orderNotifications->count(),
            'userNotifications' => $userNotifications->count()
        ]);
    }
}
