<template>
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">

				<!-- Collapsed Hamburger -->
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<!-- Branding Image -->
				<a class="navbar-brand" href="#">
					<img src="/img/nav-logo.png" style="height: 32px;" alt="emsearch">
				</a>
			</div>

			<div class="collapse navbar-collapse" id="app-navbar-collapse">
				<!-- Left Side Of Navbar -->
				<ul class="nav navbar-nav">
					<li>
						<router-link :to="{ name: 'user-projects' }">{{ $t('topbar.projects') }}</router-link>
					</li>
				</ul>

				<!-- Right Side Of Navbar -->
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							{{ $root.me.name }} <span class="caret"></span>
						</a>

						<ul class="dropdown-menu" role="menu">
							<!-- Settings -->
							<li class="dropdown-header">Settings</li>

							<!-- Your Settings -->
							<li>
								<a href="/settings">
									<i class="fa fa-fw fa-btn fa-cog"></i>Your Settings
								</a>
							</li>

							<li class="divider"></li>

							<!-- Tools -->
							<li class="dropdown-header">Tools</li>

							<!-- API -->
							<li>
								<router-link :to="{ name: 'api-configuration' }">
									<i class="fa fa-fw fa-btn fa-cubes"></i>Api
								</router-link>
							</li>

							<li class="divider"></li>

							<!-- Logout -->
							<li>
								<a href="#"
								   onclick="event.preventDefault();
								   document.getElementById('logout-form').submit();">
									<i class="fa fa-fw fa-btn fa-sign-out"></i>{{ $t('topbar.logout') }}
								</a>

								<form id="logout-form" action="#" method="POST" style="display: none;">
									<!-- csrf_field() todo -->
								</form>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</template>
