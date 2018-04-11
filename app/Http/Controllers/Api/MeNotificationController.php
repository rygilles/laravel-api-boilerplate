<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\IndexMeNotificationRequest;
use App\Http\Transformers\Api\NotificationTransformer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


/**
 * @resource Notification
 * @OpenApiOperationTag Manager:MeNotification
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
	 * @OpenApiOperationId all
	 * @OpenApiResponseSchemaRef #/components/schemas/NotificationListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A Notification list
	 * @OpenApiExtraParameterRef #/components/parameters/Include
	 * @OpenApiExtraParameterRef #/components/parameters/Search
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationPage
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationLimit
	 * @OpenApiExtraParameterRef #/components/parameters/OrderBy
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
	 * Mark all user notifications as read
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId markAllAsRead
	 * @OpenApiResponseExceptedHTTPCode 204
	 * @OpenApiResponseSchemaRef #/components/schemas/NoContentResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription No Content
	 *
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function updateAllRead()
	{
		$user = User::where('id', Auth::user()->id)->first();
		
		if (!$user)
			return $this->response->errorNotFound();
		
		$notifications = $user->notifications->all();
		
		foreach ($notifications as $notification) {
			$notification->markAsRead();
		}

		return $this->response->noContent();
	}

	/**
	 * Mark the specified user notification as read
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId markAsRead
	 * @OpenApiResponseExceptedHTTPCode 200
	 * @OpenApiResponseSchemaRef #/components/schemas/NotificationResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A Notification
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
	 * @OpenApiOperationId markAsUnread
	 * @OpenApiResponseExceptedHTTPCode 200
	 * @OpenApiResponseSchemaRef #/components/schemas/NotificationResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A Notification
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
