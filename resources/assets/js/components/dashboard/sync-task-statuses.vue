<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<DataManager
					:rights="{allowCreate: false, allowEdit: false, allowDelete: false, allowMassDelete: false}"
					i18nPath="sync_task_statuses.data_manager.sync_task_statuses"
					:resource="dataManagerResource"
					:defaultOrderBy="{column: 'id', direction: 'asc'}"
					:pagination="{limiting: false, defaultLimit: 20}"
					:searching="false"
					:store="{stateName: 'syncTaskStatuses', loadingStateName: 'syncTaskStatusesLoading', dispatchAction: 'getSyncTaskStatuses'}"
					:columns="dataManagerColumns"
					:checkboxes="{enabled: false}"
				></DataManager>
			</div>
		</div>
	</section>
</template>

<script>
	import DataManager from '../includes/data-manager'

	export default {
		name: 'SyncTaskStatuses',

		components: { DataManager },

		computed: {
			dataManagerResource() {
				return {
					name: 'syncTaskStatuses',
					routePath: 'sync-task-status',
					routeParamsMap: {
						'syncTaskStatusId': 'id',
					},
				}
			},

			dataManagerColumns() {
				return [
					{
						name : 'id',
						class : 'id-column',
						orderable : true,
						order_by_field : 'id',
						routerLink : {
							routeName : 'sync-task-status',
							paramsNames : {
								'syncTaskStatusId' : 'id'
							}
						}
					},
					{
						name : 'sync_tasks_count',
						class : 'col-md-2',
						orderable : true,
						order_by_field : 'sync_tasks_count',
					},
					{
						name : 'sync_task_logs_count',
						class : 'col-md-2',
						orderable : true,
						order_by_field : 'sync_task_logs_count',
					},
					{
						name : 'sync_task_status_versions_count',
						class : 'col-md-2',
						orderable : true,
						order_by_field : 'sync_task_status_versions_count',
					},
				];
			},
		},
	}
</script>
