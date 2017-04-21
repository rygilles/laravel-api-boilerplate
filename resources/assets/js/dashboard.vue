<template>
	<div id="app">
		<div class="wrapper">
			<header class="main-header">
				<a href="/" class="logo">
					<!-- mini logo for sidebar -->
					<span class="logo-mini">
						<img src="/img/dashboard-mini-logo.png" alt="emsearch" class="img-responsive center-block">
					</span>
					<!-- logo for regular state and mobile devices -->
					<div class="logo-lg">
						<img src="/img/dashboard-logo.png" alt="emsearch" class="img-responsive">
					</div>
				</a>

				<!-- Header Navbar -->
				<nav class="navbar navbar-static-top" role="navigation">
					<!-- Sidebar toggle button-->
					<a href="javascript:;" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Toggle navigation</span>
					</a>
					<!-- Navbar Right Menu -->
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<!-- User Account Menu -->
							<li class="dropdown user user-menu">
								<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
									<!-- The user image in the navbar-->
									<v-gravatar :email="me.email" default-img="mm" :size="25" class="user-image" alt="User Image" />
									<!-- hidden-xs hides the username on small devices so only the image appears. -->
									<span class="hidden-xs">{{ $root.me.name }}</span>
								</a>
								<ul class="dropdown-menu">
									<!-- User image -->
									<li class="user-header">
										<v-gravatar :email="me.email" default-img="mm" :size="90" class="img-circle" alt="User Image"></v-gravatar>
										<p>
											{{ $root.me.name }}
											<small>Member since Nov. 2012</small>
										</p>
									</li>
									<!-- Menu Body -->
									<li class="user-body">
										<div class="row">
											<div class="col-xs-4 text-center">
												<router-link :to="{ name: 'api-configuration' }">
													<i class="fa fa-fw fa-btn fa-cubes"></i> {{ $t('topbar.user_menu.api') }}
												</router-link>
											</div>
											<div class="col-xs-4 text-center">
												<a href="#">TODO</a>
											</div>
											<div class="col-xs-4 text-center">
												<a href="#">TODO</a>
											</div>
										</div>
										<!-- /.row -->
									</li>
									<!-- Menu Footer-->
									<li class="user-footer">
										<div class="pull-left">
											<a href="#" class="btn btn-default btn-sm">
												<i class="fa fa-fw fa-btn fa-cog"></i> {{ $t('topbar.user_menu.settings') }}
											</a>
										</div>
										<div class="pull-right">
											<a href="/logout"
											   onclick="event.preventDefault();
											 document.getElementById('logout-form').submit();" class="btn btn-default btn-sm">
												<i class="fa fa-fw fa-btn fa-sign-out"></i> {{ $t('topbar.user_menu.logout') }}
											</a>

											<form id="logout-form" action="/logout" method="POST" style="display: none;">
												<input type="hidden" name="_token" :value="$root.csrfToken">
											</form>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>
			</header>
			<!-- Left side column. contains the logo and sidebar -->
			<sidebar :display-name="demo.displayName"
					 :picture-url="demo.avatar" />

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						{{ $t('routes.' + $route.name + '.title') }}
						<small>{{ $t('routes.' + $route.name + '.description') }}</small>
					</h1>
					<ol class="breadcrumb">
						<li>
							<router-link :to="{ name: 'home' }">
								<i class="fa fa-home"></i>{{ $t('routes.home.title') }}</a>
							</router-link>
						</li>
						<li class="active">{{ $t('routes.' + $route.name + '.title') }}</li>
					</ol>
				</section>

				<router-view></router-view>
			</div>
			<!-- /.content-wrapper -->

			<!-- Main Footer -->
			<footer class="main-footer">
				<strong>Copyright &copy; 2017 <a href="javascript:;">emsearch</a>.</strong> All rights reserved.
			</footer>
		</div>
		<!-- ./wrapper -->
	</div>
</template>

<script>
	import sidebar from './components/includes/sidebar.vue';

	export default {
		components: { sidebar },

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
				me : {
					'id' : '',
					'email' : '',
					'name' : '',
					'user_group_id' : ''
				}
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

		computed: {
			demo() {
				return {
					displayName: 'Ryan Gilles',
					avatar: 'https://s3.amazonaws.com/uifaces/faces/twitter/kianoshp/128.jpg',
					email: 'demo@demo.com'
				}
			},
		},

		methods: {

			fetchData() {
				this.getMe();
			},

			/**
			 * Get current user
			 */
			getMe() {
				apiAxios.get('/me')
						.then(response => {
							this.me = response.data.data;
							this.ready = true;
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