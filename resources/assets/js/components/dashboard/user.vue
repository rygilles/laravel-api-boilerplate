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
								<b v-html="$t('users.user_group_id')"></b>
								<span class="pull-right">
									<router-link
										:to="{ name: 'user-group', params : { 'userGroupId' : user.user_group_id }}"
										v-html="user.user_group_id">
									</router-link>
								</span>
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
							<DataManager
								:rights="{
									allowEdit: false,
								}"
								i18nPath="user_has_projects.data_manager.user_user_has_projects"
								:resource="userUserHasProjectDataManagerResource"
								:defaultOrderBy="{column: 'user_role_id', direction: 'desc'}"
								:pagination="{limiting: false, defaultLimit: 20}"
								:searching="false"
								:request="{include: 'user,project', extraParameters: {userId: userId}}"
								:store="{stateName: 'userUserHasProjects', loadingStateName: 'userUserHasProjectsLoading', dispatchAction: 'getUserUserHasProjects'}"
								:columns="userUserHasProjectsDataManagerColumns"
								buttonsColumnClass="col-md-2"
							></DataManager>
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
	</section>
</template>

<script>
	import DataManager from '../includes/data-manager'
	import EditModal from '../includes/edit-modal'

	export default {
		name: 'User',

		components: { DataManager, EditModal },

		data() {
			return {
				user : null,
				userEditModalUser : Object,
				userEditModalPutUri : String,
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

			userUserHasProjectDataManagerResource() {
				return {
					name: 'userHasProject',
					routePath: 'project',
					routeParamsMap: {
						'projectId': 'project_id',
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

			userUserHasProjectsDataManagerColumns() {

				return [
					{
						name : 'project_name',
						displayProp : 'project.data.name',
						class : 'col-md-4',
						orderable : false,
						type: 'input',
						routerLink: {
							routeName: 'project',
							paramsNames: {
								'projectId': 'project_id'
							}
						},
						create : {
							fillable: false,
						},
						edit: {
							fillable: false,
						},
					},
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
							defaultValue: this.user_id,
						},
						edit: {
							fillable: false,
						},
					},
					{
						name : 'project_id',
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
						name : 'user_role_id',
						displayProp : 'user_role_id',
						class : 'col-md-2',
						orderable : true,
						type : 'select2',
						select2 : {
							labelProp : 'label',
							valueProp : 'id',
							options : [
								{
									id : 'Owner',
									label : this.$i18n.t('user_has_projects.user_role.Owner'),
								},
								{
									id : 'Administrator',
									label : this.$i18n.t('user_has_projects.user_role.Administrator'),
								}
							]
						},
						transformValue : (value) => {
							return this.$i18n.t('user_has_projects.user_role.' + value);
						},
						create : {
							fillable: true,
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
				];
			},


			userUserHasProjectsColumnsTODO() {
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
			userUserHasProjectsRowsButtonsTODO() {
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
			userHasProjectCreateModalFieldsTODO() {
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
						labelProp : 'id',
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
			userHasProjectEditModalFieldsTODO() {
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
								label : this.$i18n.t('user_has_projects.user_role.Owner'),
							},
							{
								id : 'Administrator',
								label : this.$i18n.t('user_has_projects.user_role.Administrator'),
							}
						]
					},
				});

				return fields;
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
						this.$emit('routeTitleDataUpdate', this.user);
					}).catch(error => {
						this.$root.axiosError(error);
					});
			},
			userEditModalSuccess() {
				// Refresh user
				this.fetchData();
			},
			userShowEditModal() {
				console.log('allo');
				this.userEditModalUser = this.user;
				this.userEditModalPutUri = '/user/' + this.user.id;
				$('#user-edit-modal').modal('show');
			},

			userHasProjectShowCreateModalTODO() {
				this.createModalDefaultUserHasProject = {
					user_id : this.userId,
					project_id : '',
					user_role_id : '',
				};

				$('#user-has-projects-create-modal').modal('show');
			},
		}
	}
</script>
