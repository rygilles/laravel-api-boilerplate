<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<DataManager
					:rights="{allowCreate: false, allowEdit: false, allowDelete: false, allowMassDelete: false}"
					i18nPath="user_groups.data_manager"
					:resource="dataManagerResource"
					:defaultOrderBy="{column: 'id', direction: 'asc'}"
					:pagination="{limiting: false, defaultLimit: 20}"
					:searching="false"
					:store="{stateName: 'userGroups', loadingStateName: 'userGroupsLoading', dispatchAction: 'getUserGroups'}"
					:columns="dataManagerColumns"
					:checkboxes="{enabled: false}"
				></DataManager>
			</div>
		</div>
	</section>
</template>

<script>
	import DataManager from '../includes/data-manager'

	export default {
		name: 'UserGroups',

		components: { DataManager },

		computed: {
			dataManagerResource() {
				return {
					name: 'userGroup',
					routePath: 'user-group',
					routeParamsMap: {
						'userGroupId': 'id',
					},
				}
			},

			dataManagerColumns() {
				return [
					{
						name : 'id',
						class : 'id-column',
						orderable : true,
						order_by_field : 'id',
						routerLink : {
							routeName : 'user-group',
							paramsNames : {
								'userGroupId' : 'id'
							}
						}
					},
					{
						name : 'users_count',
						class : 'col-md-2',
						orderable : true,
						order_by_field : 'users_count',
					}
				];
			},
		},
	}
</script>
