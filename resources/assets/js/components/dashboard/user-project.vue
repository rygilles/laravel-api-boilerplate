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
								<b v-html="$t('projects.name')"></b> <span class="pull-right" v-html="project.name"></span>
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
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#project-user-has-projects-tab-pane" data-toggle="tab">
								<i class="fa fa-user fa-fw"></i> <span v-html="$t('users.users')"></span>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="project-user-has-projects-tab-pane">
							<DataManager
								:rights="{allowSee: false, allowEdit: false}"
								i18nPath="users.data_manager.administrator_users"
								:resource="administratorUsersDataManagerResource"
								:defaultOrderBy="{column: 'created_at', direction: 'asc'}"
								:pagination="{limiting: false, defaultLimit: 20}"
								:searching="false"
								:request="{include: 'user', extraParameters: {projectId: projectId}}"
								:store="{stateName: 'projectUserHasProjects', loadingStateName: 'projectUserHasProjectsLoading', dispatchAction: 'getProjectUserHasProjects'}"
								:columns="projectUserHasProjectsColumns"
								:checkboxes="{enabled: false}"
								buttonsColumnClass="col-md-2"
							></DataManager>
						</div>
					</div>
				</div>
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
	</section>
</template>

<script>
	import DataManager from '../includes/data-manager'
	import EditModal from '../includes/edit-modal'

	export default {
		name: 'UserProject',

		components: { DataManager, EditModal },

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

			administratorUsersDataManagerResource() {
				return {
					name: 'userHasProject',
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
			projectUserHasProjectsColumns() {
				return [
					{
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
			},

			getProject(projectId) {
				apiAxios
					.get('/project/' + projectId)
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
		}
	}
</script>
