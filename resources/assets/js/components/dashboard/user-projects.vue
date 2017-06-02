<style>
	td.id-column {
		font-family: monospace;
		font-weight: bold;
	}
</style>

<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#user-owner-projects-tab-pane" data-toggle="tab">
								<span v-html="$t('projects.data_manager.owner_projects.main_title')"></span>
							</a>
						</li>
						<li v-if="!('pagination' in adminProjectsDataStoreState.meta) || ((adminProjectsDataStoreState.data.length) > 0)">
							<a href="#user-admin-projects-tab-pane" data-toggle="tab">
								<span v-html="$t('projects.data_manager.admin_projects.main_title')"></span>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="user-owner-projects-tab-pane">
							<DataManager
								i18nPath="projects.data_manager.owner_projects"
								:resource="ownerDataManagerResource"
								:defaultOrderBy="{column: 'name', direction: 'asc'}"
								:pagination="{limiting: false, defaultLimit: 30}"
								:searching="false"
								:request="{include: 'searchEngine'}"
								:store="{stateName: 'ownerProjects', loadingStateName: 'ownerProjectsLoading', dispatchAction: 'getUserOwnerProjects'}"
								:columns="ownerDataManagerColumns"
								buttonsColumnClass="col-md-2"
								:checkboxes="{enabled: false}"
							></DataManager>
						</div>
						<div v-if="!('pagination' in adminProjectsDataStoreState.meta) || ((adminProjectsDataStoreState.data.length) > 0)"
							 class="tab-pane"
							 id="user-admin-projects-tab-pane"
						>
							<DataManager
								:rights="{allowCreate: false, allowEdit: false, allowDelete: false, allowMassDelete: false}"
								i18nPath="projects.data_manager.admin_projects"
								:resource="adminDataManagerResource"
								:defaultOrderBy="{column: 'name', direction: 'asc'}"
								:pagination="{limiting: false, defaultLimit: 30}"
								:searching="false"
								:request="{include: 'searchEngine'}"
								:store="{stateName: 'adminProjects', loadingStateName: 'adminProjectsLoading', dispatchAction: 'getUserAdminProjects'}"
								:columns="adminDataManagerColumns"
								buttonsColumnClass="col-md-2"
								:checkboxes="{enabled: false}"
							></DataManager>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	import DataManager from '../includes/data-manager'

	export default {
		name: 'Projects',

		components: { DataManager },

		computed: {
			ownerDataManagerResource() {
				return {
					name: 'project',
					routePath: 'user-project',
					routeParamsMap: {
						'projectId': 'id',
					},
					create: {
						postUri: '/project',
					},
					edit: {
						putUriTemplate: '/project/<%- resourceRow.id %>',
					},
					delete: {
						deleteUriTemplate: '/project/<%- resourceRow.id %>',
					},
					createDefaultResourceRow: {}
				}
			},
			ownerDataManagerColumns() {
				return [
					{
						name : 'name',
						class : 'col-md-6',
						orderable : true,
						order_by_field : 'name',
						type: 'input',

						routerLink : {
							routeName : 'user-project',
							paramsNames : {
								'projectId' : 'id'
							}
						},

						create : {
							fillable: true,
							defaultValue: '',
						},

						edit : {
							fillable: true,
						}
					},
					{
						name : 'created_at',
						class : 'col-md-2',
						orderable : true,
						order_by_field : 'created_at',
						transformValue : (value) => {
							return this.momentLocalDate(value);
						},

						create: {
							fillable: false,
						},

						edit: {
							fillable: false,
						}
					},
					{
						name : 'updated_at',
						class : 'col-md-2',
						orderable : true,
						order_by_field : 'updated_at',
						transformValue : (value) => {
							return this.momentLocalDate(value);
						},

						create: {
							fillable: false,
						},

						edit: {
							fillable: false,
						}
					}
				];
			},

			adminDataManagerResource() {
				return {
					name: 'project',
					routePath: 'user-project',
					routeParamsMap: {
						'projectId': 'id',
					},
					create: {
						postUri: '/project',
					},
					edit: {
						putUriTemplate: '/project/<%- resourceRow.id %>',
					},
					delete: {
						deleteUriTemplate: '/project/<%- resourceRow.id %>',
					},
					createDefaultResourceRow: {}
				}
			},
			adminDataManagerColumns() {
				return [
					{
						name : 'name',
						class : 'col-md-6',
						orderable : true,
						order_by_field : 'name',
						type: 'input',

						routerLink : {
							routeName : 'user-project',
							paramsNames : {
								'projectId' : 'id'
							}
						},

						create : {
							fillable: true,
							defaultValue: '',
						},

						edit : {
							fillable: true,
						}
					},
					{
						name : 'created_at',
						class : 'col-md-2',
						orderable : true,
						order_by_field : 'created_at',
						transformValue : (value) => {
							return this.momentLocalDate(value);
						},

						create: {
							fillable: false,
						},

						edit: {
							fillable: false,
						}
					},
					{
						name : 'updated_at',
						class : 'col-md-2',
						orderable : true,
						order_by_field : 'updated_at',
						transformValue : (value) => {
							return this.momentLocalDate(value);
						},

						create: {
							fillable: false,
						},

						edit: {
							fillable: false,
						}
					}
				];
			},

			adminProjectsDataStoreState() {
				return this.$store.state.adminProjects;
			},
		},
	}
</script>
