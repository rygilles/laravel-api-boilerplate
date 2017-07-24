<?php

namespace App\Events;

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
	public $syncTaskLog;

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
}
