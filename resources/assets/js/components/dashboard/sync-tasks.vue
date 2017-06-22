<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<DataManager
					:rights="{
						allowSee: true,
						allowCreate: false,
						allowEdit: false,
						allowDelete: false,
						allowMassDelete: false,
					}"
					i18nPath="sync_tasks.data_manager.root_sync_tasks"
					:resource="rootSyncTasksDataManagerResource"
					:defaultOrderBy="{column: 'created_at', direction: 'asc'}"
					:pagination="{limiting: true, defaultLimit: 20, limits: [5, 10, 20]}"
					:searching="true"
					:request="{include: 'createdByUser'}"
					:store="{stateName: 'rootSyncTasks', loadingStateName: 'rootSyncTasksLoading', dispatchAction: 'getRootSyncTasks'}"
					:columns="rootSyncTasksDataManagerColumns"
					:checkboxes="{enabled: false}"
				></DataManager>
			</div>
		</div>
	</section>
</template>

<script>
	import DataManager from '../includes/data-manager'

	export default {
		name: 'SyncTasks',

		components: { DataManager },

		computed: {
			rootSyncTasksDataManagerResource() {
				return {
					name: 'syncTask',
					routePath: 'sync-task',
					routeParamsMap: {
						'syncTaskId': 'id',
					},
				}
			},
			rootSyncTasksDataManagerColumns() {
				return [
					{
						name : 'id',
						class : '',
						orderable : true,
						order_by_field: 'id',
						routerLink: {
							routeName: 'sync-task',
							paramsNames: {
								'syncTaskId': 'id'
							}
						}
					},
					{
						name : 'sync_task_type_id',
						class : '',
						orderable : true,
						order_by_field: 'sync_task_type_id',
						routerLink: {
							routeName: 'sync-task-type',
							paramsNames: {
								'syncTaskTypeId': 'sync_task_type_id'
							}
						}
					},
					{
						name : 'sync_task_status_id',
						class : '',
						orderable : true,
						order_by_field: 'sync_task_status_id',
						routerLink: {
							routeName: 'sync-task-status',
							paramsNames: {
								'syncTaskStatusId': 'sync_task_status_id'
							}
						}
					},
					{
						name : 'created_by_user_id',
						displayProp : 'createdByUser.data.name',
						class : '',
						orderable : false,
						routerLink: {
							routeName: 'user',
							paramsNames: {
								'userId': 'created_by_user_id'
							}
						},
					},
					{
						name : 'created_at',
						class : 'col-md-2',
						orderable : true,
						order_by_field : 'created_at',
						transformValue : (value) => {
							return this.momentLocalDate(value);
						},
					},
					{
						name : 'updated_at',
						class : 'col-md-2',
						orderable : true,
						order_by_field : 'updated_at',
						transformValue : (value) => {
							return this.momentLocalDate(value);
						},
					},
				];
			},
		},
	}
</script>
