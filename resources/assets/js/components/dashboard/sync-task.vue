<style scoped>
	.sync-task-id {
		font-size: 21px;
		margin-top: 5px;
		margin-bottom: 10px;
	}
</style>

<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div v-if="syncTask != null" class="col-md-3 no-right-padding">
				<div class="box box-primary">
					<div class="box-body">
						<h3 class="text-center sync-task-id" v-html="syncTask.id"></h3>

						<ul class="list-group list-group-unbordered">
							<li v-if="syncTask.sync_task_id != null" class="list-group-item">
								<b v-html="$t('sync_tasks.parent_sync_task_id')"></b>
								<span class="pull-right">
									<router-link
										:to="{ name: 'sync-task', params : { 'syncTaskId' : syncTask.sync_task_id }}"
										v-html="syncTask.sync_task_id">
									</router-link>
								</span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('sync_tasks.sync_task_type_id')"></b>
								<span class="pull-right">
									<router-link
										:to="{ name: 'sync-task-type', params : { 'syncTaskTypeId' : syncTask.sync_task_type_id }}"
										v-html="syncTask.sync_task_type_id"
									></router-link>
								</span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('sync_tasks.sync_task_status_id')"></b>
								<span class="pull-right">
									<router-link
										:to="{ name: 'sync-task-status', params : { 'syncTaskStatusId' : syncTask.sync_task_status_id }}"
										v-html="syncTask.sync_task_status_id"
									></router-link>
								</span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('sync_tasks.project')"></b>
								<span class="pull-right">
									<router-link
										:to="{ name: 'project', params : { 'projectId' : syncTask.project_id }}"
										v-html="syncTask.project.data.name"
									></router-link>
								</span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('sync_tasks.created_by_user')"></b>
								<span v-if="syncTask.created_by_user_id != null" class="pull-right">
									<router-link
										:to="{ name: 'user', params : { 'userId' : syncTask.created_by_user_id }}"
										v-html="syncTask.createdByUser.data.name"
									></router-link>
								</span>
								<span v-else class="pull-right">-</span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('common.created_at')"></b> <span class="pull-right" v-html="momentLocalDate(syncTask.created_at)"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('common.updated_at')"></b> <span class="pull-right" v-html="momentLocalDate(syncTask.updated_at)"></span>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li v-if="syncTask != null" class="active">
							<a href="#children-sync-task-tab-pane" data-toggle="tab">
								<i class="fa fa-tasks fa-fw"></i> <span v-html="$t('sync_tasks.children_sync_tasks')"></span>
							</a>
						</li>
						<li v-if="syncTask != null">
							<a href="#sync-task-sync-task-logs-tab-pane" data-toggle="tab">
								<i class="fa fa-file-text-o fa-fw"></i> <span v-html="$t('sync_tasks.sync_task_sync_task_logs')"></span>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="children-sync-task-tab-pane">
							<DataManager
								v-if="syncTask != null"
								:rights="{
									allowSee: true,
									allowCreate: false,
									allowEdit: false,
									allowDelete : false,
								}"
								i18nPath="sync_tasks.data_manager.sync_task_children_sync_tasks"
								:resource="syncTaskChildrenSyncTasksDataManagerResource"
								:defaultOrderBy="{column: 'created_at', direction: 'desc'}"
								:pagination="{limiting: true, defaultLimit: 20, limits: [5, 10, 20]}"
								:searching="true"
								:request="{include: 'createdByUser,project', extraParameters: {syncTaskId: syncTask.id}}"
								:store="{stateName: 'syncTaskChildrenSyncTasks', loadingStateName: 'syncTaskChildrenSyncTasksLoading', dispatchAction: 'getSyncTaskChildrenSyncTasks'}"
								:columns="syncTaskChildrenSyncTasksColumns"
								:checkboxes="{enabled: false}"
								buttonsColumnClass="col-md-1"
							></DataManager>
						</div>
						<div class="tab-pane" id="sync-task-sync-task-logs-tab-pane">
							<DataManager
								v-if="syncTask != null"
								:rights="{
									allowSee: false,
									allowCreate: false,
									allowEdit: false,
									allowDelete : false,
									allowMassDelete : false,
								}"
								i18nPath="sync_task_logs.data_manager.sync_tasks_logs"
								:resource="syncTaskSyncTaskLogsDataManagerResource"
								:defaultOrderBy="{column: 'created_at', direction: 'desc'}"
								:pagination="{limiting: true, defaultLimit: 10, limits: [5, 10, 20]}"
								:searching="true"
								:request="{extraParameters: {syncTaskId: syncTask.id}}"
								:store="{stateName: 'syncTaskSyncTaskLogs', loadingStateName: 'syncTaskSyncTaskLogsLoading', dispatchAction: 'getSyncTaskSyncTaskLogs'}"
								:columns="syncTaskSyncTaskLogsColumns"
								:checkboxes="{enabled: false}"
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
		name: 'SyncTask',

		components: { DataManager },

		data() {
			return {
				syncTask : null,
			}
		},

		props : {
			'syncTaskId' : String
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
			syncTaskChildrenSyncTasksDataManagerResource() {
				return {
					name: 'syncTask',
					routePath: 'sync-task',
					routeParamsMap: {
						'syncTaskId': 'id',
					},
				}
			},

			syncTaskChildrenSyncTasksColumns() {
				return [
					{
						name : 'id',
						class : '',
						orderable : true,
						order_by_field: 'id',
					},
					{
						name : 'project_id',
						displayProp: 'project.data.name',
						class : '',
						orderable : false,
						routerLink: {
							routeName: 'project',
							paramsNames: {
								'projectId': 'project_id'
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

			syncTaskSyncTaskLogsDataManagerResource() {
				return {
					name: 'syncTaskLog',
				}
			},

			syncTaskSyncTaskLogsColumns() {
				return [
					{
						name : 'id',
						class : '',
						orderable : true,
						order_by_field: 'id',
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
						name : 'entry',
						orderable : true,
						order_by_field : 'entry',
					},
					{
						name : 'public',
						class : 'col-md-1',
						orderable : true,
						order_by_field : 'public',
						transformValue : (value) => {
							return value ? this.$t('sync_task_logs.visibility.public') : this.$t('sync_task_logs.visibility.private');
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

		methods: {
			fetchData() {
				this.user = null;

				var propsData = this.$options.propsData;
				this.getSyncTask(propsData.syncTaskId);
			},

			getSyncTask(syncTaskId) {
				apiAxios
					.get('/syncTask/' + syncTaskId, { params : { include : 'createdByUser,project' } })
					.then(response => {
						this.syncTask = response.data.data;
						this.$emit('routeTitleDataUpdate', this.syncTask);
					}).catch(error => {
						this.$root.axiosError(error);
					});
			},
		}
	}
</script>
