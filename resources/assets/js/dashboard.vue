<template>
	<section class="row">

		<topbar></topbar>

		<div v-if="loading" class="loading-overlay">
			<div class="loading">
				<i class="fa fa-circle-o-notch fa-spin fa-5x fa-fw"></i>
				<span class="sr-only">Loading...</span>
			</div>
		</div>

		<div class="container">

			<div v-if="error" class="error">
				<div class="main">
					<div class="col-md-8 col-md-offset-2">
						<div class="alert alert-danger">
							{{ $t('common.axio_error') }} : {{ error }}
						</div>
					</div>
				</div>
			</div>

			<div v-if="ready">
				<div class="main">
					<div class="col-md-8 col-md-offset-2">
						<router-view></router-view>
					</div>
				</div>
			</div>
		</div>

	</section>
</template>

<script>
	import topbar from './components/includes/topbar.vue';
	export default {
		components: { topbar },

		/**
		 * The root component's data.
		 */
		data() {
			return {
				csrfToken : window.Laravel.csrfToken,
				apiDocBaseUrl : window.Laravel.apiDocBaseUrl,
				apiDocVersionUri : window.Laravel.apiDocVersionUri,
				ready : false,
				loading: false,
				fetched: false,
				error: null,
				me : {}
			};
		},

		/**
		 * Component created
		 */
		created() {
			// fetch the data when the view is created and the data is
			// already being observed
			this.fetchData();
		},

		methods: {
			fetchData() {
				this.resetLoading();
				this.me = {};

				this.getMe();
			},

			/**
			 * Get current user
			 */
			getMe() {
				apiAxios.get('/me')
						.then(response => {
							this.me = response.data.data;
							this.loadingComplete();
							this.ready = true;
						}).catch(error => {
								this.axiosError(error);
						});
			},

			resetLoading() {
				this.loading = true,
				this.fetched = false,
				this.error = null;
			},

			loadingComplete(fetched) {
				if (fetched === undefined)
					fetched = true;
				this.loading = false;
				this.fetched = fetched;
			},

			axiosError(error) {
				console.log('Axio Error :', error);
				if ('response' in error) {
					console.log('Response :', error.response);
				}
				this.error = error.message;
				console.log('Message :', error.message);

				this.loadingComplete(false);
			}
		}
	};
</script>