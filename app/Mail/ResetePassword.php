<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetePassword extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(protected $data){}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from($this->data['from'])
            ->subject('Solicitação de resete de senha')
            ->view('mail.resete_password')
            ->with(
                [
                    'email' => $this->data['from'],
                    'user' => $this->data['user']->id
                ]);
    }
}
