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
					routePath: 'project',
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
						name : 'id',
						class : 'col-md-3 id-column',
						orderable : true,
						order_by_field : 'id',

						list: {
							visible: (['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1)
						},

						create: {
							fillable: false,
						},

						edit: {
							fillable: false,
						},
					},
					{
						name : 'name',
						class : '',
						orderable : true,
						order_by_field : 'name',
						type: 'input',

						routerLink : {
							routeName : 'project',
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
						name : 'search_engine_id',
						displayProp: 'searchEngine.data.name',
						class : '',
						orderable : false,
						routerLink : {
							routeName : 'search-engine',
							paramsNames : {
								'searchEngineId' : 'search_engine_id'
							}
						},

						type : 'select2',
						select2 : {
							labelProp : 'name',
							valueProp : 'id',
							feed : {
								getUri : '/searchEngine',
								params : {
									limit: 10,
									order_by: 'name,asc',
								}
							},
						},

						list: {
							visible: (['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1)
						},

						create : {
							fillable: (['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1),
							defaultValue: 'ee87e3b2-1388-11e7-93ae-92361f002671', /* Algolia */
						},

						edit : {
							fillable: (['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1),
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
					routePath: 'project',
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
						name : 'id',
						class : 'col-md-3 id-column',
						orderable : true,
						order_by_field : 'id',

						list: {
							visible: (['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1)
						},

						create: {
							fillable: false,
						},

						edit: {
							fillable: false,
						},
					},
					{
						name : 'name',
						class : '',
						orderable : true,
						order_by_field : 'name',
						type: 'input',

						routerLink : {
							routeName : 'project',
							paramsNames : {
								'projectId' : 'id'
							}
						},

						create : {
							fillable: false,
							defaultValue: '',
						},

						edit : {
							fillable: false,
						}
					},
					{
						name : 'search_engine_id',
						displayProp: 'searchEngine.data.name',
						class : '',
						orderable : false,
						routerLink : {
							routeName : 'search-engine',
							paramsNames : {
								'searchEngineId' : 'search_engine_id'
							}
						},

						type : 'select2',
						select2 : {
							labelProp : 'name',
							valueProp : 'id',
							feed : {
								getUri : '/searchEngine',
								params : {
									limit: 10,
									order_by: 'name,asc',
								}
							},
						},

						list: {
							visible: (['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1)
						},

						create : {
							fillable: false,
						},

						edit : {
							fillable: false,
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
