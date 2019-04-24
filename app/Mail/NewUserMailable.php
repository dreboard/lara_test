<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class NewUserMailable extends Mailable //implements ShouldQueue
{
    use Queueable, SerializesModels;
    /**
     * All public properties available in view
     * @var User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        try{
            Log::info(__CLASS__.' mailed '.$this->user);
            //return $this->view('emails.new_user', ['user' => $this->user]);
            return $this->view('emails.new_user');
        }catch (\Throwable $e){
            logger($e->getMessage());
        }

    }
}
