<template v-if="notification.type == 'App\\Notifications\\AdministeredProject'">
	<a :data-notification-id="notification.id" href="javascript:;" @click="selectNotification()">
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
				var notificationHtml = $('[data-notification-id="' + this.notification.id + '"]').html()
					var n = new Noty({
					theme: 'semanticui',
					type: 'alert',
					layout: 'bottomRight',
					text: notificationHtml,
					timeout: 5000,
					progressBar: true,
					closeWith: ['click', 'button'],
					animation: {
						open: 'noty_effects_open',
						close: 'noty_effects_close'
					},
					callbacks: {
						onShow: () => {
							$(n.barDom).bind('click', () => { this.selectNotification(); });
						}
					}
				});
				n.show();

				document.getElementById('noty_audio').play();
			}
		},
		methods: {
			/**
			 * Mark notification as read and/or redirect
			 */
			selectNotification() {
				// Redirect to the resource route
				switch (this.notification.type) {
					case 'App\\Notifications\\AdministeredProject' :
						this.$router.push({
							name: 'project',
							params: {
								'projectId': this.notification.data.project_id
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