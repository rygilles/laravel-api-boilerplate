<?php

namespace App\Auth\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class ResetPassword extends ResetPasswordNotification
{
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('auth.reset_password_mail.subject', ['appName' => config('app.name')]))
            ->line(__('auth.reset_password_mail.line1'))
            ->action(__('auth.reset_password_mail.reset_password_btn'), route('password.reset', $this->token))
            ->line(__('auth.reset_password_mail.line2'));
    }
}
