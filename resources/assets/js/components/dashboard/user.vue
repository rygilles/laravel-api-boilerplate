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
								<b v-html="$t('users.preferred_language')"></b>
								<span class="pull-right"
									  v-html="(user.preferred_language == null ? $t('users.preferred_language_null_value_label') : user.preferred_language)"></span>
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
						<div class="active tab-pane" id="user-notifications-tab-pane">
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
					{
                        name : 'preferred_language',
                        title : this.$i18n.t('users.preferred_language'),
                        help : this.$i18n.t('users.preferred_language_help'),
                        value : this.userEditModalUser.preferred_language,
                        type : 'select2',
                        select2 : {
                            labelProp : 'label',
                            valueProp : 'id',
                            options : [
								{
								  	id : '',
									label : this.$i18n.t('users.preferred_language_null_value_label'),
								},
                                {
                                    id : 'fr',
                                    label : 'fr',
                                },
                                {
                                    id : 'en',
                                    label : 'en',
                                }
                            ]
                        },
					}
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
			}
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
				this.userEditModalUser = this.user;
				this.userEditModalPutUri = '/user/' + this.user.id;
				$('#user-edit-modal').modal('show');
			},
		}
	}
</script>
