<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<DataManager
					i18nPath="i18n_langs.data_manager.i18n_langs"
					:resource="dataManagerResource"
					:defaultOrderBy="{column: 'id', direction: 'asc'}"
					:pagination="{limiting: true, defaultLimit: 30, limits: [10, 20, 30, 40, 50]}"
					:searching="true"
					:store="{stateName: 'i18nLangs', loadingStateName: 'i18nLangsLoading', dispatchAction: 'getI18nLangs'}"
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
		name: 'I18nLangs',

		components: { DataManager },

		computed: {
			dataManagerResource() {
				return {
					name: 'i18nLang',
					routePath: 'i18n-lang',
					routeParamsMap: {
						'i18nLangId': 'id',
					},
					create: {
						postUri: '/i18nLang',
					},
					edit: {
						putUriTemplate: '/i18nLang/<%- resourceRow.id %>',
					},
					delete: {
						deleteUriTemplate: '/i18nLang/<%- resourceRow.id %>',
					},
					createDefaultResourceRow: {}
				}
			},
			dataManagerColumns() {
				return [
					{
						name : 'id',
						class : 'col-md-1 id-column',
						orderable : true,
						order_by_field : 'id',
						type: 'input',

						create: {
							fillable: true,
							defaultValue: '',
						},

						edit: {
							fillable: false,
						}
					},
					{
						name : 'description',
						class : '',
						orderable : true,
						order_by_field : 'description',
						type: 'textarea',

						create : {
							fillable: true,
							defaultValue: '',
						},

						edit : {
							fillable: true,
						}
					},
				];
			},
		},
	}
</script>
