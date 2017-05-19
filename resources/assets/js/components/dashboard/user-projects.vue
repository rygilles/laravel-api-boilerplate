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
					ref="ownerProjectsDatatable"
					:mainTitle="ownerProjectsMainTitle"
					defaultOrderByColumn="name"
					defaultOrderByDirection="asc"
					:defaultPaginationLimit="20"
					:paginationLimiting="false"
					:searching="false"
					dataStoreStateName="ownerProjects"
					dataLoadingStoreStateName="ownerProjectsLoading"
					dataDispatchAction="getUserOwnerProjects"
					:columns="ownerProjectsColumns"
					:rowsButtons="ownerProjectsRowsButtons"
					buttonsColumnClass="col-md-2"
					:checkboxes="checkboxes"
					:emptyMessage="ownerProjectsEmptyMessage"
				>
					<span slot="top-actions">
						<a class="action-link pull-right" @click="showCreateModal">
							{{ $t('projects.create_new_project') }}
						</a>
					</span>
				</DataTable>
			</div>
		</div>
		<div class="row" v-if="!('pagination' in adminProjectsDataStoreState.meta) || ((adminProjectsDataStoreState.data.length) > 0)">
			<div class="col-xs-12">
				<DataTable
					ref="adminProjectsDatatable"
					:mainTitle="adminProjectsMainTitle"
					defaultOrderByColumn="name"
					defaultOrderByDirection="asc"
					:defaultPaginationLimit="20"
					:paginationLimiting="false"
					:searching="false"
					dataStoreStateName="adminProjects"
					dataLoadingStoreStateName="adminProjectsLoading"
					dataDispatchAction="getUserAdminProjects"
					:columns="adminProjectsColumns"
					:rowsButtons="adminProjectsRowsButtons"
					buttonsColumnClass="col-md-2"
					:checkboxes="checkboxes"
				>
				</DataTable>
			</div>
		</div>
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
			adminProjectsDataStoreState() {
				return this.$store.state.adminProjects;
			},
			ownerProjectsMainTitle() {
				return this.$i18n.t('projects.owner_projects');
			},
			adminProjectsMainTitle() {
				return this.$i18n.t('projects.admin_projects');
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
			ownerProjectsColumns() {
				return [
					{
						name : 'name',
						class : 'col-md-6',
						title : this.$i18n.t('projects.project_name'),
						orderable : true,
						order_by_field : 'name',
					},
					{
						name : 'created_at',
						class : 'col-md-2',
						title : this.$i18n.t('common.created_at'),
						orderable : true,
						order_by_field : 'created_at',
						transformValue : (value) => {
							return this.momentLocalDate(value);
						}
					},
					{
						name : 'updated_at',
						class : 'col-md-2',
						title : this.$i18n.t('common.updated_at'),
						orderable : true,
						order_by_field : 'updated_at',
						transformValue : (value) => {
							return this.momentLocalDate(value);
						}
					}
				];
			},
			adminProjectsColumns() {
				return [
					{
						name : 'name',
						class : 'col-md-6',
						title : this.$i18n.t('projects.project_name'),
						orderable : true,
						order_by_field : 'name',
					},
					{
						name : 'created_at',
						class : 'col-md-2',
						title : this.$i18n.t('common.created_at'),
						orderable : true,
						order_by_field : 'created_at',
						transformValue : (value) => {
							return this.momentLocalDate(value);
						}
					},
					{
						name : 'updated_at',
						class : 'col-md-2',
						title : this.$i18n.t('common.updated_at'),
						orderable : true,
						order_by_field : 'updated_at',
						transformValue : (value) => {
							return this.momentLocalDate(value);
						}
					}
				];
			},
			ownerProjectsRowsButtons() {
				return [
					{
						title : this.$i18n.t('common.see_btn'),
						class : 'btn btn-default',
						onClick : (project) => {
							this.$router.push({
								name: 'user-project',
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
			adminProjectsRowsButtons() {
				return [
					{
						title : this.$i18n.t('common.see_btn'),
						class : 'btn btn-default',
						onClick : (project) => {
							this.$router.push({
								name: 'user-project',
								params: {
									'projectId': project.id
								}
							});
						}
					},
				]
			},
			createModalFields() {
				var fields = [
					{
						name : 'name',
						title : this.$i18n.t('projects.project_name'),
						help : this.$i18n.t('projects.project_name_help'),
						value : '',
						type : 'input'
					},
				];

				if (['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1) {
					fields.push({
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
					});
				}

				return fields;
			},
			editModalFields() {
				var fields = [
					{
						name : 'name',
						title : this.$i18n.t('projects.project_name'),
						help : this.$i18n.t('projects.project_name_help'),
						value : this.editModalProject.name,
						type : 'input'
					},
				];

				if (['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1) {
					fields.push({
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
					});
				}

				return fields;
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
					'enabled' : false,
				}
			},
			ownerProjectsEmptyMessage() {
				return this.$i18n.t('projects.no_project_yet');
			},
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
				// Refresh datatables
				this.$refs.ownerProjectsDatatable.fetchData();
			},
			editModalSuccess() {
				// Refresh datatables
				this.$refs.ownerProjectsDatatable.fetchData();
			},
			deleteModalSuccess() {
				// Refresh datatables
				this.$refs.ownerProjectsDatatable.fetchData();
			},
			massDeleteModalSuccess() {
				// Refresh datatables
				this.$refs.ownerProjectsDatatable.fetchData();
			}
		}
	}
</script>
