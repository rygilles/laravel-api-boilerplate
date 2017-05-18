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
					:defaultPaginationLimit="20"
					:paginationLimits="[5,10,20]"
					dataStoreStateName="users"
					dataLoadingStoreStateName="usersLoading"
					dataDispatchAction="getUsers"
					:columns="columns"
					:rowsButtons="rowsButtons"
					:checkboxes="checkboxes"
				>
					<span slot="top-actions">
						<a class="action-link pull-right" @click="showCreateModal">
							{{ $t('i18n_langs.create_new_i18n_lang') }}
						</a>
					</span>
				</DataTable>
				<CreateModal
					id="users-create-modal"
					:title="createModalTitle"
					postUri="/user"
					:fields="createModalFields"
					:onSuccess="createModalSuccess"
				></CreateModal>
				<EditModal
					id="users-edit-modal"
					:title="editModalTitle"
					:putUri="editModalPutUri"
					:fields="editModalFields"
					:onSuccess="editModalSuccess"
					:rowsButtons="rowsButtons"
				></EditModal>
				<DeleteModal
					id="users-delete-modal"
					:title="deleteModalTitle"
					:deleteUri="deleteModalDeleteUri"
					:onSuccess="deleteModalSuccess"
					:message="deleteModalMessage"
				></DeleteModal>
				<MassDeleteModal
					id="users-mass-delete-modal"
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
		name: 'Users',

		components: { DataTable, CreateModal, EditModal , DeleteModal, MassDeleteModal },

		data() {
			return {
				editModalUser : Object,
				editModalPutUri : String,
				deleteModalDeleteUri : String,
				deleteModalUser : Object,
				massDeleteRows : []
			}
		},

		computed: {
			mainTitle() {
				return this.$i18n.t('users.users');
			},
			createModalTitle() {
				return this.$i18n.t('users.create_new_user');
			},
			editModalTitle() {
				return this.$i18n.t('users.edit_user', {'id' : this.editModalUser.id});
			},
			deleteModalTitle() {
				return this.$i18n.t('users.delete_user');
			},
			massDeleteModalTitle() {
				return this.$i18n.t('users.mass_delete_user');
			},
			columns() {
				return [
					{
						name : 'id',
						class : 'col-md-3 id-column',
						title : this.$i18n.t('users.user_id'),
						orderable : true,
						order_by_field : 'id',
					},
					{
						name : 'user_group_id',
						class : 'col-md-1',
						title  : this.$i18n.t('users.user_group_id'),
						orderable : true,
						order_by_field : 'user_group_id',
						routerLink : {
							routeName : 'user-group',
							paramsNames : {
								'userGroupId' : 'user_group_id'
							}
						}
					},
					{
						name : 'name',
						class : '',
						title  : this.$i18n.t('users.user_name'),
						orderable : true,
						order_by_field : 'name',
					}
				];
			},
			rowsButtons() {
				return [
					{
						title : this.$i18n.t('common.see_btn'),
						class : 'btn btn-default',
						onClick : (user) => {
							this.$router.push({
								name: 'user',
								params: {
									'userId': user.id
								}
							});
						}
					},
					{
						title : this.$i18n.t('common.edit_btn'),
						class : 'btn btn-default',
						onClick : (user) => {
							this.editModalUser = user;
							this.editModalPutUri = '/user/' + user.id;
							this.showEditModal();
						}
					},
					{
						title : this.$i18n.t('common.delete_btn'),
						class : 'btn btn-danger',
						onClick : (user) => {
							this.deleteModalUser = user;
							this.deleteModalDeleteUri = '/user/' + user.id;
							this.showDeleteModal();
						}
					}
				]
			},
			createModalFields() {
				return [
					{
						name : 'name',
						title : this.$i18n.t('users.user_name'),
						help : this.$i18n.t('users.user_name_help'),
						value : '',
						type : 'textarea'
					}
				];
			},
			editModalFields() {
				return [
					{
						name : 'name',
						title : this.$i18n.t('users.user_name'),
						help : this.$i18n.t('users.user_name_help'),
						value : this.editModalUser.name,
						type : 'textarea'
					}
				];
			},
			deleteModalMessage() {
				return this.$i18n.t('users.delete_user_message', {'name' : this.deleteModalUser.name});
			},
			massDeleteModalDeleteUriTemplate() {
				return '/user/<%- row.id %>';
			},
			massDeleteModalMessageTemplate() {
				return this.$i18n.t('users.mass_delete_user_message_template');
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
				$('#users-create-modal').modal('show');
			},
			showEditModal() {
				$('#users-edit-modal').modal('show');
			},
			showDeleteModal() {
				$('#users-delete-modal').modal('show');
			},
			showMassDeleteModal() {
				$('#users-mass-delete-modal').modal('show');
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
