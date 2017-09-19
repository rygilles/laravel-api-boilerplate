<template>
	<header class="main-header">
		<a href="/" class="logo">
			<!-- mini logo for sidebar -->
			<span class="logo-mini">
				<img src="/img/dashboard-mini-logo.png" alt="" class="img-responsive center-block">
			</span>
			<!-- logo for regular state and mobile devices -->
			<div class="logo-lg">
				<img src="/img/dashboard-logo.png" alt="" class="img-responsive">
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
					<!-- Lang switch -->
					<LangsTabs ref="langTabs" :defaultLang="this.$i18n.locale" :langs="['en', 'fr']" />
					<!-- User Notifications Menu -->
					<notifications ref="notifications" />
					<!-- User Account Menu -->
					<li class="dropdown user user-menu">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<!-- The user image in the navbar-->
							<v-gravatar :email="me.email" default-img="mm" :size="25" class="user-image" alt="User Image" />
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							<span class="hidden-xs">{{ me.name }}</span>
						</a>
						<ul class="dropdown-menu">
							<!-- User image -->
							<li class="user-header">
								<v-gravatar :email="me.email" default-img="mm" :size="90" class="img-circle" alt="User Image"></v-gravatar>
								<p>
									{{ me.name }}
									<small>{{ $t('topbar.user_menu.member_since', { 'date': memberSince }) }}</small>
								</p>
							</li>
							<!-- Menu Body -->
							<li class="user-body">
								<div class="row">
									<div class="col-xs-12 text-center">
										<router-link :to="{ name: 'api-configuration' }">
											<i class="fa fa-fw fa-btn fa-cubes"></i> {{ $t('topbar.user_menu.api') }}
										</router-link>
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
										<input type="hidden" name="_token" :value="laravel.csrfToken">
									</form>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
	</header>
</template>
<script>
	import LangsTabs from './langs-tabs.vue';
	import notifications from './notifications.vue';

	export default {
		props: ['laravel', 'me'],
		components: {
			notifications,
			LangsTabs,
		},
		computed: {
			memberSince() {
				return moment
					.utc(this.me.created_at, 'YYYY-MM-DD H:mm:ss')
					.local()
					.format(this.$i18n.messages['en'].topbar.user_menu.member_since_datetime_format);
			}
		}
	}
</script>