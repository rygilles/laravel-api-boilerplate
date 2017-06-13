<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<DataManager
					i18nPath="search_engines.data_manager.search_engines"
					:resource="dataManagerResource"
					:defaultOrderBy="{column: 'name', direction: 'asc'}"
					:pagination="{limiting: true, defaultLimit: 20, limits: [10, 20]}"
					:searching="true"
					:store="{stateName: 'searchEngines', loadingStateName: 'searchEnginesLoading', dispatchAction: 'getSearchEngines'}"
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
		name: 'SearchEngines',

		components: { DataManager },

		computed: {
			dataManagerResource() {
				return {
					name: 'searchEngines',
					routePath: 'search-engine',
					routeParamsMap: {
						'searchEngineId': 'id',
					},
					create: {
						postUri: '/searchEngine',
					},
					edit: {
						putUriTemplate: '/searchEngine/<%- resourceRow.id %>',
					},
					delete: {
						deleteUriTemplate: '/searchEngine/<%- resourceRow.id %>',
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
						type: 'input',

						create: {
							fillable: false,
						},

						edit: {
							fillable: false,
						}
					},
					{
						name : 'name',
						class : 'col-md-2',
						orderable : true,
						order_by_field : 'name',
						type: 'input',

						create : {
							fillable: true,
							defaultValue: '',
						},

						edit : {
							fillable: true,
						}
					},
					{
						name : 'projects_count',
						class : '',
						orderable : true,
						order_by_field : 'projects_count',

						create : {
							fillable: false,
						},

						edit : {
							fillable: false,
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
