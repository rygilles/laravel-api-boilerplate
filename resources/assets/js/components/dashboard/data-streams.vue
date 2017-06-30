<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<DataManager
					:rights="{
						allowSee: true,
						allowCreate: false,
						allowEdit: true,
						allowDelete: true,
						allowMassDelete: true,
					}"
					i18nPath="data_streams.data_manager.data_streams"
					:resource="dataStreamsDataManagerResource"
					:defaultOrderBy="{column: 'name', direction: 'asc'}"
					:pagination="{limiting: true, defaultLimit: 20, limits: [5, 10, 20]}"
					:searching="true"
					:request="{include: 'dataStreamDecoder,project'}"
					:store="{stateName: 'dataStreams', loadingStateName: 'dataStreamsLoading', dispatchAction: 'getDataStreams'}"
					:columns="dataStreamsDataManagerColumns"
				></DataManager>
			</div>
		</div>
	</section>
</template>

<script>
	import DataManager from '../includes/data-manager'

	export default {
		name: 'DataStreams',

		components: { DataManager },

		computed: {
			dataStreamsDataManagerResource() {
				return {
					name: 'dataStream',
					routePath: 'data-stream',
					routeParamsMap: {
						'dataStreamId': 'id',
					},
					create: {
						postUri: '/dataStream',
					},
					edit: {
						putUriTemplate: '/dataStream/<%- resourceRow.id %>',
					},
					delete: {
						deleteUriTemplate: '/dataStream/<%- resourceRow.id %>',
					},
					createDefaultResourceRow: {}
				}
			},
			dataStreamsDataManagerColumns() {
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
						name : 'project_name',
						displayProp : 'project.data.name',
						class : '',
						orderable : false,
						routerLink : {
							routeName : 'project',
							paramsNames : {
								'projectId' : 'project.data.id'
							}
						},

						create: {
							fillable: false,
						},

						edit: {
							fillable: false,
						}
					},
					{
						name : 'data_stream_decoder_id',
						displayProp: 'dataStreamDecoder.data.name',
						class : '',
						orderable : false,
						routerLink : {
							routeName : 'data-stream-decoder',
							paramsNames : {
								'dataStreamDecoderId' : 'data_stream_decoder_id'
							}
						},

						type : 'select2',
						select2 : {
							labelProp : 'name',
							valueProp : 'id',
							feed : {
								getUri : '/dataStreamDecoder',
								params : {
									limit: 10,
									order_by: 'name,asc',
								}
							},
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
						name : 'name',
						class : '',
						orderable : true,
						order_by_field: 'name',
						routerLink: {
							routeName: 'data-stream',
							paramsNames: {
								'dataStreamId': 'id'
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
						name : 'feed_url',
						class : '',
						orderable : true,
						order_by_field: 'feed_url',

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
