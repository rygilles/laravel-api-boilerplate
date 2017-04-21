<style scoped>
	.action-link {
		cursor: pointer;
	}

	.m-b-none {
		margin-bottom: 0;
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
					<div class="overlay" v-if="loading_owner_projects">
						<i class="fa fa-refresh fa-spin"></i>
					</div>
					<div class="box-body" v-if="!loading_owner_projects">
						<p class="m-b-none" v-if="(owner_projects.length + admin_projects.length) === 0">
							{{ $t('projects.no_project_yet') }}
						</p>
						<div class="dataTables_wrapper form-inline dt-bootstrap" v-if="owner_projects.length > 0">
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

										<tr v-for="project in owner_projects" role="row">
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
		<div class="row" v-if="(admin_projects.length) > 0">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">{{ $t('projects.admin_projects') }}</h3>
					</div>
					<div class="overlay" v-if="loading_admin_projects">
						<i class="fa fa-refresh fa-spin"></i>
					</div>
					<div class="box-body" v-if="!loading_admin_projects">>
						<p class="m-b-none" v-if="(owner_projects.length + admin_projects.length) === 0">
							{{ $t('projects.no_project_yet') }}
						</p>
						<div class="dataTables_wrapper form-inline dt-bootstrap" v-if="owner_projects.length > 0">
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

										<tr v-for="project in admin_projects" role="row">
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
		 * The component's data.
		 */
		data() {
			return {
				owner_projects : [],
				admin_projects: [],
				loading_owner_projects: true,
				loading_admin_projects: true,
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

		/**
		 * Component watcher
		 */
		watch: {
			// call again the method if the route changes
			'$route' : 'fetchData'
		},

		methods: {
			fetchData() {
				this.owner_projects = [];
				this.admin_projects = [];

				this.getUserProjects();
			},

			/**
			 * Get all of the projetcs for the user.
			 */
			getUserProjects() {
				this.getUserOwnerProjects();
				this.getUserAdminProjects();
			},

			getUserOwnerProjects() {
				this.loading_owner_projects = true;
				apiAxios.get('/me/project?user_role_id=Owner')
					.then(response => {
						this.owner_projects = response.data.data;
						this.loading_owner_projects = false;
					}).catch(error => {
						this.$root.axiosError(error);
					});
			},

			getUserAdminProjects() {
				this.loading_admin_projects = true;
				apiAxios.get('/me/project?user_role_id=Administrator')
					.then(response => {
						this.admin_projects = response.data.data;
						this.loading_admin_projects = false;
					}).catch(error => {
						this.$root.axiosError(error);
					});
			}
		}
	}
</script>
