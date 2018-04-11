<template>
	<li class="dropdown notifications-menu">
		<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
			<i class="fa fa-bell-o"></i>
			<span v-if="unreadNotificationsCount > 0" class="label label-danger">{{ unreadNotificationsCount }}</span>
		</a>
		<ul class="dropdown-menu">
			<li v-if="unreadNotificationsCount > 0" class="header">
				{{ $tc('notifications.you_have_unread', unreadNotificationsCount, {'count' : unreadNotificationsCount}) }}
			</li>
			<li v-else class="header">
				{{ $t('notifications.your_notifications') }}
			</li>
			<li>
				<!-- inner menu: contains the actual data -->
				<ul class="menu">
					<li v-for="notification in notifications" :class="[notification.read_at ? '' : 'new-notification']">
						<Notification :notification="notification"></Notification>
					</li>
				</ul>
			</li>
			<li class="footer"></li>
		</ul>
	</li>
</template>
<script>
    import Notification from './notification'

    export default {
        name: 'Notifications',
        components: { Notification },
        data() {
            return {
                notificationsStore: []
            }
        },
        created() {
            this.getNotifications();
        },
        methods : {
            /**
             * Get the notifications of the current user
             */
            getNotifications() {
                apiAxios.get('/me/notification?order_by=created_at,desc')
                    .then(response => {
                        response.data.data.forEach((notification) => {
                            notification.pushed = false;
                            this.$store.commit('addNotification', notification);
                        });
                    }).catch(error => {
                    this.$root.axiosError(error);
                });
            },
        },
        computed : {
            notifications() {
                return _.orderBy(this.$store.getters.notifications, 'created_at', 'desc');
            },
            notificationsCount() {
                return this.$store.getters.notificationsCount;
            },
            unreadNotificationsCount() {
                return this.$store.state.notifications.filter(notification => (!notification.read_at)).length;
            },
        }
    }
</script>