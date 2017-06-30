<style scoped>
	.data-stream-name {
		font-size: 21px;
		margin-top: 5px;
		margin-bottom: 10px;
	}
</style>

<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div v-if="dataStream != null" class="col-md-3 no-right-padding">
				<div class="box box-primary">
					<div class="box-body">
						<h3 class="text-center data-stream-name" v-html="dataStream.name"></h3>

						<ul class="list-group list-group-unbordered">
							<li v-if="(['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1)" class="list-group-item">
								<b v-html="$t('data_streams.id')"></b>
								<span class="pull-right" v-html="dataStream.id"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('data_streams.project_name')"></b>
								<span v-if="dataStream.project != null" class="pull-right">
									<router-link
										:to="{ name: 'project', params : { 'projectId' : dataStream.project.data.id }}"
										v-html="dataStream.project.data.name">
									</router-link>
								</span>
								<span v-else class="pull-right">-</span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('data_streams.data_stream_decoder_name')"></b>
								<span v-if="(['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1)" class="pull-right">
									<router-link
										:to="{ name: 'data-stream-decoder', params : { 'dataStreamDecoderId' : dataStream.data_stream_decoder_id }}"
										v-html="dataStream.dataStreamDecoder.data.name">
									</router-link>
								</span>
								<span v-else class="pull-right" v-html="dataStream.dataStreamDecoder.data.name"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('data_streams.name')"></b>
								<span class="pull-right" v-html="dataStream.name"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('data_streams.feed_url')"></b>
								<span class="pull-right" v-html="dataStream.feed_url"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('common.created_at')"></b>
								<span class="pull-right" v-html="momentLocalDate(dataStream.created_at)"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('common.updated_at')"></b>
								<span class="pull-right" v-html="momentLocalDate(dataStream.updated_at)"></span>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li v-if="dataStream != null" class="active">
							<a href="#i18n-langs-tab-pane" data-toggle="tab">
								<i class="fa fa-language fa-fw"></i> <span v-html="$t('data_streams.i18n_langs')"></span>
							</a>
						</li>
						<li v-if="dataStream != null">
							<a href="#data-stream-fields-tab-pane" data-toggle="tab">
								<i class="fa fa-list fa-fw"></i> <span v-html="$t('data_streams.data_stream_fields')"></span>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="i18n-langs-tab-pane">
							<DataManager
								v-if="dataStream != null"
								:rights="{
									allowSee: false,
									allowCreate: true,
									allowEdit: false,
									allowDelete : true,
									allowMassDelete : true,
								}"
								i18nPath="data_stream_has_i18n_langs.data_manager.data_stream_has_i18n_langs"
								:resource="dataStreamDataStreamHasI18nLangsDataManagerResource"
								:defaultOrderBy="{column: 'i18n_lang_id', direction: 'asc'}"
								:pagination="{limiting: true, defaultLimit: 10, limits: [5, 10, 20]}"
								:searching="true"
								:request="{include: 'dataStream,i18nLang', extraParameters: {dataStreamId: dataStream.id}}"
								:store="{
									stateName: 'dataStreamDataStreamHasI18nLangs',
									loadingStateName: 'dataStreamDataStreamHasI18nLangsLoading',
									dispatchAction: 'getDataStreamDataStreamHasI18nLangs'
								}"
								:columns="dataStreamDataStreamHasI18nLangsColumns"
							></DataManager>
						</div>
						<div class="tab-pane" id="data-stream-fields-tab-pane">
							<DataManager
								v-if="dataStream != null"
								:rights="{
									allowSee: false,
									allowCreate: true,
									allowEdit: true,
									allowDelete : true,
									allowMassDelete : true,
								}"
								i18nPath="data_stream_fields.data_manager.data_stream_fields"
								:resource="dataStreamDataStreamFieldsDataManagerResource"
								:defaultOrderBy="{column: 'name', direction: 'asc'}"
								:pagination="{limiting: true, defaultLimit: 10, limits: [5, 10, 20]}"
								:searching="true"
								:request="{include: 'dataStream', extraParameters: {dataStreamId: dataStream.id}}"
								:store="{
									stateName: 'dataStreamDataStreamFields',
									loadingStateName: 'dataStreamDataStreamFieldsLoading',
									dispatchAction: 'getDataStreamDataStreamFields'
								}"
								:columns="dataStreamDataStreamFieldsColumns"
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
		name: 'DataStream',

		components: { DataManager },

		data() {
			return {
				dataStream : null,
			}
		},

		props : {
			'dataStreamId' : String
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
			dataStreamDataStreamFieldsDataManagerResource() {
				return {
					name: 'dataStreamField',
					create: {
						postUri: '/dataStreamField',
					},
					edit: {
						putUriTemplate: '/dataStreamField/<%- resourceRow.id %>',
					},
					delete: {
						deleteUriTemplate: '/dataStreamField/<%- resourceRow.id %>',
					},
					createDefaultResourceRow: {}
				}
			},

			dataStreamDataStreamFieldsColumns() {
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
						name : 'data_stream_id',
						displayProp : 'dataStream.data.name',
						orderable : false,

						type : 'select2',
						select2 : {
							labelProp : 'name',
							valueProp : 'id',
							feed : {
								getUri : '/dataStream',
								params : {
									limit: 10,
									order_by: 'name,asc',
								}
							},
						},

						routerLink : {
							routeName : 'data-stream',
							paramsNames : {
								'dataStreamId' : 'data_stream_id'
							}
						},

						list: {
							visible: false,
						},

						create : {
							fillable: true,
							defaultValue: this.dataStream.id,
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

			dataStreamDataStreamHasI18nLangsDataManagerResource() {
				return {
					name: 'dataStreamHasI18nLang',
					create: {
						postUri: '/dataStreamHasI18nLang',
					},
					edit: {
						putUriTemplate: '/dataStreamHasI18nLang/<%- resourceRow.data_stream_id %>,<%- resourceRow.i18n_lang_id %>',
					},
					delete: {
						deleteUriTemplate: '/dataStreamHasI18nLang/<%- resourceRow.data_stream_id %>,<%- resourceRow.i18n_lang_id %>',
					},
					createDefaultResourceRow: {}
				}
			},

			dataStreamDataStreamHasI18nLangsColumns() {
				return [
					{
						name : 'data_stream_id',
						displayProp : 'dataStream.data.name',
						orderable : false,
						type : 'select2',
						select2 : {
							labelProp : 'name',
							valueProp : 'id',
							feed : {
								getUri : '/dataStream',
								params : {
									limit: 10,
									order_by: 'name,asc',
								}
							},
						},

						routerLink : {
							routeName : 'data-stream',
							paramsNames : {
								'dataStreamId' : 'data_stream_id'
							}
						},

						list: {
							visible: false,
						},

						create : {
							fillable: true,
							defaultValue: this.dataStream.id,
						},

						edit : {
							fillable: true,
						}
					},
					{
						name : 'i18n_lang_id',
						displayProp : 'i18nLang.data.id',
						orderable : true,
						order_by_field : 'i18n_lang_id',

						type : 'select2',
						select2 : {
							labelProp : 'id',
							valueProp : 'id',
							feed : {
								getUri : '/i18nLang',
								params : {
									limit: 10,
									order_by: 'id,asc',
								}
							},
						},

						routerLink : {
							routeName : 'i18n-lang',
							paramsNames : {
								'i18nLangId' : 'i18n_lang_id'
							}
						},

						list: {
							visible: true,
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
						},
					},
				];
			},
		},

		methods: {
			fetchData() {
				this.dataStream = null;

				var propsData = this.$options.propsData;
				this.getDataStream(propsData.dataStreamId);
			},

			getDataStream(dataStreamId) {
				apiAxios
					.get('/dataStream/' + dataStreamId, { params : { include : 'dataStreamDecoder,project' } })
					.then(response => {
						this.dataStream = response.data.data;
						this.$emit('routeTitleDataUpdate', this.dataStream);
					}).catch(error => {
						this.$root.axiosError(error);
					});
			},
		}
	}
</script>
