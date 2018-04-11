<style scoped>
	.flashes-container { display: none }
</style>
<template>
	<div class="flashes-container">
		<flash v-for="notification,key in notifications" :key="'flash-notification-' + notification.id"
			   :notification="notification">
		</flash>
	</div>
</template>
<script>
	import Flash from './flash';

	export default {
		name: 'Flashes',
		components: { Flash },
		data() {
            return {
                notificationsStore: []
            }
		},
		created() {
		
		},
		methods : {
		
		},
		computed : {
			notifications() {
                return this.$store.state.notifications.filter(notification => (('pushed' in notification) && (notification.pushed == true)));
			},
		}
	}
</script>