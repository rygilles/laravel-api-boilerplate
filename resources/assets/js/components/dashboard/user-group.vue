<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<DataManager
					i18nPath="users.data_manager.user_group_users"
					:resource="userGroupUsersDataManagerResource"
					:defaultOrderBy="{column: 'name', direction: 'asc'}"
					:pagination="{limiting: true, defaultLimit: 20, limits: [5, 10, 20]}"
					:searching="true"
					:request="{extraParameters: {userGroupId: userGroupId}}"
					:store="{stateName: 'userGroupUsers', loadingStateName: 'userGroupUsersLoading', dispatchAction: 'getUserGroupUsers'}"
					:columns="userGroupUsersDataManagerColumns"
					buttonsColumnClass="col-md-2"
				></DataManager>
			</div>
		</div>
	</section>
</template>

<script>
	import DataManager from '../includes/data-manager'

	export default {

		name: 'UserGroup',

		components: { DataManager },

		data() {
			return {
				userGroup : null,
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

			userGroupUsersDataManagerResource() {
				return {
					name: 'user',
					routePath: 'user',
					routeParamsMap: {
						'userId': 'id',
					},
					create: {
						postUri: '/user',
					},
					edit: {
						putUriTemplate: '/user/<%- resourceRow.id %>',
					},
					delete: {
						deleteUriTemplate: '/user/<%- resourceRow.id %>',
					},
					createDefaultResourceRow: {}
				}
			},

			userGroupUsersDataManagerColumns() {
				return [
					{
						name : 'id',
						class : 'col-md-3 id-column',
						orderable : true,
						order_by_field : 'id',

						create: {
							fillable: false,
						},

						edit: {
							fillable: false,
						}
					},
					{
						name : 'user_group_id',
						class : 'col-md-1',
						orderable : true,
						order_by_field : 'user_group_id',

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

						routerLink : {
							routeName : 'user-group',
							paramsNames : {
								'userGroupId' : 'user_group_id'
							}
						},

						create : {
							fillable: true,
							defaultValue: '',
						},

						edit : {
							fillable: true,
						}
					},
					{
						name : 'name',
						displayProp: 'name',
						class : '',
						orderable : true,
						routerLink : {
							routeName : 'user',
							paramsNames : {
								'userId' : 'id'
							}
						},

						type : 'input',

						create : {
							fillable: true,
							defaultValue: '',
						},

						edit : {
							fillable: true,
						}
					},
					{
						name : 'email',
						displayProp: 'email',
						class : '',

						type : 'input',

						create : {
							fillable: true,
							defaultValue: '',
						},

						edit : {
							fillable: true,
						}
					},
					{
						name : 'password',
						displayProp: 'password',
						class : '',

						type : 'password',

						list: {
							visible: false,
						},

						create : {
							fillable: true,
							defaultValue: '',
						},

						edit : {
							fillable: true,
						}
					},
					{
						name : 'created_at',
						class : '',
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
						}
					},
					{
						name : 'updated_at',
						class : '',
						orderable : true,
						order_by_field : 'updated_at',
						transformValue : (value) => {
							return this.momentLocalDate(value);
						},

						create: {
							fillable: false,
						},

						edit: {
							fillable: false,
						}
					}
				];
			},
		},

		methods: {
			fetchData() {
				this.userGroup = null;

				var propsData = this.$options.propsData;
				this.userGroup = {
					id: propsData.userGroupId
				}

				this.$emit('routeTitleDataUpdate', {
					userGroupId: this.userGroup.id
				});
			},
		}
	}
</script>
