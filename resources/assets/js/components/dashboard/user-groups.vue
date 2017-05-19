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
					:paginationLimiting="false"
					:searching="false"
					dataStoreStateName="userGroups"
					dataLoadingStoreStateName="userGroupsLoading"
					dataDispatchAction="getUserGroups"
					:columns="columns"
					:rowsButtons="rowsButtons"
					:checkboxes="{enabled: false}"
				>
				</DataTable>
			</div>
		</div>
	</section>
</template>

<script>
	import DataTable from '../includes/datatable'

	export default {
		name: 'UserGroups',

		components: { DataTable },

		computed: {
			mainTitle() {
				return this.$i18n.t('user_groups.user_groups');
			},
			columns() {
				return [
					{
						name : 'id',
						class : 'id-column',
						title : this.$i18n.t('user_groups.user_group_id'),
						orderable : true,
						order_by_field : 'id',
					},
					{
						name : 'users_count',
						class : 'col-md-2',
						title : this.$i18n.t('user_groups.users_count'),
						orderable : true,
						order_by_field : 'users_count',
					}
				];
			},
			rowsButtons() {
				return [
					{
						title : this.$i18n.t('common.see_btn'),
						class : 'btn btn-default',
						onClick : (userGroup) => {
							this.$router.push({
								name: 'user-group',
								params: {
									'userGroupId': userGroup.id
								}
							});
						}
					},
				]
			},
		},
	}
</script>
