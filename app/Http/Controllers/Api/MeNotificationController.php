<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\IndexMeNotificationRequest;
use App\Http\Transformers\Api\NotificationTransformer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


/**
 * @resource Notification
 *
 * @package App\Http\Controllers\Api
 */
class MeNotificationController extends ApiController
{
	/**
	 * Current user notification list
	 *
	 * You can specify a GET parameter `read_status` to filter results.
	 *
	 * @param IndexMeNotificationRequest $request
	 * @return \Dingo\Api\Http\Response
	 */
	public function index(IndexMeNotificationRequest $request)
	{
		$user = User::where('id', Auth::user()->id)->first();

		if (!$user)
			return $this->response->errorNotFound();

		if ($request->has('read_status')) {
			if ($request->input('read_status') == 'read') {
				$paginator = $user->readNotifications()->paginate();
			} else {
				$paginator = $user->unreadNotifications()->paginate();
			}
		} else {
			$paginator = $user->notifications()->paginate();
		}

		return $this->response->paginator($paginator, new NotificationTransformer);
	}

	/**
	 * Mark the specified user notification as read
	 *
	 * @ApiDocsNoCall
	 *
	 * @param string $notificationId Notification UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function updateRead($notificationId)
	{
		$user = User::where('id', Auth::user()->id)->first();

		if (!$user)
			return $this->response->errorNotFound();

		$notification = $user->notifications->where('id', $notificationId)->first();

		if (!$notification)
			return $this->response->errorNotFound();

		if ($notification->read())
			return $this->response->error('This notification is already marked as read.', 409);

		$notification->markAsRead();

		return $this->response->item($notification, new NotificationTransformer);
	}

	/**
	 * Mark the specified user notification as unread
	 *
	 * @ApiDocsNoCall
	 *
	 * @param string $notificationId Notification UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function updateUnread($notificationId)
	{
		$user = User::where('id', Auth::user()->id)->first();

		if (!$user)
			return $this->response->errorNotFound();

		$notification = $user->notifications->where('id', $notificationId)->first();

		if (!$notification)
			return $this->response->errorNotFound();

		if (!$notification->read())
			return $this->response->error('This notification is already marked as unread.', 409);

		$notification->markAsUnread();

		return $this->response->item($notification, new NotificationTransformer);
	}
}
