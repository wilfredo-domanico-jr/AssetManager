<?php


namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPasswordNotification extends Notification
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
        // Get frontend URL from env
        $frontendUrl = env('FRONTEND_URL') . "/reset-password?token={$this->token}&email={$notifiable->email}";

        return (new MailMessage)
            ->subject('Reset Your Password')
            ->line('Click the link below to reset your password.')
            ->action('Reset Password', $frontendUrl)
            ->line('If you did not request a password reset, no action is required.');
    }
}
