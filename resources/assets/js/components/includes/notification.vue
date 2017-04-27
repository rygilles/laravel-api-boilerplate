<template v-if="notification.type == 'App\\Notifications\\AdministeredProject'">
	<a :data-notification-id="notification.id" href="javascript:;" @click="selectNotification(notification)">
		<v-gravatar :email="notification.data.assigned_by_user.email" default-img="mm" :size="48" class="user-image" alt="User Image" />
		<div>
			<div>
				<span v-html="$t('notifications.types.AdministeredProject.message',
				 			  {user_name : notification.data.assigned_by_user.name,
				 			   project_name : notification.data.project.name})"></span>
				<small>
					<i class="fa fa-clock-o"></i> {{ momentFromNow(notification.created_at) }}
				</small>
			</div>
		</div>
	</a>
</template v-else>
	<a href="#">
		Unknown notification type !
	</a>
</template>
<script>
	export default {
		name: 'Notification',
		props: ['notification'],
		/**
		 * Component mounted
		 */
		mounted() {
			// pushed property if just received
			if ('pushed' in this.notification) {
				var notyText = $('[data-notification-id="' + this.notification.id + '"]').html();
				new Noty({
					theme: 'semanticui',
					type: 'alert',
					layout: 'bottomRight',
					text: notyText,
					timeout: 5000,
					progressBar: true,
					closeWith: ['click', 'button'],
					animation: {
						open: 'noty_effects_open',
						close: 'noty_effects_close'
					},
				}).show();

				document.getElementById('noty_audio').play();
			}
		},
		methods: {
			/**
			 * Mark notification as read and/or redirect
			 */
			selectNotification(notification) {
				if (notification.read_at)
					return;

				apiAxios.post('/me/notification/' + notification.id + '/read')
					.then(response => {
						notification.read_at = response.data.data.read_at;
					}).catch(error => {
						this.$root.axiosError(error);
					});
			}
		}
	}
</script>