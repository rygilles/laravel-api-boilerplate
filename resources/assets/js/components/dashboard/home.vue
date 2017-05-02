<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">{{ $t('home.dashboard') }}</h3>
					</div>
					<div class="box-body">
						<p>{{ $t('home.welcome', { name : $root.me.name }) }}</p>
						<div class="dropdown">
							<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example
								<span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">HTML</a></li>
								<li><a href="#">CSS</a></li>
								<li><a href="#">JavaScript</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>
