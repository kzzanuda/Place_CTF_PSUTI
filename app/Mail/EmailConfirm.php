<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailConfirm extends Mailable
{
    use Queueable, SerializesModels;


    public $user_id;
    public $user_hash;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_id, $user_hash)
    {
        $this->user_id = $user_id;
        $this->user_hash = $user_hash;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.confirm_email');
    }
}
