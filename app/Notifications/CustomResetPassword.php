<?php

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url("/reset_password/{$this->token}?email={$notifiable->email}");

        return (new MailMessage)
            ->subject('Reset Your Password')
            ->view('emails.reset-password', ['url' => $url, 'user' => $notifiable]);
    }
}
