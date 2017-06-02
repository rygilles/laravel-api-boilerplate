<style>
	.id-column {
		font-family: monospace;
		font-weight: bold;
	}

	.no-right-padding {
		padding-right: 0 !important;
	}
</style>

<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div v-if="user != null" class="col-md-3 no-right-padding">
				<div class="box box-primary">
					<div class="box-body box-profile">
						<v-gravatar :email="user.email" default-img="mm" :size="128" class="profile-user-img img-responsive img-circle" alt="User profile picture" />

						<h3 class="profile-username text-center" v-html="user.name"></h3>

						<p class="text-muted text-center" v-html="user.user_group_id"></p>

						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<b v-html="$t('users.user_id')"></b> <span class="pull-right" v-html="user.id"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('users.user_group_id')"></b> <span class="pull-right" v-html="user.user_group_id"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('users.user_name')"></b> <span class="pull-right" v-html="user.name"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('users.user_email')"></b> <span class="pull-right" v-html="user.email"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('users.user_password')"></b> <span class="pull-right">-</span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('common.created_at')"></b> <span class="pull-right" v-html="momentLocalDate(user.created_at)"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('common.updated_at')"></b> <span class="pull-right" v-html="momentLocalDate(user.updated_at)"></span>
							</li>
						</ul>

						<button type="button"
								@click="userShowEditModal"
								class="btn btn-default"
								v-html="$t('common.edit_btn')"></button>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#user-user-has-projects-tab-pane" data-toggle="tab">
								<i class="fa fa-sticky-note-o fa-fw"></i> <span v-html="$t('projects.projects')"></span>
							</a>
						</li>
						<li>
							<a href="#user-notifications-tab-pane" data-toggle="tab">
								<i class="fa fa-bell-o fa-fw"></i> <span v-html="'Notifications (TODO)'"></span>
							</a>
						</li>
						<li>
							<a href="#user-api-configuration-tab-pane" data-toggle="tab">
								<i class="fa fa-cubes fa-fw"></i> <span v-html="'Api (TODO)'"></span>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="user-user-has-projects-tab-pane">
							<DataTable
								ref="userUserHasProjectsDatatable"
								:mainTitle="$t('user_has_projects.user_has_projects')"
								defaultOrderByColumn="user_role_id"
								defaultOrderByDirection="desc"
								:defaultPaginationLimit="20"
								:paginationLimiting="false"
								:searching="false"
								dataStoreStateName="userUserHasProjects"
								dataLoadingStoreStateName="userUserHasProjectsLoading"
								dataDispatchAction="getUserUserHasProjects"
								requestInclude="user,project"
								:requestExtraParameters="{'userId' : userId}"
								:columns="userUserHasProjectsColumns"
								:rowsButtons="userUserHasProjectsRowsButtons"
								buttonsColumnClass="col-md-2"
								:checkboxes="checkboxes"
								:emptyMessage="$t('user_has_projects.no_relation_yet')"
							>
								<span slot="top-actions">
									<a class="action-link pull-right" @click="userHasProjectShowCreateModal">
										{{ $t('user_has_projects.create_new_user_has_project') }}
									</a>
								</span>
							</DataTable>
						</div>
						<div class="tab-pane" id="user-notifications-tab-pane">
							TODO :
							<ul>
								<li>Notifications list</li>
								<li>Set as read ?</li>
								<li>Manually create notification ?</li>
							</ul>
						</div>
						<div class="tab-pane" id="user-api-configuration-tab-pane">
							TODO :
							<ul>
								<li>OAuth Clients</li>
								<li>OAuth Clients</li>
								<li>OAuth Personal Access Tokens</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<EditModal
			v-if="user != null"
			id="user-edit-modal"
			:title="$t('users.edit_user', {'name' : user.name})"
			:putUri="userEditModalPutUri"
			:fields="userEditModalFields"
			:onSuccess="userEditModalSuccess"
		></EditModal>
		<CreateModal
			id="user-has-projects-create-modal"
			:title="$t('user_has_projects.create_new_user_has_project')"
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
			:title="$t('user_has_projects.delete_user_has_project')"
			:deleteUri="userHasProjectDeleteModalDeleteUri"
			:onSuccess="userHasProjectDeleteModalSuccess"
			:message="userHasProjectDeleteModalMessage"
		></DeleteModal>
		<MassDeleteModal
			id="user-has-projects-mass-delete-modal"
			:title="$t('user_has_projects.mass_delete_user_has_project')"
			:rows="userHasProjectMassDeleteRows"
			:deleteUriTemplate="'/userHasProject/<%- row.user_id %>,<%- row.project_id %>'"
			:onSuccess="userHasProjectMassDeleteModalSuccess"
			:messageTemplate="$t('user_has_projects.mass_delete_user_has_project_message_template')"
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
		name: 'User',

		components: { DataTable, CreateModal, EditModal , DeleteModal, MassDeleteModal },

		data() {
			return {
				user : null,
				userEditModalUser : Object,
				userEditModalPutUri : String,
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
			'userId' : String
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
			userEditModalTitle() {
				this.$i18n.t('users.edit_user', {
					'name' : this.userEditModalUser.name
				});
			},
			userEditModalFields() {
				var fields = [
					{
						name : 'name',
						title : this.$i18n.t('users.user_name'),
						help : this.$i18n.t('users.user_name_help'),
						value : this.userEditModalUser.name,
						type : 'input'
					},
					{
						name : 'email',
						title : this.$i18n.t('users.user_email'),
						help : this.$i18n.t('users.user_email_help'),
						value : this.userEditModalUser.email,
						type : 'input'
					},
					{
						name : 'password',
						title : this.$i18n.t('users.user_password'),
						help : this.$i18n.t('users.user_password_help'),
						value : '',
						type : 'password'
					},
				];

				if (['Developer'].indexOf(this.$store.getters.me.user_group_id) != -1) {
					fields.unshift({
						name : 'user_group_id',
						title : this.$i18n.t('users.user_group_id'),
						help : this.$i18n.t('users.user_group_id_help'),
						value : this.userEditModalUser.user_group_id,
						type : 'select2',
						select2 : {
							labelProp : 'id',
							valueProp : 'id',
							feed : {
								getUri : '/userGroup',
								params : {
									limit: 10,
									order_by: 'id,asc',
								}
							},
						}
					});
				}

				return fields;
			},

			userUserHasProjectsDataStoreState() {
				return this.$store.state.userHasProjects;
			},
			userHasProjectEditModalTitle() {
				return this.$i18n.t('user_has_projects.edit_user_has_project', {
					'user_name' : this.editModalUserHasProject.user.data.name,
					'project_name' : this.editModalUserHasProject.project.data.name
				});
			},
			userUserHasProjectsColumns() {
				return [
					{
						name : 'project.data.name',
						class : 'col-md-4',
						title : this.$i18n.t('projects.project_name'),
						orderable : false,
						routerLink : {
							routeName : 'project',
							paramsNames : {
								'projectId' : 'project_id'
							}
						}
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
			userUserHasProjectsRowsButtons() {
				return [
					{
						title : this.$i18n.t('projects.see_project_btn'),
						class : 'btn btn-default',
						onClick : (userHasProject) => {
							this.$router.push({
								name: 'project',
								params: {
									'projectId': userHasProject.project_id
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
		},
		methods: {
			fetchData() {
				this.user = null;

				var propsData = this.$options.propsData;
				this.getUser(propsData.userId);
			},

			getUser(userId) {
				apiAxios
					.get('/user/' + userId)
					.then(response => {
						this.user = response.data.data;
					}).catch(error => {
						this.$root.axiosError(error);
					});
			},
			userEditModalSuccess() {
				// Refresh user
				this.fetchData();
			},
			userShowEditModal() {
				this.userEditModalUser = this.user;
				this.userEditModalPutUri = '/user/' + this.user.id;
				$('#user-edit-modal').modal('show');
			},

			userHasProjectShowCreateModal() {
				this.createModalDefaultUserHasProject = {
					user_id : this.userId,
					project_id : '',
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
