<style scoped>
	.action-link {
		cursor: pointer;
	}

	.m-b-none {
		margin-bottom: 0;
	}
</style>

<template>
	<div v-if="$root.fetched">
		<div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<span>
							{{ $t('projects.owner_projects') }}
						</span>
					</div>
				</div>

				<div class="panel-body">

					<p>Test...</p>

				</div>
			</div>
		</div>
	</div>
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
				this.$root.resetLoading();

				this.project = null;

				var propsData = this.$options.propsData;
				this.getUserProject(propsData.projectId);
			},

			getUserProject(projectId) {
				apiAxios.get('/project/' + projectId )
						.then(response => {
							console.log(response.data);
							this.$root.loadingComplete();
						}).catch(error => {
							this.$root.axiosError(error);
						});
			}
		}
	}
</script>
