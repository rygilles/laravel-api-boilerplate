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
		<div v-if="(['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1)" class="row">
			TODO : (fake pour le moment)
			<div class="col-md-4 col-sm-8 col-xs-16">
				<div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="fa fa-tasks"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Sync. Tasks Planned</span>
						<span class="info-box-number">5</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
			<div class="col-md-4 col-sm-8 col-xs-16">
				<div class="info-box">
					<span class="info-box-icon bg-red"><i class="fa fa-cog fa-spin"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Sync. Tasks In Progress</span>
						<span class="info-box-number">2</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->

			<!-- fix for small devices only -->
			<div class="clearfix visible-sm-block"></div>

			<div class="col-md-4 col-sm-8 col-xs-16">
				<div class="info-box">
					<span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Sync. Tasks Finished</span>
						<span class="info-box-number">5</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
		</div>
	</section>
</template>

<script>
	export default {
		name: 'Home',

		data() {
			return {

			}
		},

		props: {
			'projectId': String
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
			'$route': 'fetchData'
		},

		methods: {
			fetchData() {
				if (['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1) {
					this.listenForAdminEvents();
				}
			},

			listenForAdminEvents() {
				console.log('Listening events on admin channel.');

				Echo.private('AdminChan')
					.listen('SyncTaskLogCreatedEvent', (e) => {
						console.log(e);
					});
			},
		},
	}
</script>