<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\UsersAll;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    public function notifyAll()
    {
        $details = [
            'title' => 'Hi Artisan',
            'body' => 'This is my first notification',
            'thanks' => 'Thank you for using!',
            'actionText' => 'View My Site',
            'actionURL' => url('/'),
        ];

        $users = User::all();
        Notification::send($users, new UsersAll($details));
    }
}
