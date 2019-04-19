<?php

namespace App\Observers;

use App\User as UserModel;
use Illuminate\Support\Facades\Log;

class User
{
    public function created(UserModel $user)
    {
        Log::info(__CLASS__.' created '.$user);

    }
}
