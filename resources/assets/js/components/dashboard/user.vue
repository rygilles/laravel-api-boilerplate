<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				@todo
				<pre v-html="user"></pre>
			</div>
		</div>
	</section>
</template>

<script>
	export default {
		/**
		 * The component's data.
		 */
		data() {
			return {
				user : null
			};
		},

		props : {
			'userId' : String
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
			'$route' : 'fetchData'
		},

		methods: {
			fetchData() {
				this.user = null;

				var propsData = this.$options.propsData;
				this.getUser(propsData.userId);
			},

			getUser(userId) {
				apiAxios
					.get('/user/' + userId)
					.then(response => {
						this.user = response.data.data;
					}).catch(error => {
						this.$root.axiosError(error);
					});
			}
		}
	}
</script>