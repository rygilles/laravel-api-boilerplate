<style scoped>
	.action-link {
		cursor: pointer;
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
					:defaultPaginationLimit="30"
					:paginationLimits="[10,20,30,40,50]"
					dataStoreStateName="i18nLangs"
					dataLoadingStoreStateName="i18nLangsLoading"
					dataDispatchAction="getI18nLangs"
					:columns="columns"
					:rowsButtons="rowsButtons"
				>
					<span slot="top-actions">
						<a class="action-link pull-right" @click="showCreateModal">
							{{ $t('i18n_langs.create_new_i18n_lang') }}
						</a>
					</span>
				</DataTable>
				<CreateModal
					id="i18n-langs-create-modal"
					:title="createModalTitle"
					postUri="/i18nLang"
					:fields="createModalFields"
					:onSuccess="createModalSuccess"
				></CreateModal>
				<EditModal
					id="i18n-langs-edit-modal"
					:title="editModalTitle"
					:putUri="editModalPutUri"
					:fields="editModalFields"
					:onSuccess="editModalSuccess"
					:rowsButtons="rowsButtons"
				></EditModal>
				<DeleteModal
					id="i18n-langs-delete-modal"
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

	export default {
		name: 'I18nLangs',

		components: { DataTable, CreateModal, EditModal , DeleteModal },

		data() {
			return {
				editModalI18nLang : Object,
				editModalPutUri : String,
				deleteModalDeleteUri : String,
				deleteModalI18nLang : Object,
			}
		},

		computed: {
			mainTitle() {
				return this.$i18n.t('i18n_langs.i18n_langs');
			},
			createModalTitle() {
				return this.$i18n.t('i18n_langs.create_new_i18n_lang');
			},
			editModalTitle() {
				return this.$i18n.t('i18n_langs.edit_i18n_lang', {'id' : this.editModalI18nLang.id});
			},
			deleteModalTitle() {
				return this.$i18n.t('i18n_langs.delete_i18n_lang');
			},
			columns() {
				return [
					{
						name : 'id',
						class : 'col-md-1',
						title : this.$i18n.t('i18n_langs.i18n_lang_id'),
						orderable : true,
					},
					{
						name : 'description',
						class : '',
						title  : this.$i18n.t('i18n_langs.i18n_lang_description'),
						orderable : true,
					}
				];
			},
			rowsButtons() {
				return [
					{
						title : this.$i18n.t('common.edit_btn'),
						class : 'btn btn-default',
						onClick : (i18nLang) => {
							this.editModalI18nLang = i18nLang;
							this.editModalPutUri = '/i18nLang/' + i18nLang.id;
							this.showEditModal();
						}
					},
					{
						title : this.$i18n.t('common.delete_btn'),
						class : 'btn btn-danger',
						onClick : (i18nLang) => {
							this.deleteModalI18nLang = i18nLang;
							this.deleteModalDeleteUri = '/i18nLang/' + i18nLang.id;
							this.showDeleteModal();
						}
					}
				]
			},
			createModalFields() {
				return [
					{
						name : 'id',
						title : this.$i18n.t('i18n_langs.i18n_lang_id'),
						help : this.$i18n.t('i18n_langs.i18n_lang_id_help'),
						value : '',
						type : 'input'
					},
					{
						name : 'description',
						title : this.$i18n.t('i18n_langs.i18n_lang_description'),
						help : this.$i18n.t('i18n_langs.i18n_lang_description_help'),
						value : '',
						type : 'textarea'
					}
				];
			},
			editModalFields() {
				return [
					{
						name : 'description',
						title : this.$i18n.t('i18n_langs.i18n_lang_description'),
						help : this.$i18n.t('i18n_langs.i18n_lang_description_help'),
						value : this.editModalI18nLang.description,
						type : 'textarea'
					}
				];
			},
			deleteModalMessage() {
				return this.$i18n.t('i18n_langs.delete_i18n_lang_message', {'id' : this.deleteModalI18nLang.id});
			},
		},
		methods: {
			showCreateModal() {
				$('#i18n-langs-create-modal').modal('show');
			},
			showEditModal() {
				$('#i18n-langs-edit-modal').modal('show');
			},
			showDeleteModal() {
				$('#i18n-langs-delete-modal').modal('show');
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
