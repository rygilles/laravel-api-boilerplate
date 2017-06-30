<style scoped>
	.data-stream-preset-name {
		font-size: 21px;
		margin-top: 5px;
		margin-bottom: 10px;
	}
</style>

<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div v-if="dataStreamPreset != null" class="col-md-3 no-right-padding">
				<div class="box box-primary">
					<div class="box-body">
						<h3 class="text-center data-stream-preset-name" v-html="dataStreamPreset.name"></h3>

						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<b v-html="$t('data_stream_presets.id')"></b>
								<span class="pull-right" v-html="dataStreamPreset.id"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('data_stream_presets.name')"></b>
								<span class="pull-right" v-html="dataStreamPreset.name"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('common.created_at')"></b>
								<span class="pull-right" v-html="momentLocalDate(dataStreamPreset.created_at)"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('common.updated_at')"></b>
								<span class="pull-right" v-html="momentLocalDate(dataStreamPreset.updated_at)"></span>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li v-if="dataStreamPreset != null" class="active">
							<a href="#data-stream-preset-fields" data-toggle="tab">
								<i class="fa fa-list fa-fw"></i> <span v-html="$t('data_stream_presets.data_stream_preset_fields')"></span>
							</a>
						</li>

						<li v-if="dataStreamPreset != null">
							<a href="#widget-presets-tab-pane" data-toggle="tab">
								<i class="fa fa-tachometer fa-fw"></i> <span v-html="$t('data_stream_presets.widget_presets')"></span>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="data-stream-preset-fields">
							<DataManager
								v-if="dataStreamPreset != null"
								:rights="{
									allowSee: false,
									allowCreate: true,
									allowEdit: true,
									allowDelete : true,
									allowMassDelete : true,
								}"
								i18nPath="data_stream_preset_fields.data_manager.data_stream_preset_fields"
								:resource="dataStreamPresetDataStreamPresetFieldsDataManagerResource"
								:defaultOrderBy="{column: 'name', direction: 'asc'}"
								:pagination="{limiting: true, defaultLimit: 10, limits: [5, 10, 20]}"
								:searching="true"
								:request="{include: 'dataStreamPreset', extraParameters: {dataStreamPresetId: dataStreamPreset.id}}"
								:store="{
									stateName: 'dataStreamPresetDataStreamPresetFields',
									loadingStateName: 'dataStreamPresetDataStreamPresetFieldsLoading',
									dispatchAction: 'getDataStreamPresetDataStreamPresetFields'
								}"
								:columns="dataStreamPresetDataStreamPresetFieldsColumns"
							></DataManager>
						</div>
						<div class="tab-pane" id="widget-presets-tab-pane">
							TODO
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
		name: 'DataStreamPreset',

		components: { DataManager },

		data() {
			return {
				dataStreamPreset : null,
			}
		},

		props : {
			'dataStreamPresetId' : String
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
			'$route' : function(val) {
				this.fetchData();
			}
		},

		computed: {
			dataStreamPresetDataStreamPresetFieldsDataManagerResource() {

				return {
					name: 'dataStreamPresetField',
					create: {
						postUri: '/dataStreamPresetField',
					},
					edit: {
						putUriTemplate: '/dataStreamPresetField/<%- resourceRow.id %>',
					},
					delete: {
						deleteUriTemplate: '/dataStreamPresetField/<%- resourceRow.id %>',
					},
					createDefaultResourceRow: {}
				}
			},

			dataStreamPresetDataStreamPresetFieldsColumns() {
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
						name : 'data_stream_preset_id',
						displayProp : 'dataStreamPreset.data.name',
						orderable : false,

						type : 'select2',
						select2 : {
							labelProp : 'name',
							valueProp : 'id',
							feed : {
								getUri : '/dataStreamPreset',
								params : {
									limit: 10,
									order_by: 'name,asc',
								}
							},
						},

						routerLink : {
							routeName : 'data-stream-preset',
							paramsNames : {
								'dataStreamPresetId' : 'data_stream_preset_id'
							}
						},

						create : {
							fillable: true,
							defaultValue: this.dataStreamPreset.id,
						},

						edit : {
							fillable: true,
						}
					},
					{
						name : 'name',
						class : '',
						orderable : true,
						order_by_field : 'name',
						type : 'input',

						create : {
							fillable: true,
							defaultValue: '',
						},

						edit : {
							fillable: true,
						}
					},
					{
						name : 'path',
						class : '',
						orderable : true,
						order_by_field : 'path',
						type : 'input',

						create : {
							fillable: true,
							defaultValue: '',
						},

						edit : {
							fillable: true,
						}
					},
					{
						name : 'versioned',
						class : '',
						orderable : true,
						order_by_field : 'versioned',
						type : 'boolean',

						transformValue : (value) => {
							if (value) {
								return '<span class="fa fa-check"></span>';
							} else {
								return '<span class="fa fa-close"></span>';
							}
						},

						create : {
							fillable: true,
							defaultValue: false,
						},

						edit : {
							fillable: true,
						}
					},
					{
						name : 'searchable',
						class : '',
						orderable : true,
						order_by_field : 'searchable',
						type : 'boolean',

						transformValue : (value) => {
							if (value) {
								return '<span class="fa fa-check"></span>';
							} else {
								return '<span class="fa fa-close"></span>';
							}
						},

						create : {
							fillable: true,
							defaultValue: false,
						},

						edit : {
							fillable: true,
						}
					},
					{
						name : 'to_retrieve',
						class : '',
						orderable : true,
						order_by_field : 'to_retrieve',
						type : 'boolean',

						transformValue : (value) => {
							if (value) {
								return '<span class="fa fa-check"></span>';
							} else {
								return '<span class="fa fa-close"></span>';
							}
						},

						create : {
							fillable: true,
							defaultValue: false,
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

		methods: {
			fetchData() {
				this.dataStreamPreset = null;

				var propsData = this.$options.propsData;
				this.getDataStreamPreset(propsData.dataStreamPresetId);
			},

			getDataStreamPreset(dataStreamPresetId) {
				apiAxios
					.get('/dataStreamPreset/' + dataStreamPresetId)
					.then(response => {
						this.dataStreamPreset = response.data.data;
						this.$emit('routeTitleDataUpdate', this.dataStreamPreset);
					}).catch(error => {
						this.$root.axiosError(error);
					});
			},
		}
	}
</script>
