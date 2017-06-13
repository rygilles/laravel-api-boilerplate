<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<DataManager
					i18nPath="projects.data_manager.all_projects"
					:resource="dataManagerResource"
					:defaultOrderBy="{column: 'name', direction: 'asc'}"
					:pagination="{limiting: true, defaultLimit: 30, limits: [10, 20, 30, 40, 50]}"
					:searching="true"
					:request="{include: 'searchEngine'}"
					:store="{stateName: 'allProjects', loadingStateName: 'allProjectsLoading', dispatchAction: 'getAllProjects'}"
					:columns="dataManagerColumns"
					buttonsColumnClass="col-md-2"
				></DataManager>
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
			dataManagerResource() {
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
			dataManagerColumns() {
				return [
					{
						name : 'id',
						class : 'col-md-3 id-column',
						orderable : true,
						order_by_field : 'id',

						create: {
							fillable: false,
						},

						edit: {
							fillable: false,
						}
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

						create : {
							fillable: true,
							defaultValue: 'ee87e3b2-1388-11e7-93ae-92361f002671', /* Algolia */
						},

						edit : {
							fillable: true,
						}
					},
					{
						name : 'created_at',
						class : '',
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
						class : '',
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
		},
	}
</script>
