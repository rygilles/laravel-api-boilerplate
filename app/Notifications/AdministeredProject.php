<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\UserHasProject;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class AdministeredProject extends Notification
{
    use Queueable;

	/**
	 * Relationship user
	 * @var User
	 */
	protected $user;

	/**
	 * Relationship project
	 * @var UserHasProject
	 */
	protected $project;

	/**
	 * User who created the relationship
	 * @var User
	 */
	protected $assignedByUser;

	/**
	 * Create a new notification instance.
	 *
	 * @param User $user Relationship user
	 * @param Project $project Relationship project
	 * @param User $assignedByUser User who created the relationship
	 */
    public function __construct($user, $project, $assignedByUser)
    {
	    $this->user = $user;
	    $this->project = $project;
	    $this->assignedByUser = $assignedByUser;
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
	        'project_id' => $this->project->id,
	        'assigned_by_user_id' => $this->assignedByUser->id,
	        'assigned_by_user' => [
		        'name' => $this->assignedByUser->name,
		        'email' => $this->assignedByUser->email
	        ],
	        'project' => [
		        'name' => $this->project->name
	        ]
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
				'project_id' => $this->project->id,
				'assigned_by_user_id' => $this->assignedByUser->id,
				'assigned_by_user' => [
					'name' => $this->assignedByUser->name,
					'email' => $this->assignedByUser->email
				],
				'project' => [
					'name' => $this->project->name
				],
			],
			'read_at' => null,
			'created_at' => $carbon->toDateTimeString()
		]);
	}
}
