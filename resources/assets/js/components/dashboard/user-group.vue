<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				@todo
				<pre v-html="userGroup"></pre>
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
				userGroup : null
			};
		},

		props : {
			'userGroupId' : String
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
				this.userGroup = null;

				var propsData = this.$options.propsData;
				this.userGroup = {
					id: propsData.userGroupId
				}
			},
		}
	}
</script>
