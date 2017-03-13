<style scoped>
	.action-link {
		cursor: pointer;
	}

	.m-b-none {
		margin-bottom: 0;
	}
</style>

<template>
	<div v-if="$root.fetched">
		<div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<span>
							{{ $t('projects.owner_projects') }}
						</span>

						<a class="action-link">
							{{ $t('projects.create_new_project') }}
						</a>
					</div>
				</div>

				<div class="panel-body">

					<p class="m-b-none" v-if="(owner_projects.length + admin_projects.length) === 0">
						{{ $t('projects.no_project_yet') }}
					</p>

					<table class="table table-borderless m-b-none table-condensed" v-if="owner_projects.length > 0">
						<thead>
						<tr>
							<th>{{ $t('projects.project_name') }}</th>
							<th>{{ $t('common.created_at') }}</th>
							<th>{{ $t('common.updated_at') }}</th>
							<th></th>
							<th></th>
						</tr>
						</thead>

						<tbody>
						<tr v-for="project in owner_projects">
							<!-- Name -->
							<td class="col-md-2" style="vertical-align: middle;">
								{{ project.name }}
							</td>

							<!-- Created At -->
							<td class="col-md-2" style="vertical-align: middle;">
								{{ momentLocalDate(project.created_at) }}
							</td>

							<!-- Updated At -->
							<td class="col-md-2" style="vertical-align: middle;">
								{{ momentLocalDate(project.updated_at) }}
							</td>

							<!-- Edit Button -->
							<td class="col-md-1 text-right" style="vertical-align: middle;">
								<a class="action-link">
									{{ $t('projects.edit_btn') }}
								</a>
							</td>

							<!-- Delete Button -->
							<td class="col-md-1 text-right"  style="vertical-align: middle;">
								<a class="action-link text-danger">
									{{ $t('projects.delete_btn') }}
								</a>
							</td>
						</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div v-if="(admin_projects.length) > 0">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<span>
							{{ $t('projects.admin_projects') }}
						</span>
					</div>
				</div>

				<div class="panel-body">

					<table class="table table-borderless m-b-none table-condensed">
						<thead>
						<tr>
							<th>{{ $t('projects.project_name') }}</th>
							<th>{{ $t('common.created_at') }}</th>
							<th>{{ $t('common.updated_at') }}</th>
						</tr>
						</thead>

						<tbody>
						<tr v-for="project in admin_projects">
							<!-- Name -->
							<td class="col-md-2" style="vertical-align: middle;">
								{{ project.name }}
							</td>

							<!-- Created At -->
							<td class="col-md-2" style="vertical-align: middle;">
								{{ momentLocalDate(project.created_at) }}
							</td>

							<!-- Updated At -->
							<td class="col-md-2" style="vertical-align: middle;">
								{{ momentLocalDate(project.updated_at) }}
							</td>

						</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		/**
		 * The component's data.
		 */
		data() {
			return {
				owner_projects : [],
				admin_projects: []
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
				this.$root.resetLoading();

				this.owner_projects = [];
				this.admin_projects = [];

				this.getUserProjects();
			},

			/**
			 * Get all of the projetcs for the user.
			 */
			getUserProjects() {
				this.getUserOwnerProjects();
			},

			getUserOwnerProjects() {
				apiAxios.get('/user/' + this.$root.me.id + '/project?user_role_id=Owner')
						.then(response => {
					this.owner_projects = response.data.data;
				this.getUserAdminProjects();
			}).catch(error => {
					this.$root.axiosError(error);
			}
			);
			},

			getUserAdminProjects() {
				apiAxios.get('/user/' + this.$root.me.id + '/project?user_role_id=Administrator')
						.then(response => {
					this.admin_projects = response.data.data;

				this.$root.loadingComplete();
			});
			}
		}
	}
</script>
