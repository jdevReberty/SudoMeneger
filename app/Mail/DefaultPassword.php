<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DefaultPassword extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        protected $data,
    ){}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd();
        return $this
            ->from($this->data['from'])
            ->subject('Contato de notificação de senha padrão')
            ->view('mail.default_password_notify')
            ->with(
                [
                    'default_password' => $this->data['password'],
                    'user' => $this->data['user_id'],
                ],
            );
    }
}
