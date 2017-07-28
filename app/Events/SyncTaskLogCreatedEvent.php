<?php

namespace App\Events;

use App\Models\SyncTask;
use App\Models\SyncTaskLog;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SyncTaskLogCreatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

	/**
	 * @var SyncTaskLog
	 */
	private $syncTaskLog;

	/**
	 * Create a new event instance.
	 *
	 * @param SyncTaskLog $syncTaskLog
	 */
    public function __construct(SyncTaskLog $syncTaskLog)
    {
        $this->syncTaskLog = $syncTaskLog;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return PrivateChannel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('AdminChan');
    }

	/**
	 * Get the data to broadcast.
	 *
	 * @return array
	 */
	public function broadcastWith()
	{
		$syncTask = $this->syncTaskLog->syncTask()->first();

		return [
			'id'                    => $this->syncTaskLog->id,
			'main_sync_task_id'     => $syncTask->sync_task_id,
			'sync_task_id'          => $this->syncTaskLog->sync_task_id,
			'sync_task_type_id'     => $syncTask->sync_task_type_id,
			'entry'                 => $this->syncTaskLog->entry,
			'public'                => $this->syncTaskLog->public,
			'sync_task_status_id'   => $this->syncTaskLog->sync_task_status_id,
			'created_at'            => $this->syncTaskLog->created_at,
		];
	}
}
