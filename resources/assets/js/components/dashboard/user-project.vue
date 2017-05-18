<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				@todo
				<pre v-html="project"></pre>
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
				project : null
			};
		},

		props : {
			'projectId' : String
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
				this.project = null;

				var propsData = this.$options.propsData;
				this.getUserProject(propsData.projectId);
			},

			getUserProject(projectId) {
				apiAxios
					.get('/project/' + projectId)
					.then(response => {
						this.project = response.data.data;
					}).catch(error => {
						this.$root.axiosError(error);
					});
			}
		}
	}
</script>
