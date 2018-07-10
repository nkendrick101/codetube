<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $message;
    
    public function __construct ($message) {
        $this->message = $message;
    }

    public function build () {
        $name = $this->message['name'];
        $email = $this->message['email'];
        $body = $this->message['body'];

        return $this->markdown('emails.contact', [
            'name' => $name,
            'email' => $email,
            'body' => $body
        ]);
    }
}
