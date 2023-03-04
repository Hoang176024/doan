<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    public $userFullName;
    public $resetCode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userFullName, $resetCode)
    {
        $this->userFullName = $userFullName;
        $this->resetCode = $resetCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('dashboard.email.auth.forget_password')->with([
            'userFullName' => $this->userFullName,
            'resetCode' => $this->resetCode,
        ]);
    }

}
