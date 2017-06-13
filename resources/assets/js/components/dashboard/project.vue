<style scoped>
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
								<b v-html="$t('projects.project_name')"></b> <span class="pull-right" v-html="project.name"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('projects.owner_name')"></b>
								<span v-if="(['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1)" class="pull-right">
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
						<li v-if="(['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1)">
							<a href="#project-sync-items-tab-pane" data-toggle="tab">
								<i class="fa fa-external-link fa-fw"></i> <span v-html="'Sync Items (TODO)'"></span>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="project-user-has-projects-tab-pane">
							<DataManager
								:rights="{
									allowSee: (['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1),
									allowCreate: (['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1) || this.loggedUserIsProjectOwner,
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
						<div v-if="(['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1)" class="tab-pane" id="project-sync-items-tab-pane">
							TODO
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
	</section>
</template>

<script>
	import DataManager from '../includes/data-manager'
	import EditModal from '../includes/edit-modal'

	export default {
		name: 'Project',

		components: { DataManager, EditModal , },

		data() {
			return {
				project : null,
				projectEditModalProject : Object,
				projectEditModalPutUri : String,
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
		},
		methods: {
			fetchData() {
				this.user = null;

				var propsData = this.$options.propsData;
				this.getProject(propsData.projectId);
				this.getProjectOwner(propsData.projectId);
			},

			getProject(projectId) {
				apiAxios
					.get('/project/' + projectId, { params : { include : 'searchEngine' } })
					.then(response => {
						this.project = response.data.data;
						this.$emit('routeTitleDataUpdate', this.project);
					}).catch(error => {
						this.$root.axiosError(error);
					});
			},

			getProjectOwner(projectId) {
				this.$store.dispatch('getProjectOwnerUserHasProjects', { projectId: projectId, include: 'user' });
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
		}
	}
</script>
