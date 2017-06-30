<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<DataManager
					:rights="{
						allowSee: true,
						allowCreate: true,
						allowEdit: true,
						allowDelete: true,
						allowMassDelete: true,
					}"
					i18nPath="data_stream_presets.data_manager.data_stream_presets"
					:resource="dataStreamPresetsDataManagerResource"
					:defaultOrderBy="{column: 'name', direction: 'asc'}"
					:pagination="{limiting: true, defaultLimit: 20, limits: [5, 10, 20]}"
					:searching="true"
					:store="{stateName: 'dataStreamPresets', loadingStateName: 'dataStreamPresetsLoading', dispatchAction: 'getDataStreamPresets'}"
					:columns="dataStreamPresetsDataManagerColumns"
				></DataManager>
			</div>
		</div>
	</section>
</template>

<script>
	import DataManager from '../includes/data-manager'

	export default {
		name: 'DataStreamPresets',

		components: { DataManager },

		computed: {
			dataStreamPresetsDataManagerResource() {
				return {
					name: 'dataStreamPreset',
					routePath: 'data-stream-preset',
					routeParamsMap: {
						'dataStreamPresetId': 'id',
					},
					create: {
						postUri: '/dataStreamPreset',
					},
					edit: {
						putUriTemplate: '/dataStreamPreset/<%- resourceRow.id %>',
					},
					delete: {
						deleteUriTemplate: '/dataStreamPreset/<%- resourceRow.id %>',
					},
					createDefaultResourceRow: {}
				}
			},
			dataStreamPresetsDataManagerColumns() {
				return [
					{
						name : 'id',
						class : '',
						orderable : true,
						order_by_field: 'id',

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
						order_by_field: 'name',
						routerLink: {
							routeName: 'data-stream-preset',
							paramsNames: {
								'dataStreamPresetId': 'id'
							}
						},
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
					},
				];
			},
		},
	}
</script>
