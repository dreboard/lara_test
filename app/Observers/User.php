<?php

namespace App\Observers;

use App\Mail\NewUserMailable;
use App\User as UserModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class User
{
    public function created(UserModel $user)
    {
        Log::info(__CLASS__.' created '.$user);

    }
}
