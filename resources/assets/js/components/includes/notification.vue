<template>
	<a v-if="notificationType == 'UserCreatedNotification'" :data-notification-id="notification.id" href="javascript:;" @click="selectNotification()">
		<v-gravatar :email="notification.data.user.email" default-img="mm" :size="48" class="user-image" alt="User Image" />
		<div>
			<div>
				<span v-html="$t('notifications.types.UserCreatedNotification.message',
							  {user_name : notification.data.user.name})"></span>
				<small>
					<i class="fa fa-clock-o"></i> {{ momentFromNow(notification.created_at) }}
				</small>
			</div>
		</div>
	</a>
	<a v-else href="#">
		Unknown notification type <span v-html="notification.type"></span> !
	</a>
</template>
<script>
	export default {
		name: 'Notification',
		props: ['notification'],
		
        computed: {
            notificationType() {
                return this.notification.type.replace('App\\Notifications\\', '');
            }
        },
		
		methods: {
			/**
			 * Mark notification as read and/or redirect
			 */
			selectNotification() {
				// Redirect to the resource route
				switch (this.notification.type) {
					case 'App\\Notifications\\UserCreatedNotification' :
						this.$router.push({
							name: 'user',
							params: {
								'userId': this.notification.data.user_id
							}
						});
						break;
				}

				if (this.notification.read_at)
					return;

				apiAxios.post('/me/notification/' + this.notification.id + '/read')
					.then(response => {
						this.notification.read_at = response.data.data.read_at;
					}).catch(error => {
						this.$root.axiosError(error);
					});
			}
		}
	}
</script>