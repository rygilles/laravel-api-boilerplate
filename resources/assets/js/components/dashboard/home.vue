<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">{{ $t('home.dashboard') }}</h3>
					</div>
					<div class="box-body">
						<p>{{ $t('home.welcome', { name : $root.me.name }) }}</p>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	export default {
		name: 'Home',

		data() {
			return {
				'userCreatedEvents': []
			}
		},

		props: {

		},

		/**
		 * Component created
		 */
		created() {
			// fetch the data when the view is created and the data is
			// already being observed
			this.fetchData();
		},

		/**
		 * Component watcher
		 */
		watch: {
			// call again the method if the route changes
			'$route': 'fetchData'
		},

		methods: {
			fetchData() {
				this.listenForAdminEvents();
			},

			listenForAdminEvents() {
				Echo.private('AdminChan')
					.listen('userCreatedEvent', (e) => {
						this.userCreatedEvents.push(e);
					});
			},
		},
	}
</script>