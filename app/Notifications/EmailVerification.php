<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmailVerification extends Notification
{
    use Queueable;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('You\'re receiving this email because you\'ve registered for an account and we can\'t wait to have you onboard as we\'re really excited you\'ve decided to give us a try.')
            ->line('As soon as your account is activated, you\'ll be able to login into our website and access videos compliled by our very best creators, so please click the link below in order to activate it.')
            ->action('Activate account', url('user/activation', $this->token))
            ->line('If you did not register for an account, or no longer wish to activate it, take no action. Simply delete this message and that will be the end of it. Also, in case you have any questions, feel free to reach out to us at <a href="mailto:support@codetube.io">support@codetube.io</a>.');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
