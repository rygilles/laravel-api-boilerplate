<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				@todo
				<pre v-html="searchEngine"></pre>
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
				searchEngine : null
			};
		},

		props : {
			'searchEngineId' : String
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
				this.searchEngine = null;

				var propsData = this.$options.propsData;
				this.getSearchEngine(propsData.searchEngineId);
			},

			getSearchEngine(searchEngineId) {
				apiAxios
					.get('/searchEngine/' + searchEngineId)
					.then(response => {
						this.searchEngine = response.data.data;
						this.$emit('routeTitleDataUpdate', this.searchEngine);
					}).catch(error => {
						this.$root.axiosError(error);
					});
			}
		}
	}
</script>
