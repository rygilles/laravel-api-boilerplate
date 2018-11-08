<?php

namespace App\Http\Transformers\Api;

use App\Models\Notification;

class NotificationTransformer extends ApiTransformer
{
    /**
     * Turn this item object into a generic array.
     *
     * @param Notification $notification
     * @return array
     */
    public function transform(Notification $notification)
    {
        return $this->filterWithModelConfiguration(
            Notification::class,
            [
                'id'                => $notification->id,
                'type'              => $notification->type,
                'notifiable_id'     => $notification->notifiable_id,
                'notifiable_type'   => $notification->notifiable_type,
                'data'              => $notification->data,
                'read_at'           => ($notification->read_at ? $notification->read_at->toDateTimeString() : $notification->read_at),
                'created_at'        => $notification->created_at->toDateTimeString(),
                'updated_at'        => $notification->updated_at->toDateTimeString(),
            ]
        );
    }
}
