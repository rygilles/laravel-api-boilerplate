<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				@todo
				<pre v-html="i18nLang"></pre>
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
				i18nLang : null
			};
		},

		props : {
			'i18nLangId' : String
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
				this.i18nLang = null;

				var propsData = this.$options.propsData;
				this.getI18nLang(propsData.i18nLangId);
			},

			getI18nLang(i18nLangId) {
				apiAxios
					.get('/i18nLang/' + i18nLangId)
					.then(response => {
						this.i18nLang = response.data.data;
						this.$emit('routeTitleDataUpdate', this.i18nLang);
					}).catch(error => {
						this.$root.axiosError(error);
					});
			}
		}
	}
</script>
