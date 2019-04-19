<?php

namespace App\Listeners;

use App\Events\UserSaving;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class LogNewUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserSaving  $event
     * @return void
     */
    public function handle(UserSaving $event)
    {
        Log::info(__CLASS__.' '.$event->user);
    }
}
