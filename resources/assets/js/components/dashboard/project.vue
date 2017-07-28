<style scoped>
	.project-name, .project-data-stream-name {
		font-size: 21px;
		margin-top: 5px;
		margin-bottom: 10px;
	}
</style>

<style>
	tr td.selectable-td span {
		outline: none;
		text-decoration: none;
		color: #72afd2;
		cursor: pointer;
	}
	tr td.selectable-td span:hover {
		color: #23527c;
		text-decoration: none;
	}
	.selected-row {
		background-color: #ddd !important;
	}
</style>

<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div v-if="project != null" class="col-md-3 no-right-padding">
				<div class="box box-primary">
					<div class="box-body">
						<h3 class="text-center project-name" v-html="project.name"></h3>

						<ul class="list-group list-group-unbordered">
							<li v-if="(['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1)" class="list-group-item">
								<b v-html="$t('projects.project_id')"></b> <span class="pull-right" v-html="project.id"></span>
							</li>
							<li v-if="(['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1)" class="list-group-item">
								<b v-html="$t('projects.search_engine_name')"></b>
								<span class="pull-right">
									<router-link
										:to="{ name: 'search-engine', params : { 'searchEngineId' : project.search_engine_id }}"
										v-html="project.searchEngine.data.name">
									</router-link>
								</span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('projects.data_stream_name')"></b>
								<span v-if="project.data_stream_id != null" class="pull-right">
									<router-link
										:to="{ name: 'data-stream', params : { 'dataStreamId' : project.data_stream_id }}"
										v-html="project.dataStream.data.name">
									</router-link>
								</span>
								<span v-else class="pull-right">-</span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('projects.project_name')"></b> <span class="pull-right" v-html="project.name"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('projects.owner_name')"></b>
								<span v-if="(['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1) && (ownerUserId != '')"  class="pull-right">
									<router-link
										:to="{ name: 'user', params : { 'userId' : ownerUserId }}"
										v-html="ownerUserName"
									></router-link>
								</span>
								<span v-else class="pull-right" v-html="ownerUserName"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('common.created_at')"></b> <span class="pull-right" v-html="momentLocalDate(project.created_at)"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('common.updated_at')"></b> <span class="pull-right" v-html="momentLocalDate(project.updated_at)"></span>
							</li>
						</ul>

						<button
							v-if="(['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1)
								  || loggedUserIsProjectOwner"
							type="button"
							@click="projectShowEditModal"
							class="btn btn-default"
							v-html="$t('common.edit_btn')"></button>

						<button
							v-if="(['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1)
								  && (projectDataStream == null)"
							type="button"
							@click="projectDataStreamShowCreateModal"
							class="btn btn-default pull-right"
							v-html="$t('projects.create_project_data_stream_btn')"></button>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#project-user-has-projects-tab-pane" data-toggle="tab">
								<i class="fa fa-user fa-fw"></i> <span v-html="$t('users.users')"></span>
							</a>
						</li>
						<li>
							<a href="#project-sync-items-tab-pane" data-toggle="tab">
								<i class="fa fa-external-link fa-fw"></i> <span v-html="$t('sync_items.sync_items')"></span>
							</a>
						</li>
						<li>
							<a href="#project-sync-tasks-tab-pane" data-toggle="tab">
								<i class="fa fa-tasks fa-fw"></i> <span v-html="$t('sync_tasks.sync_tasks')"></span>
							</a>
						</li>
						<li>
							<a href="#project-search-use-cases-tab-pane" data-toggle="tab">
								<i class="fa fa-tasks fa-fw"></i> <span v-html="$t('search_use_cases.search_use_cases')"></span>
							</a>
						</li>

					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="project-user-has-projects-tab-pane">
							<DataManager
								:rights="{
									allowSee: (['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1),
									allowCreate: (['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1),
									allowEdit: false,
									allowDelete : (['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1) || this.loggedUserIsProjectOwner,
								}"
								i18nPath="users.data_manager.administrator_users"
								:resource="projectUsersDataManagerResource"
								:defaultOrderBy="{column: 'created_at', direction: 'asc'}"
								:pagination="{limiting: false, defaultLimit: 20}"
								:searching="false"
								:request="{include: 'user', extraParameters: {projectId: projectId}}"
								:store="{stateName: 'projectAdminUserHasProjects', loadingStateName: 'projectAdminUserHasProjectsLoading', dispatchAction: 'getProjectAdminUserHasProjects'}"
								:columns="projectUserHasProjectsColumns"
								:checkboxes="{enabled: false}"
								buttonsColumnClass="col-md-2"
							></DataManager>
						</div>
						<div class="tab-pane" id="project-sync-items-tab-pane">
							<DataManager
								:rights="{
									allowSee: false,
									allowCreate: false,
									allowEdit: false,
									allowDelete : false,
								}"
								i18nPath="sync_items.data_manager.project_sync_items"
								:resource="projectSyncItemsDataManagerResource"
								:defaultOrderBy="{column: 'created_at', direction: 'asc'}"
								:pagination="{limiting: true, defaultLimit: 20, limits: [10, 20, 30, 40, 50]}"
								:searching="true"
								:request="{extraParameters: {projectId: projectId}}"
								:store="{stateName: 'projectSyncItems', loadingStateName: 'projectSyncItemsLoading', dispatchAction: 'getProjectSyncItems'}"
								:columns="projectSyncItemsColumns"
								:checkboxes="{enabled: false}"
								buttonsColumnClass="col-md-2"
							></DataManager>
						</div>
						<div class="tab-pane" id="project-sync-tasks-tab-pane">
							<DataManager
								:rights="{
									allowSee: false,
									allowCreate: false,
									allowEdit: false,
									allowDelete : false,
									allowMassDelete: false,
								}"
								i18nPath="sync_tasks.data_manager.project_root_sync_tasks"
								:resource="projectRootSyncTasksDataManagerResource"
								:defaultOrderBy="{column: 'created_at', direction: 'desc'}"
								:pagination="{limiting: true, defaultLimit: 20, limits: [10, 20, 30, 40, 50]}"
								:searching="false"
								:request="{include: 'createdByUser', extraParameters: {projectId: projectId}}"
								:store="{stateName: 'projectRootSyncTasks', loadingStateName: 'projectRootSyncTasksLoading', dispatchAction: 'getProjectRootSyncTasks'}"
								:columns="projectRootSyncTasksColumns"
								:checkboxes="{enabled: false}"
								:rowClasses="projectRootSyncTasksDataManagerRowsClasses"
								:rowsButtons="projectRootSyncTasksRowsButtons"
								buttonsColumnClass="col-md-1"
							></DataManager>
							<DataManager
								v-if="selectedProjectSyncTask != null"
								:rights="{
									allowSee: false,
									allowCreate: false,
									allowEdit: false,
									allowDelete : false,
									allowMassDelete: false,
								}"
								i18nPath="sync_tasks.data_manager.project_children_sync_tasks"
								:resource="projectChildrenSyncTasksDataManagerResource"
								:defaultOrderBy="{column: 'created_at', direction: 'desc'}"
								:pagination="{limiting: true, defaultLimit: 20, limits: [10, 20, 30, 40, 50]}"
								:searching="false"
								:request="{include: 'createdByUser', extraParameters: {syncTaskId: selectedProjectSyncTask.id}}"
								:store="{stateName: 'projectChildrenSyncTasks', loadingStateName: 'projectChildrenSyncTasksLoading', dispatchAction: 'getProjectChildrenSyncTasks'}"
								:columns="projectChildrenSyncTasksColumns"
								:checkboxes="{enabled: false}"
								:rowsButtons="projectChildrenSyncTasksRowsButtons"
								buttonsColumnClass="col-md-1"
							></DataManager>
						</div>
						<div class="tab-pane" id="project-search-use-cases-tab-pane">
							<DataManager
								v-if="(project != null)"
								:rights="{
									allowSee: false,
									allowCreate: true,
									allowEdit: true,
									allowDelete : true,
									allowMassDelete: false,
								}"
								i18nPath="search_use_cases.data_manager.project_search_use_cases"
								:resource="projectSearchUseCasesDataManagerResource"
								:defaultOrderBy="{column: 'created_at', direction: 'asc'}"
								:pagination="{limiting: true, defaultLimit: 20, limits: [10, 20, 30, 40, 50]}"
								:searching="true"
								:request="{extraParameters: {projectId: projectId}}"
								:store="{stateName: 'projectSearchUseCases', loadingStateName: 'projectSearchUseCasesLoading', dispatchAction: 'getProjectSearchUseCases'}"
								:columns="projectSearchUseCasesColumns"
								:checkboxes="{enabled: false}"
								buttonsColumnClass="col-md-2"
							></DataManager>
						</div>
					</div>
				</div>
			</div>
		</div>
		<EditModal
			v-if="(project != null)
				  && ((['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1)
					  || loggedUserIsProjectOwner)"
			id="project-edit-modal"
			i18nPath="projects.data_manager.all_projects.modals.edit"
			:putUri="'/project/' + project.id"
			:fields="projectEditModalFields"
			:onSuccess="projectEditModalSuccess"
		></EditModal>
		<Modal
			v-if="viewModalProjectRootSyncTask != null"
			:title="projectRootSyncTasksViewLogsModalTitle"
			id="project-root-sync-task-view-logs-modal"
			size="large"
		>
			<DataManager
				:hideHeader="true"
				:rights="{
					allowSee: false,
					allowCreate: false,
					allowEdit: false,
					allowDelete : false,
					allowMassDelete : false,
				}"
				i18nPath="sync_task_logs.data_manager.sync_tasks_logs"
				:resource="projectSyncTasksViewLogsDataManagerResource"
				:defaultOrderBy="{column: 'created_at', direction: 'desc'}"
				:pagination="{limiting: true, defaultLimit: 10, limits: [5, 10, 20]}"
				:searching="true"
				:request="{extraParameters: {syncTaskId: viewModalProjectRootSyncTask.id}}"
				:store="{stateName: 'projectRootSyncTaskSyncTaskLogs', loadingStateName: 'projectRootSyncTaskSyncTaskLogsLoading', dispatchAction: 'getProjectRootSyncTaskSyncTaskLogs'}"
				:columns="projectRootSyncTaskSyncTaskLogsColumns"
				:checkboxes="{enabled: false}"
			></DataManager>
		</Modal>
		<Modal
			v-if="viewModalProjectChildrenSyncTask != null"
			:title="projectChildrenSyncTasksViewLogsModalTitle"
			id="project-children-sync-task-view-logs-modal"
			size="large"
		>
			<DataManager
				:hideHeader="true"
				:rights="{
					allowSee: false,
					allowCreate: false,
					allowEdit: false,
					allowDelete : false,
					allowMassDelete : false,
				}"
				i18nPath="sync_task_logs.data_manager.sync_tasks_logs"
				:resource="projectSyncTasksViewLogsDataManagerResource"
				:defaultOrderBy="{column: 'created_at', direction: 'desc'}"
				:pagination="{limiting: true, defaultLimit: 10, limits: [5, 10, 20]}"
				:searching="true"
				:request="{extraParameters: {syncTaskId: viewModalProjectChildrenSyncTask.id}}"
				:store="{stateName: 'projectChildrenSyncTaskSyncTaskLogs', loadingStateName: 'projectChildrenSyncTaskSyncTaskLogsLoading', dispatchAction: 'getProjectChildrenSyncTaskSyncTaskLogs'}"
				:columns="projectChildrenSyncTaskSyncTaskLogsColumns"
				:checkboxes="{enabled: false}"
			></DataManager>
		</Modal>
		<div class="row">
			<div v-if="projectDataStream != null" class="col-md-3 no-right-padding">
				<div class="box box-primary">
					<div class="box-body">
						<h3 class="text-center project-data-stream-name" v-html="projectDataStream.name"></h3>

						<ul class="list-group list-group-unbordered">
							<li v-if="(['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1)" class="list-group-item">
								<b v-html="$t('data_streams.id')"></b> <span class="pull-right" v-html="projectDataStream.id"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('data_streams.data_stream_decoder_name')"></b>
								<span class="pull-right">
									<router-link
										:to="{ name: 'data-stream-decoder', params : { 'dataStreamDecoderId' : projectDataStream.data_stream_decoder_id }}"
										v-html="projectDataStream.dataStreamDecoder.data.name">
									</router-link>
								</span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('projects.data_stream_name')"></b>
								<span v-if="(['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1)"  class="pull-right">
									<router-link
										:to="{ name: 'data-stream', params : { 'dataStreamId' : projectDataStream.id }}"
										v-html="projectDataStream.name"
									></router-link>
								</span>
								<span v-else class="pull-right" v-html="projectDataStream.name"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('data_streams.feed_url')"></b> <span class="pull-right" v-html="projectDataStream.feed_url"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('common.created_at')"></b> <span class="pull-right" v-html="momentLocalDate(projectDataStream.created_at)"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('common.updated_at')"></b> <span class="pull-right" v-html="momentLocalDate(projectDataStream.updated_at)"></span>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9" v-if="projectDataStream != null">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#project-data-stream-i18n-langs-tab-pane" data-toggle="tab">
								<i class="fa fa-language fa-fw"></i> <span v-html="$t('data_streams.i18n_langs')"></span>
							</a>
						</li>
						<li>
							<a href="#project-data-stream-data-stream-fields-tab-pane" data-toggle="tab">
								<i class="fa fa-list fa-fw"></i> <span v-html="$t('data_streams.data_stream_fields')"></span>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="project-data-stream-i18n-langs-tab-pane">
							<DataManager
								:rights="{
									allowSee: false,
									allowCreate: true,
									allowEdit: false,
									allowDelete : true,
									allowMassDelete : true,
								}"
								i18nPath="data_stream_has_i18n_langs.data_manager.data_stream_has_i18n_langs"
								:resource="projectDataStreamDataStreamHasI18nLangsDataManagerResource"
								:defaultOrderBy="{column: 'i18n_lang_id', direction: 'asc'}"
								:pagination="{limiting: true, defaultLimit: 10, limits: [5, 10, 20]}"
								:searching="false"
								:request="{include: 'dataStream,i18nLang', extraParameters: {dataStreamId: projectDataStream.id}}"
								:store="{
									stateName: 'dataStreamDataStreamHasI18nLangs',
									loadingStateName: 'dataStreamDataStreamHasI18nLangsLoading',
									dispatchAction: 'getDataStreamDataStreamHasI18nLangs'
								}"
								:columns="projectDataStreamDataStreamHasI18nLangsColumns"
							></DataManager>
						</div>
						<div class="tab-pane" id="project-data-stream-data-stream-fields-tab-pane">
							<DataManager
								:rights="{
									allowSee: false,
									allowCreate: true,
									allowEdit: true,
									allowDelete : true,
									allowMassDelete : true,
								}"
								i18nPath="data_stream_fields.data_manager.data_stream_fields"
								:resource="projectDataStreamDataStreamFieldsDataManagerResource"
								:defaultOrderBy="{column: 'name', direction: 'asc'}"
								:pagination="{limiting: true, defaultLimit: 10, limits: [5, 10, 20]}"
								:searching="true"
								:request="{include: 'dataStream', extraParameters: {dataStreamId: projectDataStream.id}}"
								:store="{
									stateName: 'dataStreamDataStreamFields',
									loadingStateName: 'dataStreamDataStreamFieldsLoading',
									dispatchAction: 'getDataStreamDataStreamFields'
								}"
								:columns="projectDataStreamDataStreamFieldsColumns"
							></DataManager>
						</div>
					</div>
				</div>
			</div>
		</div>
		<CreateModal
			v-if="(project != null) && (projectDataStream == null)"
			id="project-data-stream-create-modal"
			i18nPath="data_streams.data_manager.data_streams.modals.create"
			:postUri="'/project/' + project.id + '/dataStream'"
			:fields="projectDataStreamCreateModalFields"
			:onSuccess="projectDataStreamCreateModalSuccess"
		></CreateModal>
	</section>
</template>

<script>
	import DataManager from '../includes/data-manager'
	import EditModal from '../includes/edit-modal'
	import Modal from '../includes/modal'
	import CreateModal from '../includes/create-modal'

	export default {
		name: 'Project',

		components: { DataManager, EditModal, Modal, CreateModal },

		data() {
			return {
				project : null,
				projectEditModalProject : Object,
				projectEditModalPutUri : String,

				viewModalProjectRootSyncTask : null,
				selectedProjectSyncTask : null,

				viewModalProjectChildrenSyncTask : null,

				projectDataStream : null,
			}
		},

		props : {
			'projectId' : String
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
			loggedUserIsProjectOwner() {
				if (!_.has(this.$store.getters.me, 'id')) {
					return false;
				}

				if (!_.has(this.$store.state.projectOwnerUserHasProjects, 'data[0].user_id')) {
					return false;
				}

				return (this.$store.state.projectOwnerUserHasProjects.data[0].user_id == this.$store.getters.me.id);
			},
			ownerUserId() {
				if (_.has(this.$store.state.projectOwnerUserHasProjects, 'data[0].user_id')) {
					return this.$store.state.projectOwnerUserHasProjects.data[0].user_id;
				}
				return '';
			},
			ownerUserName() {
				if (_.has(this.$store.state.projectOwnerUserHasProjects, 'data[0].user.data.name')) {
					return this.$store.state.projectOwnerUserHasProjects.data[0].user.data.name;
				}
			},
			projectEditModalTitle() {
				this.$i18n.t('projects.edit_project', {
					'name' : this.projectEditModalProject.name
				});
			},
			projectEditModalFields() {
				var fields = [];

				fields.push({
					name : 'name',
					value : this.projectEditModalProject.name,
					type : 'input'
				});

				if (['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1) {
					fields.push({
						name : 'search_engine_id',
						value : this.projectEditModalProject.search_engine_id,
						type : 'select2',
						select2 : {
							labelProp : 'name',
							valueProp : 'id',
							feed : {
								getUri : '/searchEngine',
								params : {
									limit: 10,
									order_by: 'name,asc',
								}
							},
						},
					});
				}

				return fields;
			},

			projectUsersDataManagerResource() {
				return {
					name: 'userHasProject',
					routePath: 'user',
					routeParamsMap: {
						'userId': 'user_id',
					},
					create: {
						postUri: '/userHasProject',
					},
					edit: {
						putUriTemplate: '/userHasProject/<%- resourceRow.user_id %>,<%- resourceRow.project_id %>',
					},
					delete: {
						deleteUriTemplate: '/userHasProject/<%- resourceRow.user_id %>,<%- resourceRow.project_id %>',
					},
					createDefaultResourceRow: {}
				}
			},

			/**
			 * Data Manager columns of Developer & Support users for owner and administrators list
			 * @returns {*[]}
			 */
			projectUserHasProjectsColumns() {
				var nameField = {
					name : 'user_name',
					displayProp : 'user.data.name',
					class : 'col-md-3',
					orderable : false,
					type: 'input',
					create : {
						fillable: false,
					},
					edit: {
						fillable: false,
					},
				};

				if (['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1) {
					nameField.routerLink = {
						routeName: 'user',
						paramsNames: {
							'userId': 'user_id'
						}
					};
				}

				return [
					nameField,
					{
						name : 'user_id',
						type : 'select2',
						select2 : {
							labelProp : 'name',
							valueProp : 'id',
							feed : {
								getUri : '/user',
								params : {
									limit: 10,
									order_by: 'name,asc',
								}
							},
						},
						list: {
							visible: false,
						},
						create : {
							fillable: true,
							defaultValue: '',
						},
						edit: {
							fillable: false,
						},
					},
					{
						name : 'user_email',
						displayProp : 'user.data.email',
						class : 'col-md-3',
						orderable : false,
						type: 'input',
						create : {
							fillable: false,
						},
						edit: {
							fillable: false,
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

						create: {
							fillable: false,
						},

						edit: {
							fillable: false,
						},
					},
					{
						name: 'project_id',
						type: 'hidden',

						list: {
							visible: false,
						},
						create: {
							defaultValue: this.projectId
						}
					},
					{
						name: 'user_role_id',
						type: 'hidden',
							list: {
							visible: false,
						},
						create: {
							defaultValue: 'Administrator',
						}
					},
				];
			},

			projectSyncItemsDataManagerResource() {
				return {
					name: 'syncItem',
				}
			},

			projectSyncItemsColumns() {
				return [
					{
						name : 'item_id',
						class : '',
						orderable : true,
						order_by_field: 'item_id',
					},
					{
						name : 'item_signature',
						class : '',
						orderable : true,
						order_by_field: 'item_signature'
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

			projectRootSyncTasksDataManagerResource() {
				return {
					name: 'syncTask',
				}
			},

			projectRootSyncTasksColumns() {
				return [
					{
						name : 'id',
						class : 'selectable-td',
						orderable : true,
						order_by_field: 'id',
						onClick: (dataRow, column) => {
							if ((this.selectedProjectSyncTask != null) && (this.selectedProjectSyncTask.id == dataRow.id)) {
								this.selectedProjectSyncTask = null;
							} else {
								this.selectedProjectSyncTask = dataRow;
							}
						},
					},
					/*
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
					},*/
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
					},
					/*
					{
						name : 'updated_at',
						class : 'col-md-2',
						orderable : true,
						order_by_field : 'updated_at',
						transformValue : (value) => {
							return this.momentLocalDate(value);
						},
					},
					*/
				];
			},

			projectChildrenSyncTasksDataManagerResource() {
				return {
					name: 'syncTask',
				}
			},

			projectChildrenSyncTasksColumns() {
				return [
					{
						name : 'id',
						class : '',
						orderable : true,
						order_by_field: 'id',
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
					/*
					{
						name : 'updated_at',
						class : 'col-md-2',
						orderable : true,
						order_by_field : 'updated_at',
						transformValue : (value) => {
							return this.momentLocalDate(value);
						},
					},
					*/
				];
			},

			projectRootSyncTasksRowsButtons() {
				var buttons = [];

				buttons.push(
					{
						title : this.$t('sync_tasks.view_logs_btn'),
						class : 'btn btn-default',
						onClick : (rowResource) => {
							this.viewModalProjectRootSyncTask = rowResource;
							$(document).ready(() => {
								$('#project-root-sync-task-view-logs-modal').modal('show');
							})
						}
					}
				);

				return buttons;
			},

			projectChildrenSyncTasksRowsButtons() {
				var buttons = [];

				buttons.push(
					{
						title : this.$t('sync_tasks.view_logs_btn'),
						class : 'btn btn-default',
						onClick : (rowResource) => {
							this.viewModalProjectChildrenSyncTask = rowResource;
							$(document).ready(() => {
								$('#project-children-sync-task-view-logs-modal').modal('show');
							})
						}
					}
				);

				return buttons;
			},

			projectRootSyncTasksViewLogsModalTitle() {
				var compiledTitleTemplate = _.template(this.$t('sync_tasks.view_logs_modal.title_template'));
				return compiledTitleTemplate({'resourceRow' : this.viewModalProjectRootSyncTask});
			},

			projectChildrenSyncTasksViewLogsModalTitle() {
				var compiledTitleTemplate = _.template(this.$t('sync_tasks.view_logs_modal.title_template'));
				return compiledTitleTemplate({'resourceRow' : this.viewModalProjectChildrenSyncTask});
			},

			projectSyncTasksViewLogsDataManagerResource() {
				return {
					name: 'syncTaskLog',
				}
			},

			projectRootSyncTaskSyncTaskLogsColumns() {
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

			projectChildrenSyncTaskSyncTaskLogsColumns() {
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

			projectSearchUseCasesDataManagerResource() {
				return {
					name: 'searchUseCase',
					routePath: 'searchUseCase',
					routeParamsMap: {
						'searchUseCaseId': 'id',
					},
					create: {
						postUri: '/searchUseCase',
					},
					edit: {
						putUriTemplate: '/searchUseCase/<%- resourceRow.id %>',
					},
					delete: {
						deleteUriTemplate: '/searchUseCase/<%- resourceRow.id %>',
					},
					createDefaultResourceRow: {}
				}
			},

			projectSearchUseCasesColumns() {
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
						name: 'project_id',
						type: 'hidden',

						list: {
							visible: false,
						},
						create: {
							defaultValue: this.projectId
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

			projectDataStreamCreateModalFields() {
				return [
					{
						name : 'data_stream_decoder_id',
						value : '',
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

					},
					{
						name : 'name',
						value : this.project.name + ' Data Stream',
						type : 'input'
					},
					{
						name : 'feed_url',
						value : '',
						type : 'input'
					},
				];
			},

			projectDataStreamDataStreamFieldsDataManagerResource() {
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

			projectDataStreamDataStreamFieldsColumns() {
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
							defaultValue: this.projectDataStream.id,
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

			projectDataStreamDataStreamHasI18nLangsDataManagerResource() {
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

			projectDataStreamDataStreamHasI18nLangsColumns() {
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
							defaultValue: this.projectDataStream.id,
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
				var propsData = this.$options.propsData;
				this.getProject(propsData.projectId);
				this.getProjectOwner(propsData.projectId);
			},

			getProject(projectId) {
				apiAxios
					.get('/project/' + projectId, { params : { include : 'searchEngine,dataStream' } })
					.then(response => {
						this.project = response.data.data;

						// Get the data stream only if exists
						if (this.project.data_stream_id != null) {
							this.getProjectDataStream(this.project.id);
						}

						this.$emit('routeTitleDataUpdate', this.project);
					}).catch(error => {
						this.$root.axiosError(error);
					});
			},

			getProjectOwner(projectId) {
				this.$store.dispatch('getProjectOwnerUserHasProjects', { projectId: projectId, include: 'user' });
			},

			getProjectDataStream(projectId) {
				apiAxios
					.get('/project/' + projectId + '/dataStream', { params : { include : 'dataStreamDecoder' } })
					.then(response => {
						this.projectDataStream = response.data.data;
					}).catch(error => {
						this.$root.axiosError(error);
					});
			},

			projectEditModalSuccess() {
				// Refresh project
				this.fetchData();
			},
			projectShowEditModal() {
				this.projectEditModalProject = this.project;
				this.projectEditModalPutUri = '/project/' + this.project.id;
				$('#project-edit-modal').modal('show');
			},

			projectRootSyncTasksDataManagerRowsClasses(dataRow) {
				if ((this.selectedProjectSyncTask != null) && (this.selectedProjectSyncTask.id == dataRow.id)) {
					return ['selected-row'];
				} else {
					return[];
				}
			},

			projectDataStreamShowCreateModal() {
				$('#project-data-stream-create-modal').modal('show');
			},

			projectDataStreamCreateModalSuccess() {
				this.fetchData();
			}
		}
	}
</script>
