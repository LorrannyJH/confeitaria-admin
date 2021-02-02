<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecoverPassword extends Mailable
{
    use Queueable, SerializesModels;

    private $userName;
    private $resetPasswordFormRoute;

    public function __construct($userName, $resetPasswordFormRoute)
    {
        $this->userName = $userName;
        $this->resetPasswordFormRoute = $resetPasswordFormRoute;
    }

    public function build()
    {
        return $this->subject('Recuperação de senha')
            ->markdown('emails.auth.recover-password')
            ->with([
                'userName' => $this->userName,
                'resetPasswordFormRoute' => $this->resetPasswordFormRoute
            ]);
    }
}
