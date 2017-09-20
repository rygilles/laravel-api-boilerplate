<template>
	<div id="app">
		<div class="wrapper">
			<!-- top bar. contains the logo and the navbar -->
			<topbar ref="topbar" :laravel="laravel" :me="me" />

			<!-- Left side column. contains the logo and sidebar -->
			<sidebar :me="me" />

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						<span v-if="('meta' in $route) && ('breadcrumbIconClass' in $route.meta)">
							<i :class="['fa-lg', $route.meta.breadcrumbIconClass]"></i>&nbsp;
						</span>
						<span v-html="routeTitle"></span>
						<small v-html="$t('routes.' + $route.name + '.description')"></small>
					</h1>

					<breadcrumb :route="$route" :endRouteTitleData="routeTitleData"></breadcrumb>
				</section>
				<router-view :key="$route.fullPath" :laravel="laravel" :me="me" v-on:routeTitleDataUpdate="updateRouteTitleData"></router-view>
			</div>
			<!-- /.content-wrapper -->

			<!-- Main Footer -->
			<footer class="main-footer">
				<strong>Copyright &copy; 2017 <a href="javascript:;">{{ laravel.appName }}</a>.</strong> All rights reserved.
			</footer>
		</div>
		<!-- ./wrapper -->
	</div>
</template>

<script>
	import topbar from './components/includes/topbar.vue';
	import sidebar from './components/includes/sidebar.vue';
	import breadcrumb from './components/includes/breadcrumb.vue';

	export default {
		components: { topbar, sidebar, breadcrumb },

		created() {
			// set laravel data in store
			this.$store.commit('setState', {
				stateName: 'laravel',
				payload: {
					appName: window.Laravel.appName,
					csrfToken : window.Laravel.csrfToken,
					apiDocBaseUrl : window.Laravel.apiDocBaseUrl,
					apiDocVersionUri : window.Laravel.apiDocVersionUri,
				}
			});
			this.fetchData();
		},

		data() {
			return {
				routeTitleData: {}
			}
		},

		computed: {

			laravel() {
				return this.$store.getters.laravel;
			},

			me() {
				return this.$store.getters.me;
			},

			routeTitle() {
				// Use route title template if available
				if (this.$i18n._exist(this.$i18n.messages[this.$i18n.locale], 'routes.' + this.$route.name + '.title_template')) {
					// Compute the template with routeTitleData (catched through "routeTitleDataUpdate" event on child <router-view>)
					var compiledTitleTemplate = _.template(this.$i18n.t('routes.' + this.$route.name + '.title_template'));
					return compiledTitleTemplate({'data' : this.routeTitleData});
				} else if (this.$i18n._exist(this.$i18n.messages[this.$i18n.locale], 'routes.' + this.$route.name + '.title')) {
					// use title insteed if available
					return this.$i18n.t('routes.' + this.$route.name + '.title');
				} else {
					// use the translation path insteed
					return 'routes.' + this.$route.name + '.title_template | routes.' + this.$route.name + '.title';
				}
			}

		},

		methods: {

			updateRouteTitleData(data) {
				this.routeTitleData = data;
			},

			fetchData() {
				this.loadMe();
			},

			listenForNotifications() {
				//console.log('Listening on private channel :', 'App.Models.User.' + this.$store.getters.me.id);
				// listen to notifications events
				Echo.private('App.Models.User.' + this.$store.getters.me.id)
					.notification((notification) => {
						// add 'pushed' property to trigger noty
						notification.pushed = true;
						this.$store.commit('addNotification', notification);
					});
			},

			/**
			 * Get current user and store it
			 */
			loadMe() {
				apiAxios.get('/me')
						.then((response) => {
							this.$store.commit('setMe', response.data.data);
							this.listenForNotifications();
						}).catch(error => {
							this.axiosError(error);
						});
			},

			axiosError(error) {
				console.log('Axio Error :', error);
				if ('response' in error) {
					console.log('Response :', error.response);
				}
				this.error = error.message;
				console.log('Message :', error.message);
			}
		}
	};
</script>