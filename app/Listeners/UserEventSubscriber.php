<?php

namespace App\Listeners;

class UserEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function onUserLogin($event) {
        info('User logged in : '.$event->user->id);
    }

    /**
     * Handle user login events.
     */
    public function onUserRegister($event) {
        info('User registered : '.$event->user->id);
    }

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event) {
        info('User logged out : '.$event->user->id);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscriber@onUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventSubscriber@onUserLogout'
        );

        $events->listen(
            'Illumunate\Auth\Events\Registered',
            'App\Listeners\UserEventSubscriber@onUserRegister'
        );
        $events->listen(
            'Illumunate\Auth\Events\Failed',
            'App\Listeners\UserEventSubscriber@onUserRegister'
        );
        $events->listen(
            'Illumunate\Auth\Events\Lockout',
            'App\Listeners\UserEventSubscriber@onUserRegister'
        );
        $events->listen(
            'Illumunate\Auth\Events\PasswordReset',
            'App\Listeners\UserEventSubscriber@onUserRegister'
        );
    }

}