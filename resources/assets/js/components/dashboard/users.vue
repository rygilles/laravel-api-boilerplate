<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<DataManager
					i18nPath="users.data_manager.users"
					:resource="dataManagerResource"
					:defaultOrderBy="{column: 'name', direction: 'asc'}"
					:pagination="{limiting: true, defaultLimit: 20, limits: [10, 20, 30, 40, 50]}"
					:searching="true"
					:store="{stateName: 'users', loadingStateName: 'usersLoading', dispatchAction: 'getUsers'}"
					:columns="dataManagerColumns"
					buttonsColumnClass="col-md-2"
				></DataManager>
			</div>
		</div>
	</section>
</template>

<script>
	import DataManager from '../includes/data-manager'

	export default {
		name: 'Users',

		components: { DataManager },

		computed: {
			dataManagerResource() {
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
			dataManagerColumns() {
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
						routerLink : {
							routeName : 'user-group',
							paramsNames : {
								'userGroupId' : 'user_group_id'
							}
						},

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

						create: {
							defaultValue: 'End-User',
							fillable: true,
						},

						edit: {
							fillable: true,
						}
					},
					{
						name : 'name',
						class : '',
						orderable : true,
						order_by_field : 'name',
						type: 'input',

						routerLink : {
							routeName : 'user',
							paramsNames : {
								'userId' : 'id'
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
						name : 'email',
						class : '',
						orderable : true,
						order_by_field : 'email',
						type: 'input',

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
		}
	}
</script>
