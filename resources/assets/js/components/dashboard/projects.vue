<style>
	td.id-column {
		font-family: monospace;
		font-weight: bold;
	}
</style>

<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<DataTable
					ref="datatable"
					:mainTitle="mainTitle"
					defaultOrderByColumn="name"
					defaultOrderByDirection="asc"
					:defaultPaginationLimit="30"
					:paginationLimits="[10,20,30,40,50]"
					dataStoreStateName="allProjects"
					dataLoadingStoreStateName="allProjectsLoading"
					dataDispatchAction="getAllProjects"
					requestInclude="searchEngine"
					:columns="columns"
					:rowsButtons="rowsButtons"
					:checkboxes="checkboxes"
				>
					<span slot="top-actions">
						<a class="action-link pull-right" @click="showCreateModal">
							{{ $t('projects.create_new_project') }}
						</a>
					</span>
				</DataTable>
				<CreateModal
					id="projects-create-modal"
					:title="createModalTitle"
					postUri="/project"
					:fields="createModalFields"
					:onSuccess="createModalSuccess"
				></CreateModal>
				<EditModal
					id="projects-edit-modal"
					:title="editModalTitle"
					:putUri="editModalPutUri"
					:fields="editModalFields"
					:onSuccess="editModalSuccess"
					:rowsButtons="rowsButtons"
				></EditModal>
				<DeleteModal
					id="projects-delete-modal"
					:title="deleteModalTitle"
					:deleteUri="deleteModalDeleteUri"
					:onSuccess="deleteModalSuccess"
					:message="deleteModalMessage"
				></DeleteModal>
				<MassDeleteModal
					id="projects-mass-delete-modal"
					:title="massDeleteModalTitle"
					:rows="massDeleteRows"
					:deleteUriTemplate="massDeleteModalDeleteUriTemplate"
					:onSuccess="massDeleteModalSuccess"
					:messageTemplate="massDeleteModalMessageTemplate"
				></MassDeleteModal>
			</div>
		</div>
	</section>
</template>

<script>
	import DataTable from '../includes/datatable'
	import CreateModal from '../includes/create-modal'
	import EditModal from '../includes/edit-modal'
	import DeleteModal from '../includes/delete-modal'
	import MassDeleteModal from '../includes/mass-delete-modal'

	export default {
		name: 'Projects',

		components: { DataTable, CreateModal, EditModal , DeleteModal, MassDeleteModal },

		data() {
			return {
				editModalProject : Object,
				editModalPutUri : String,
				deleteModalDeleteUri : String,
				deleteModalProject : Object,
				massDeleteRows : []
			}
		},

		computed: {
			mainTitle() {
				return this.$i18n.t('projects.projects');
			},
			createModalTitle() {
				return this.$i18n.t('projects.create_new_project');
			},
			editModalTitle() {
				return this.$i18n.t('projects.edit_project', {'name' : this.editModalProject.name});
			},
			deleteModalTitle() {
				return this.$i18n.t('projects.delete_project');
			},
			massDeleteModalTitle() {
				return this.$i18n.t('projects.mass_delete_project');
			},
			columns() {
				return [
					{
						name : 'id',
						class : 'col-md-3 id-column',
						title : this.$i18n.t('projects.project_id'),
						orderable : true,
						order_by_field : 'id',
					},
					{
						name : 'name',
						class : '',
						title : this.$i18n.t('projects.project_name'),
						orderable : true,
						order_by_field : 'name',
					},
					{
						name : 'searchEngine.data.name',
						class : '',
						title : this.$i18n.t('projects.search_engine_name'),
						orderable : false,
						routerLink : {
							routeName : 'search-engine',
							paramsNames : {
								'searchEngineId' : 'search_engine_id'
							}
						}
					},
					{
						name : 'created_at',
						class : '',
						title : this.$i18n.t('common.created_at'),
						orderable : true,
						order_by_field : 'created_at',
						transformValue : (value) => {
							return this.momentLocalDate(value);
						}
					},
					{
						name : 'updated_at',
						class : '',
						title : this.$i18n.t('common.updated_at'),
						orderable : true,
						order_by_field : 'updated_at',
						transformValue : (value) => {
							return this.momentLocalDate(value);
						}
					}
				];
			},
			rowsButtons() {
				return [
					{
						title : this.$i18n.t('common.see_btn'),
						class : 'btn btn-default',
						onClick : (project) => {
							this.$router.push({
								name: 'project',
								params: {
									'projectId': project.id
								}
							});
						}
					},
					{
						title : this.$i18n.t('common.edit_btn'),
						class : 'btn btn-default',
						onClick : (project) => {
							this.editModalProject = project;
							this.editModalPutUri = '/project/' + project.id;
							this.showEditModal();
						}
					},
					{
						title : this.$i18n.t('common.delete_btn'),
						class : 'btn btn-danger',
						onClick : (project) => {
							this.deleteModalProject = project;
							this.deleteModalDeleteUri = '/project/' + project.id;
							this.showDeleteModal();
						}
					}
				]
			},
			createModalFields() {
				return [
					{
						name : 'name',
						title : this.$i18n.t('projects.project_name'),
						help : this.$i18n.t('projects.project_name_help'),
						value : '',
						type : 'textarea'
					},
					{
						name : 'search_engine_id',
						title : this.$i18n.t('projects.search_engine_name'),
						help : this.$i18n.t('projects.search_engine_name_help'),
						value : '',
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
					}
				];
			},
			editModalFields() {
				return [
					{
						name : 'name',
						title : this.$i18n.t('projects.project_name'),
						help : this.$i18n.t('projects.project_name_help'),
						value : this.editModalProject.name,
						type : 'textarea'
					},
					{
						name : 'search_engine_id',
						title : this.$i18n.t('projects.search_engine_name'),
						help : this.$i18n.t('projects.search_engine_name_help'),
						value : this.editModalProject.search_engine_id,
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
			deleteModalMessage() {
				return this.$i18n.t('projects.delete_project_message', {'name' : this.deleteModalProject.name});
			},
			massDeleteModalDeleteUriTemplate() {
				return '/project/<%- row.id %>';
			},
			massDeleteModalMessageTemplate() {
				return this.$i18n.t('projects.mass_delete_project_message_template');
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
								this.massDeleteRows = rows;
								this.showMassDeleteModal();
							}
						}
					]
				}
			}
		},
		methods: {
			showCreateModal() {
				$('#projects-create-modal').modal('show');
			},
			showEditModal() {
				$('#projects-edit-modal').modal('show');
			},
			showDeleteModal() {
				$('#projects-delete-modal').modal('show');
			},
			showMassDeleteModal() {
				$('#projects-mass-delete-modal').modal('show');
			},
			createModalSuccess() {
				// Refresh datatable
				this.$refs.datatable.fetchData();
			},
			editModalSuccess() {
				// Refresh datatable
				this.$refs.datatable.fetchData();
			},
			deleteModalSuccess() {
				// Refresh datatable
				this.$refs.datatable.fetchData();
			},
			massDeleteModalSuccess() {
				// Refresh datatable
				this.$refs.datatable.fetchData();
			}
		}
	}
</script>
