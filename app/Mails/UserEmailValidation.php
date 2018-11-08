<?php

namespace App\Mails;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserEmailValidation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Target user.
     *
     * @var User
     */
    protected $user;

    /**
     * Create a new message instance.
     *
     * @param User $user Target user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject(__('auth.email_validation.mail.subject', ['appName' => config('app.name')]));

        return $this->markdown('auth/user_email_validation', ['user' => $this->user]);
    }
}
