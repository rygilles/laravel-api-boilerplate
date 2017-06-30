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
					i18nPath="data_stream_decoders.data_manager.data_stream_decoders"
					:resource="dataStreamDecodersDataManagerResource"
					:defaultOrderBy="{column: 'name', direction: 'asc'}"
					:pagination="{limiting: true, defaultLimit: 20, limits: [5, 10, 20]}"
					:searching="true"
					:store="{stateName: 'dataStreamDecoders', loadingStateName: 'dataStreamDecodersLoading', dispatchAction: 'getDataStreamDecoders'}"
					:columns="dataStreamDecodersDataManagerColumns"
				></DataManager>
			</div>
		</div>
	</section>
</template>

<script>
	import DataManager from '../includes/data-manager'

	export default {
		name: 'DataStreamDecoders',

		components: { DataManager },

		computed: {
			dataStreamDecodersDataManagerResource() {
				return {
					name: 'dataStreamDecoder',
					routePath: 'data-stream-decoder',
					routeParamsMap: {
						'dataStreamDecoderId': 'id',
					},
					create: {
						postUri: '/dataStreamDecoder',
					},
					edit: {
						putUriTemplate: '/dataStreamDecoder/<%- resourceRow.id %>',
					},
					delete: {
						deleteUriTemplate: '/dataStreamDecoder/<%- resourceRow.id %>',
					},
					createDefaultResourceRow: {}
				}
			},
			dataStreamDecodersDataManagerColumns() {
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
							routeName: 'data-stream-decoder',
							paramsNames: {
								'dataStreamDecoderId': 'id'
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
						name : 'class_name',
						class : '',
						orderable : true,
						order_by_field: 'class_name',

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
						name : 'file_mime_type',
						class : '',
						orderable : true,
						order_by_field: 'file_mime_type',

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
