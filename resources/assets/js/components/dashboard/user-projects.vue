<style scoped>
	.action-link {
		cursor: pointer;
	}
</style>

<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">{{ $t('projects.owner_projects') }}</h3>
						<a class="action-link pull-right">
							{{ $t('projects.create_new_project') }}
						</a>
					</div>
					<div class="overlay" v-if="ownerProjectsLoading">
						<i class="fa fa-refresh fa-spin"></i>
					</div>
					<div class="box-body" v-if="!ownerProjectsLoading">
						<p class="m-b-none" v-if="(ownerProjects.data.length + adminProjects.data.length) === 0">
							{{ $t('projects.no_project_yet') }}
						</p>
						<div class="dataTables_wrapper form-inline dt-bootstrap" v-if="ownerProjects.data.length > 0">
							<div class="row">
								<div class="col-sm-6">
									<div class="dataTables_length">

									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-12 table-responsive">
									<table aria-describedby="example1_info" role="grid" class="table table-bordered table-striped dataTable">
										<thead>
										<tr role="row">
											<th>{{ $t('projects.project_name') }}</th>
											<th>{{ $t('common.created_at') }}</th>
											<th>{{ $t('common.updated_at') }}</th>
											<th></th>
										</tr>
										</thead>
										<tbody>

										<tr v-for="project in ownerProjects.data" role="row">
											<!-- Name -->
											<td class="col-md-2" style="vertical-align: middle;">
												<router-link :to="{ name: 'user-project', params: { projectId: project.id }}">{{ project.name }}</router-link>
											</td>

											<!-- Created At -->
											<td class="col-md-2" style="vertical-align: middle;">
												{{ momentLocalDate(project.created_at) }}
											</td>

											<!-- Updated At -->
											<td class="col-md-2" style="vertical-align: middle;">
												{{ momentLocalDate(project.updated_at) }}
											</td>

											<!-- Buttons -->
											<td class="col-md-1 text-right" style="vertical-align: middle;">
												<a class="btn btn-default">
													{{ $t('projects.edit_btn') }}
												</a>
												<a class="btn btn-danger">
													{{ $t('projects.delete_btn') }}
												</a>
											</td>
										</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="box-footer clearfix">
						@todo Tester avec i18nLangs pour avoir une vraie pagination !
						<ul class="pagination pagination-sm no-margin pull-right">
							<li><a href="#">&laquo;</a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">&raquo;</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row" v-if="(adminProjects.data.length) > 0">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">{{ $t('projects.admin_projects') }}</h3>
					</div>
					<div class="overlay" v-if="adminProjectsLoading">
						<i class="fa fa-refresh fa-spin"></i>
					</div>
					<div class="box-body" v-if="!adminProjectsLoading">
						<p class="m-b-none" v-if="(ownerProjects.data.length + adminProjects.data.length) === 0">
							{{ $t('projects.no_project_yet') }}
						</p>
						<div class="dataTables_wrapper form-inline dt-bootstrap" v-if="ownerProjects.data.length > 0">
							<div class="row">
								<div class="col-sm-6">
									<div class="dataTables_length">

									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-12 table-responsive">
									<table aria-describedby="example1_info" role="grid" class="table table-bordered table-striped dataTable">
										<thead>
										<tr role="row">
											<th>{{ $t('projects.project_name') }}</th>
											<th>{{ $t('common.created_at') }}</th>
											<th>{{ $t('common.updated_at') }}</th>
											<th></th>
										</tr>
										</thead>
										<tbody>

										<tr v-for="project in adminProjects.data" role="row">
											<!-- Name -->
											<td class="col-md-2" style="vertical-align: middle;">
												<router-link :to="{ name: 'user-project', params: { projectId: project.id }}">{{ project.name }}</router-link>
											</td>

											<!-- Created At -->
											<td class="col-md-2" style="vertical-align: middle;">
												{{ momentLocalDate(project.created_at) }}
											</td>

											<!-- Updated At -->
											<td class="col-md-2" style="vertical-align: middle;">
												{{ momentLocalDate(project.updated_at) }}
											</td>

											<!-- Buttons -->
											<td class="col-md-1 text-right" style="vertical-align: middle;">

											</td>
										</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="box-footer clearfix">
						<ul class="pagination pagination-sm no-margin pull-right">
							<li><a href="#">&laquo;</a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">&raquo;</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	export default {
		/**
		 * Component created
		 */
		created() {
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
				this.$store.dispatch('getUserOwnerProjects');
				this.$store.dispatch('getUserAdminProjects');
			},
		},

		computed: {
			ownerProjects() {
				return this.$store.state.ownerProjects;
			},
			ownerProjectsLoading() {
				return this.$store.state.ownerProjectsLoading;
			},
			adminProjects() {
				return this.$store.state.adminProjects;
			},
			adminProjectsLoading() {
				return this.$store.state.adminProjectsLoading;
			},
		},
	}
</script>
