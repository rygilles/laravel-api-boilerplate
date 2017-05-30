<style>
	.id-column {
		font-family: monospace;
		font-weight: bold;
	}

	.no-right-padding {
		padding-right: 0 !important;
	}

	.project-name {
		font-size: 21px;
		margin-top: 5px;
		margin-bottom: 10px;
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
							<li class="list-group-item">
								<b v-html="$t('projects.project_id')"></b> <span class="pull-right" v-html="project.id"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('projects.search_engine_name')"></b> <span class="pull-right" v-html="project.searchEngine.data.name"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('projects.project_name')"></b> <span class="pull-right" v-html="project.name"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('common.created_at')"></b> <span class="pull-right" v-html="momentLocalDate(project.created_at)"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('common.updated_at')"></b> <span class="pull-right" v-html="momentLocalDate(project.updated_at)"></span>
							</li>
						</ul>

						<button type="button"
								@click="projectShowEditModal"
								class="btn btn-default"
								v-html="$t('common.edit_btn')"></button>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<DataTable
					ref="projectUserHasProjectsDatatable"
					:mainTitle="projectUserHasProjectsMainTitle"
					defaultOrderByColumn="user_role_id"
					defaultOrderByDirection="desc"
					:defaultPaginationLimit="20"
					:paginationLimiting="false"
					:searching="false"
					dataStoreStateName="projectUserHasProjects"
					dataLoadingStoreStateName="projectUserHasProjectsLoading"
					dataDispatchAction="getProjectUserHasProjects"
					requestInclude="user,project"
					:requestExtraParameters="{'projectId' : projectId}"
					:columns="projectUserHasProjectsColumns"
					:rowsButtons="projectUserHasProjectsRowsButtons"
					buttonsColumnClass="col-md-2"
					:checkboxes="checkboxes"
					:emptyMessage="projectUserHasProjectsEmptyMessage"
				>
					<span slot="top-actions">
						<a class="action-link pull-right" @click="userHasProjectShowCreateModal">
							{{ $t('user_has_projects.create_new_user_has_project') }}
						</a>
					</span>
				</DataTable>
			</div>
		</div>
		<EditModal
			v-if="project != null"
			id="project-edit-modal"
			:title="$t('projects.edit_project', {'name' : project.name})"
			:putUri="'/project/' + project.id"
			:fields="projectEditModalFields"
			:onSuccess="projectEditModalSuccess"
		></EditModal>
		<CreateModal
			id="user-has-projects-create-modal"
			:title="userHasProjectCreateModalTitle"
			postUri="/userHasProject"
			:fields="userHasProjectCreateModalFields"
			:onSuccess="userHasProjectCreateModalSuccess"
		></CreateModal>
		<EditModal
			id="user-has-projects-edit-modal"
			:title="userHasProjectEditModalTitle"
			:putUri="userHasProjectEditModalPutUri"
			:fields="userHasProjectEditModalFields"
			:onSuccess="userHasProjectEditModalSuccess"
		></EditModal>
		<DeleteModal
			id="user-has-projects-delete-modal"
			:title="userHasProjectDeleteModalTitle"
			:deleteUri="userHasProjectDeleteModalDeleteUri"
			:onSuccess="userHasProjectDeleteModalSuccess"
			:message="userHasProjectDeleteModalMessage"
		></DeleteModal>
		<MassDeleteModal
			id="user-has-projects-mass-delete-modal"
			:title="userHasProjectMassDeleteModalTitle"
			:rows="userHasProjectMassDeleteRows"
			:deleteUriTemplate="userHasProjectMassDeleteModalDeleteUriTemplate"
			:onSuccess="userHasProjectMassDeleteModalSuccess"
			:messageTemplate="userHasProjectMassDeleteModalMessageTemplate"
		></MassDeleteModal>
	</section>
</template>

<script>
	import DataTable from '../includes/datatable'
	import CreateModal from '../includes/create-modal'
	import EditModal from '../includes/edit-modal'
	import DeleteModal from '../includes/delete-modal'
	import MassDeleteModal from '../includes/mass-delete-modal'

	export default {
		name: 'Project',

		components: { DataTable, CreateModal, EditModal , DeleteModal, MassDeleteModal },

		data() {
			return {
				project : null,
				projectEditModalProject : Object,
				projectEditModalPutUri : String,
				createModalDefaultUserHasProject : Object,
				editModalUserHasProject : {
					user: {
						data: {
							name: '',
						}
					},
					project: {
						data: {
							name: '',
						}
					}
				},
				userHasProjectEditModalPutUri : String,
				userHasProjectDeleteModalDeleteUri : String,
				deleteModalUserHasProject : {
					user: {
						data: {
							name: '',
						}
					},
					project: {
						data: {
							name: '',
						}
					}
				},
				userHasProjectMassDeleteRows : []
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
			projectEditModalTitle() {
				this.$i18n.t('projects.edit_project', {
					'name' : this.projectEditModalProject.name
				});
			},
			projectEditModalFields() {
				return [
					{
						name : 'name',
						title : this.$i18n.t('projects.project_name'),
						help : this.$i18n.t('projects.project_name_help'),
						value : this.projectEditModalProject.name,
						type : 'input'
					},
					{
						name : 'search_engine_id',
						title : this.$i18n.t('projects.search_engine_name'),
						help : this.$i18n.t('projects.search_engine_name_help'),
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
					},
				];
			},

			projectUserHasProjectsDataStoreState() {
				return this.$store.state.userHasProjects;
			},
			projectUserHasProjectsMainTitle() {
				return this.$i18n.t('user_has_projects.user_has_projects');
			},
			userHasProjectCreateModalTitle() {
				return this.$i18n.t('user_has_projects.create_new_user_has_project');
			},
			userHasProjectEditModalTitle() {
				return this.$i18n.t('user_has_projects.edit_user_has_project', {
					'user_name' : this.editModalUserHasProject.user.data.name,
					'project_name' : this.editModalUserHasProject.project.data.name
				});
			},
			userHasProjectDeleteModalTitle() {
				return this.$i18n.t('user_has_projects.delete_user_has_project');
			},
			userHasProjectMassDeleteModalTitle() {
				return this.$i18n.t('user_has_projects.mass_delete_user_has_project');
			},
			projectUserHasProjectsColumns() {
				return [
					{
						name : 'user.data.name',
						class : 'col-md-4',
						title : this.$i18n.t('users.user_name'),
						orderable : false,
					},
					{
						name : 'user_role_id',
						class : 'col-md-2',
						title : this.$i18n.t('user_has_projects.user_role_id'),
						orderable : true,
						order_by_field : 'user_role_id',
						transformValue : (value) => {
							return this.$i18n.t('user_has_projects.user_role.' + value);
						}
					},
					{
						name : 'created_at',
						class : 'col-md-2',
						title : this.$i18n.t('common.created_at_f'),
						orderable : true,
						order_by_field : 'created_at',
						transformValue : (value) => {
							return this.momentLocalDate(value);
						}
					},
					{
						name : 'updated_at',
						class : 'col-md-2',
						title : this.$i18n.t('common.updated_at_f'),
						orderable : true,
						order_by_field : 'updated_at',
						transformValue : (value) => {
							return this.momentLocalDate(value);
						}
					}
				];
			},
			projectUserHasProjectsRowsButtons() {
				return [
					{
						title : this.$i18n.t('users.see_user_btn'),
						class : 'btn btn-default',
						onClick : (userHasProject) => {
							this.$router.push({
								name: 'user',
								params: {
									'userId': userHasProject.user_id
								}
							});
						}
					},
					{
						title : this.$i18n.t('common.edit_btn'),
						class : 'btn btn-default',
						onClick : (userHasProject) => {
							this.editModalUserHasProject = userHasProject;
							this.userHasProjectEditModalPutUri = '/userHasProject/' + userHasProject.user_id + ',' + userHasProject.project_id;
							this.userHasProjectShowEditModal();
						}
					},
					{
						title : this.$i18n.t('common.delete_btn'),
						class : 'btn btn-danger',
						onClick : (userHasProject) => {
							this.deleteModalUserHasProject = userHasProject;
							this.userHasProjectDeleteModalDeleteUri = '/userHasProject/' + userHasProject.user_id + ',' + userHasProject.project_id;
							this.userHasProjectShowDeleteModal();
						}
					}
				]
			},
			userHasProjectCreateModalFields() {
				var fields = [];

				fields.push({
					name : 'user_id',
					title : this.$i18n.t('user_has_projects.user_name'),
					help : this.$i18n.t('user_has_projects.user_name_help'),
					value : this.createModalDefaultUserHasProject.user_id,
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
				});

				fields.push({
					name : 'project_id',
					title : this.$i18n.t('user_has_projects.project_name'),
					help : this.$i18n.t('user_has_projects.project_name_help'),
					value : this.createModalDefaultUserHasProject.project_id,
					type : 'select2',
					select2 : {
						labelProp : 'name',
						valueProp : 'id',
						feed : {
							getUri : '/project',
							params : {
								limit: 10,
								order_by: 'name,asc',
							}
						},
					},
				});

				fields.push({
					name : 'user_role_id',
					title : this.$i18n.t('user_has_projects.user_role_id'),
					help : this.$i18n.t('user_has_projects.user_role_id_help'),
					value : this.createModalDefaultUserHasProject.user_role_id,
					type : 'select2',
					select2 : {
						labelProp : 'label',
						valueProp : 'id',
						options : [
							{
								id : 'Owner',
								text : this.$i18n.t('user_has_projects.user_role.Owner'),
							},
							{
								id : 'Administrator',
								text : this.$i18n.t('user_has_projects.user_role.Administrator'),
							}
						]
					},
				});

				return fields;
			},
			userHasProjectEditModalFields() {
				var fields = [];

				fields.push({
					name : 'user_id',
					title : this.$i18n.t('user_has_projects.user_name'),
					help : this.$i18n.t('user_has_projects.user_name_help'),
					value : this.editModalUserHasProject.user_id,
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
				});

				fields.push({
					name : 'project_id',
					title : this.$i18n.t('user_has_projects.project_name'),
					help : this.$i18n.t('user_has_projects.project_name_help'),
					value : this.editModalUserHasProject.project_id,
					type : 'select2',
					select2 : {
						labelProp : 'name',
						valueProp : 'id',
						feed : {
							getUri : '/project',
							params : {
								limit: 10,
								order_by: 'name,asc',
							}
						},
					},
				});

				fields.push({
					name : 'user_role_id',
					title : this.$i18n.t('user_has_projects.user_role_id'),
					help : this.$i18n.t('user_has_projects.user_role_id_help'),
					value : this.editModalUserHasProject.user_role_id,
					type : 'select2',
					select2 : {
						labelProp : 'label',
						valueProp : 'id',
						options : [
							{
								id : 'Owner',
								text : this.$i18n.t('user_has_projects.user_role.Owner'),
							},
							{
								id : 'Administrator',
								text : this.$i18n.t('user_has_projects.user_role.Administrator'),
							}
						]
					},
				});

				return fields;
			},
			userHasProjectDeleteModalMessage() {
				return this.$i18n.t('user_has_projects.delete_user_has_project_message', {
					'user_name' : this.deleteModalUserHasProject.user.data.name,
					'project_name' : this.deleteModalUserHasProject.project.data.name
				});
			},
			userHasProjectMassDeleteModalDeleteUriTemplate() {
				return '/userHasProject/<%- row.user_id %>,<%- row.project_id %>';
			},
			userHasProjectMassDeleteModalMessageTemplate() {
				return this.$i18n.t('user_has_projects.mass_delete_user_has_project_message_template');
			},
			checkboxes() {
				return {
					'enabled' : true,
					'massButtons' : [
						{
							title : this.$i18n.t('common.unselect_all_btn'),
							class : 'btn btn-default',
							onClick : function(rows) {
								var l = rows.length;
								for (var i  = 0 ; i < l ; i++) {
									rows.shift();
								}
							}
						},
						{
							title : this.$i18n.t('common.delete_btn'),
							class : 'btn btn-danger',
							onClick : (rows) => {
								this.userHasProjectMassDeleteRows = rows;
								this.userHasProjectShowMassDeleteModal();
							}
						}
					]
				}
			},
			projectUserHasProjectsEmptyMessage() {
				return this.$i18n.t('user_has_projects.no_relation_yet');
			},
		},
		methods: {
			fetchData() {
				this.user = null;

				var propsData = this.$options.propsData;
				this.getProject(propsData.projectId);
			},

			getProject(projectId) {
				apiAxios
					.get('/project/' + projectId, { params : { include : 'searchEngine' } })
					.then(response => {
						this.project = response.data.data;
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

			userHasProjectShowCreateModal() {
				this.createModalDefaultUserHasProject = {
					user_id : '',
					project_id : this.projectId,
					user_role_id : '',
				};

				$('#user-has-projects-create-modal').modal('show');
			},
			userHasProjectShowEditModal() {
				$('#user-has-projects-edit-modal').modal('show');
			},
			userHasProjectShowDeleteModal() {
				$('#user-has-projects-delete-modal').modal('show');
			},
			userHasProjectShowMassDeleteModal() {
				$('#user-has-projects-mass-delete-modal').modal('show');
			},
			userHasProjectCreateModalSuccess() {
				// Refresh datatables
				this.$refs.userUserHasProjectsDatatable.fetchData();
			},
			userHasProjectEditModalSuccess() {
				// Refresh datatables
				this.$refs.userUserHasProjectsDatatable.fetchData();
			},
			userHasProjectDeleteModalSuccess() {
				// Refresh datatables
				this.$refs.userUserHasProjectsDatatable.fetchData();
			},
			userHasProjectMassDeleteModalSuccess() {
				// Refresh datatables
				this.$refs.userUserHasProjectsDatatable.fetchData();
			}
		}
	}
</script>
