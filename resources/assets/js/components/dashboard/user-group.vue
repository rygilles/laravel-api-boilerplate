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
					dataStoreStateName="userGroupUsers"
					dataLoadingStoreStateName="userGroupUsersLoading"
					dataDispatchAction="getUserGroupUsers"
					:requestExtraParameters="{'userGroupId' : userGroupId}"
					:columns="columns"
					:rowsButtons="rowsButtons"
					:checkboxes="checkboxes"
				>
					<span slot="top-actions">
						<a class="action-link pull-right" @click="showCreateModal">
							{{ $t('users.create_new_user') }}
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

		name: 'UserGroup',

		components: { DataTable, CreateModal, EditModal , DeleteModal, MassDeleteModal },

		data() {
			return {
				userGroup : null,
				editModalUser : Object,
				editModalPutUri : String,
				deleteModalDeleteUri : String,
				deleteModalUser : Object,
				massDeleteRows : []
			}
		},

		props : {
			'userGroupId' : String
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
			mainTitle() {
				return this.$i18n.t('user_groups.user_group_users', { id: this.userGroupId });
			},
			createModalTitle() {
				return this.$i18n.t('users.create_new_user');
			},
			editModalTitle() {
				return this.$i18n.t('users.edit_user', {'name' : this.editModalUser.name});
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
					},
					{
						name : 'email',
						class : '',
						title  : this.$i18n.t('users.user_email'),
						orderable : true,
						order_by_field : 'email',
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
						name : 'user_group_id',
						title : this.$i18n.t('users.user_group_id'),
						help : this.$i18n.t('users.user_group_id_help'),
						value : '',
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
						},
					},
					{
						name : 'name',
						title : this.$i18n.t('users.user_name'),
						help : this.$i18n.t('users.user_name_help'),
						value : '',
						type : 'input'
					},
					{
						name : 'email',
						title : this.$i18n.t('users.user_email'),
						help : this.$i18n.t('users.user_email_help'),
						value : '',
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
			},
			editModalFields() {
				var fields = [
					{
						name : 'name',
						title : this.$i18n.t('users.user_name'),
						help : this.$i18n.t('users.user_name_help'),
						value : this.editModalUser.name,
						type : 'input'
					},
					{
						name : 'email',
						title : this.$i18n.t('users.user_email'),
						help : this.$i18n.t('users.user_email_help'),
						value : this.editModalUser.email,
						type : 'input'
					},
					{
						name : 'password',
						title : this.$i18n.t('users.user_password'),
						help : this.$i18n.t('users.user_password_help'),
						value : '', // @todo rewrite only if not empty !
						type : 'password'
					},
				];

				if (['Developer'].indexOf(this.$store.getters.me.user_group_id) != -1) {
					fields.unshift({
						name : 'user_group_id',
						title : this.$i18n.t('users.user_group_id'),
						help : this.$i18n.t('users.user_group_id_help'),
						value : this.editModalUser.user_group_id,
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
			fetchData() {
				this.userGroup = null;

				var propsData = this.$options.propsData;
				this.userGroup = {
					id: propsData.userGroupId
				}
			},
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
