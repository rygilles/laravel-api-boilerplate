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
					:defaultPaginationLimit="20"
					:paginationLimiting="false"
					:searching="false"
					dataStoreStateName="searchEngines"
					dataLoadingStoreStateName="searchEnginesLoading"
					dataDispatchAction="getSearchEngines"
					:columns="columns"
					:rowsButtons="rowsButtons"
					:checkboxes="{enabled: false}"
				>
					<span slot="top-actions">
						<a class="action-link pull-right" @click="showCreateModal">
							{{ $t('search_engines.create_new_search_engine') }}
						</a>
					</span>
				</DataTable>
				<CreateModal
					id="search-engines-create-modal"
					:title="createModalTitle"
					postUri="/searchEngine"
					:fields="createModalFields"
					:onSuccess="createModalSuccess"
				></CreateModal>
				<EditModal
					id="search-engines-edit-modal"
					:title="editModalTitle"
					:putUri="editModalPutUri"
					:fields="editModalFields"
					:onSuccess="editModalSuccess"
					:rowsButtons="rowsButtons"
				></EditModal>
				<DeleteModal
					id="search-engines-delete-modal"
					:title="deleteModalTitle"
					:deleteUri="deleteModalDeleteUri"
					:onSuccess="deleteModalSuccess"
					:message="deleteModalMessage"
				></DeleteModal>
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
		name: 'SearchEngines',

		components: { DataTable, CreateModal, EditModal , DeleteModal },

		data() {
			return {
				editModalSearchEngine : Object,
				editModalPutUri : String,
				deleteModalDeleteUri : String,
				deleteModalSearchEngine : Object,
				massDeleteRows : []
			}
		},

		computed: {
			mainTitle() {
				return this.$i18n.t('search_engines.search_engines');
			},
			createModalTitle() {
				return this.$i18n.t('search_engines.create_search_engine');
			},
			editModalTitle() {
				return this.$i18n.t('search_engines.edit_search_engine', {'name' : this.editModalSearchEngine.name});
			},
			deleteModalTitle() {
				return this.$i18n.t('search_engines.delete_search_engine');
			},
			columns() {
				return [
					{
						name : 'id',
						class : 'col-md-3 id-column',
						title : this.$i18n.t('search_engines.search_engine_id'),
						orderable : true,
						order_by_field : 'id',
					},
					{
						name : 'name',
						class : 'col-md-2',
						title : this.$i18n.t('search_engines.search_engine_name'),
						orderable : true,
						order_by_field : 'name',
					},
					{
						name : 'projects_count',
						class : '',
						title : this.$i18n.t('search_engines.projects_count'),
						orderable : true,
						order_by_field : 'projects_count',
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
						onClick : (searchEngine) => {
							this.$router.push({
								name: 'search-engine',
								params: {
									'searchEngineId': searchEngine.id
								}
							});
						}
					},
					{
						title : this.$i18n.t('common.edit_btn'),
						class : 'btn btn-default',
						onClick : (searchEngine) => {
							this.editModalSearchEngine = searchEngine;
							this.editModalPutUri = '/searchEngine/' + searchEngine.id;
							this.showEditModal();
						}
					},
					{
						title : this.$i18n.t('common.delete_btn'),
						class : 'btn btn-danger',
						onClick : (searchEngine) => {
							this.deleteModalSearchEngine = searchEngine;
							this.deleteModalDeleteUri = '/searchEngine/' + searchEngine.id;
							this.showDeleteModal();
						}
					}
				]
			},
			createModalFields() {
				return [
					{
						name : 'name',
						title : this.$i18n.t('search_engines.search_engine_name'),
						help : this.$i18n.t('search_engines.search_engine_name_help'),
						value : '',
						type : 'input'
					},
				];
			},
			editModalFields() {
				return [
					{
						name : 'name',
						title : this.$i18n.t('search_engines.search_engine_name'),
						help : this.$i18n.t('search_engines.search_engine_name_help'),
						value : this.editModalSearchEngine.name,
						type : 'input'
					},
				];
			},
			deleteModalMessage() {
				return this.$i18n.t('search_engines.delete_search_engine_message', {'name' : this.deleteModalSearchEngine.name});
			},
		},
		methods: {
			showCreateModal() {
				$('#search-engines-create-modal').modal('show');
			},
			showEditModal() {
				$('#search-engines-edit-modal').modal('show');
			},
			showDeleteModal() {
				$('#search-engines-delete-modal').modal('show');
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
		}
	}
</script>
