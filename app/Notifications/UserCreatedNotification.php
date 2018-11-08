<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class UserCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Created user.
     * @var User
     */
    protected $user;

    /**
     * Create a new notification instance.
     *
     * @param User $user Created user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  User  $notifiable
     * @return string[]
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the database representation of the notification.
     *
     * @param  User  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'user_id' => $this->user->id,
            'user' => [
                'name' => $this->user->name,
                'email' => $this->user->email,
                'created_at' => $this->user->created_at,
            ],
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  User  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        $carbon = new Carbon;

        return new BroadcastMessage([
            'data' => [
                'user_id' => $this->user->id,
                'user' => [
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                    'created_at' => $this->user->created_at,
                ],
            ],
            'read_at' => null,
            'created_at' => $carbon->toDateTimeString(),
        ]);
    }
}
