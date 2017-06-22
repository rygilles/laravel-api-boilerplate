<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<DataManager
					:rights="{allowSee: false}"
					i18nPath="sync_task_type_versions.data_manager.sync_task_type_sync_task_type_versions"
					:resource="syncTaskTypeSyncTaskTypeVersionsDataManagerResource"
					:defaultOrderBy="{column: 'i18n_lang_id', direction: 'asc'}"
					:pagination="{limiting: true, defaultLimit: 20, limits: [5, 10, 20]}"
					:searching="true"
					:request="{extraParameters: {syncTaskTypeId: syncTaskTypeId}}"
					:store="{
						stateName: 'syncTaskTypeSyncTaskTypeVersions',
						loadingStateName: 'syncTaskTypeSyncTaskTypeVersionsLoading',
						dispatchAction: 'getSyncTaskTypeSyncTaskTypeVersions'
					}"
					:columns="syncTaskTypeSyncTaskTypeVersionsDataManagerColumns"
					buttonsColumnClass="col-md-2"
				></DataManager>
			</div>
		</div>
	</section>
</template>

<script>
	import DataManager from '../includes/data-manager'

	export default {

		name: 'SyncTaskType',

		components: { DataManager },

		data() {
			return {
				SyncTaskType : null,
			}
		},

		props : {
			'syncTaskTypeId' : String
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

		computed: {
			syncTaskTypeSyncTaskTypeVersionsDataManagerResource() {
				return {
					name: 'syncTaskTypeVersion',
					create: {
						postUri: '/syncTaskTypeVersion',
					},
					edit: {
						putUriTemplate: '/syncTaskTypeVersion/<%- resourceRow.sync_task_type_id %>,<%- resourceRow.i18n_lang_id %>',
					},
					delete: {
						deleteUriTemplate: '/syncTaskTypeVersion/<%- resourceRow.sync_task_type_id %>,<%- resourceRow.i18n_lang_id %>',
					},
					createDefaultResourceRow: {}
				}
			},

			syncTaskTypeSyncTaskTypeVersionsDataManagerColumns() {
				return [
					{
						name : 'sync_task_type_id',
						class : 'col-md-1',
						orderable : true,
						order_by_field : 'sync_task_type_id',

						type : 'select2',
						select2 : {
							labelProp : 'id',
							valueProp : 'id',
							feed : {
								getUri : '/syncTaskType',
								params : {
									limit: 10,
									order_by: 'id,asc',
								}
							},
						},

						routerLink : {
							routeName : 'sync-task-type',
							paramsNames : {
								'syncTaskTypeId' : 'sync_task_type_id'
							}
						},

						create : {
							fillable: true,
							defaultValue: this.syncTaskType.id,
						},

						edit : {
							fillable: true,
						}
					},
					{
						name : 'i18n_lang_id',
						class : 'col-md-1',
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

						create : {
							fillable: true,
							defaultValue: '',
						},

						edit : {
							fillable: true,
						}
					},
					{
						name : 'description',
						displayProp: 'description',
						class : '',
						orderable : true,
						order_by_field: 'description',
						type : 'textarea',

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
				this.syncTaskType = null;

				var propsData = this.$options.propsData;
				this.syncTaskType = {
					id: propsData.syncTaskTypeId
				}

				this.$emit('routeTitleDataUpdate', this.syncTaskType);
			},
		}
	}
</script>
