<style scoped>
	.action-link {
		cursor: pointer;
	}
	.buttons-column {
		vertical-align: middle;
		text-align: right;
		white-space: nowrap;
	}

	.buttons-column-spacing {
		width: 1%;
	}

	.buttons-column .btn {
		margin-right: 4px;
	}

	.buttons-column .btn:last-child {
		margin-right: 0;
	}

	th.select-checkbox {
		width: 1%
	}

	table.dataTable tbody td.select-checkbox:before,
	table.dataTable tbody th.select-checkbox:before {
		margin-top: -6px;
	}

	table.dataTable tbody td.select-checkbox:before,
	table.dataTable tbody td.select-checkbox:after,
	table.dataTable tbody th.select-checkbox:before,
	table.dataTable tbody th.select-checkbox:after {
		top: 50%;
	}

	div.dataTables_info {
		padding-top: 0;
	}

	.vcenter {
		display: inline-block;
		vertical-align: middle;
		float: none;
	}

	.mass-selected span {
		margin-right: 9px;
	}

	.mass-selected .btn {
		margin-right: 4px;
	}

	.mass-selected .btn:last {
		margin-right: 0;
	}

	.empty-message {
		margin: 0;
		padding: 5px 0 5px 0;
		text-align: center;
		font-style: italic;
	}
</style>

<template>
	<div class="box">
		<div v-if="!hideHeader" class="box-header with-border">
			<h3 class="box-title">{{ mainTitle }}</h3>
			<slot name="top-actions"></slot>
		</div>
		<div class="overlay" v-if="dataLoadingStoreState">
			<i class="fa fa-refresh fa-spin"></i>
		</div>
		<div class="box-body">
			<div class="dataTables_wrapper form-inline dt-bootstrap">
				<div v-if="paginationLimiting || searching" class="row">
					<div class="col-sm-6">
						<div v-if="paginationLimiting" class="dataTables_length">
							<label>
								{{ $t('common.pagination.show') }}
								<select v-model.number="limit" name="i18nLangs_length" class="form-control input-sm">
									<option v-for="paginationLimit in paginationLimits" :value="paginationLimit">{{ paginationLimit }}</option>
								</select>
								{{ $t('common.pagination.entries') }}
							</label>
						</div>
					</div>
					<div class="col-sm-6">
						<div v-if="searching" class="dataTables_filter">
							<label>
								{{ $t('common.search') }} :
								<input v-model="search" type="search" class="form-control input-sm" placeholder="">
							</label>
						</div>
					</div>
				</div>
				<div v-if="(dataStoreState.data.length == 0) && (emptyMessage != '')" class="row">
					<div class="col-md-12">
						<p class="empty-message" v-html="emptyMessage"></p>
					</div>
				</div>
				<div v-else class="row">
					<div class="col-sm-12 table-responsive">
						<table role="grid" class="table table-striped table-hover table-responsive dataTable display">
							<thead>
								<tr role="row">
									<th v-if="checkboxes.enabled"
										class="select-checkbox">
									</th>
									<th v-for="column in columns" @click="toggleOrderBy(column)"
										:class="[column.class, orderByThClassObject(column)]"
										v-html="column.title">
									</th>
									<th v-if="rowsButtons.length > 0"></th>
								</tr>
							</thead>
							<tbody>

							<tr v-for="(dataRow, key, index) in dataStoreState.data"
								role="row"
								:class="dataRowTrClassObject(index, dataRow)">

								<td v-if="checkboxes.enabled"
									class="select-checkbox"
									@click="selectRow(dataRow)">
								</td>

								<td v-for="column in columns"
									:class="column.class"
									style="vertical-align: middle;">
									<router-link
										v-if="'routerLink' in column"
										:to="resolveColumnRouterTo(dataRow, column)">
										<span v-html="resolveColumnDataValue(dataRow, column)"></span>
									</router-link>
									<span v-else-if="'onClick' in column" @click="column.onClick(dataRow, column)" v-html="resolveColumnDataValue(dataRow, column)"></span>
									<span v-else v-html="resolveColumnDataValue(dataRow, column)"></span>
								</td>

								<!-- Buttons -->
								<td v-if="rowsButtons.length > 0" :class="buttonsColumnClassObject()">
									<button v-for="rowButton in rowsButtons"
											type="button"
											@click="rowButton.onClick(dataRow)"
											:class="rowButton.class"
											v-html="rowButton.title"></button>
								</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div v-if="(checkboxes.enabled && ('pagination' in dataStoreState.meta && dataStoreState.meta.pagination.total > 0)) || ('pagination' in dataStoreState.meta && dataStoreState.meta.pagination.total_pages > 1)"
			class="box-footer clearfix"
		>
			<div class="row">
				<div class="col-md-8">
					<div class="dataTables_info row"
						 role="status"
					>
						<div class="mass-selected col-md-6 vcenter" v-if="selectedRows.length > 0">
							<span v-html="$tc('common.mass.showing_info', selectedRows.length, { count: selectedRows.length})"></span>
							<button v-for="massButton in checkboxes.massButtons"
									type="button"
									:class="massButton.class"
									@click="massButton.onClick(selectedRows)"
									v-html="massButton.title"></button>
						</div>
						<div :class="['col-md-6', 'vcenter', {'text-center' : (selectedRows.length > 0)}] "
							  v-html="showingInfo"></div>
					</div>
				</div>
				<div class="col-md-4">
					<Pagination
						@update:page="val => page = val"
						:limit="limit"
						:metaPagination="dataStoreState.meta.pagination"
					/>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	require('lodash');

	import Pagination from './pagination'

	export default {
		name: 'DataTable',

		components: { Pagination },

		props: {
			'mainTitle': String,
			'hideHeader' : {
				type: Boolean,
				default: false
			},
			'emptyMessage' : {
				type: String,
				default: ''
			},
			'defaultOrderByColumn' : {
				type: String,
				default: 'id'
			},
			'defaultOrderByDirection' : {
				type: String,
				default: 'asc'
			},
			'defaultPaginationLimit': {
				type: Number,
				default: function() { return 25; }
			},
			'searching': {
				type: Boolean,
				default: true,
			},
			'paginationLimiting': {
				type: Boolean,
				default: true,
			},
			'paginationLimits': {
				type: Array,
				default: function() {
					return [10, 25, 50];
				}
			},
			'dataStoreStateName': String,
			'dataLoadingStoreStateName': String,
			'dataDispatchAction': String,
			'buttonsColumnClass': {
				type: String,
				default: ''
			},
			'columns': {
				type: Array,
				default: function() {
					return [
						{
							'name': 'id',
							'class': 'col-md-2',
							'title': 'Id',
							'orderable': true,
							'order_by_field' : 'id',
							'transformValue' : function(value) {
								return value;
							},
						}
					]
				}
			},
			'requestInclude' : {
				default: ''
			},
			'requestExtraParameters' : {
				type: Object,
				default: function() {
					return {};
				}
			},
			'rowsButtons' : {
				type : Array,
				default : function() {
					return [
						{
							title: 'Example',
							class: 'btn btn-default',
							onClick: function (row) {
								alert(row);
							}
						}
					];
				}
			},
			'checkboxes' : {
				type : Object,
				default : function() {
					return {
						'enabled' : true,
						'massButtons' : [
							{
								title : 'Example',
								class : 'btn btn-default',
								onClick : function(rows) {
									alert(rows.length + ' items selected');
								}
							}
						]
					}
				}
			},
			'rowClasses' : {
				type: Function,
				default : function(dataRow) {
					return [];
				}
			}
		},

		data() {
			return {
				'page' : 1,
				'limit' : this.defaultPaginationLimit,
				'search' : '',
				'order_by' : {
					'column' : this.defaultOrderByColumn,
					'direction' : this.defaultOrderByDirection,
				},
				'paginationPreviousRange' : 3,
				'paginationNextRange' : 3,
				'selectedRows' : [],
			};
		},

		/**
		 * Component created
		 */
		created() {
			this.fetchData();
		},

		/**
		 * Component watcher
		 */
		watch: {
			'$route' : 'fetchData',
			'page' : 'fetchData',
			'limit' : 'fetchData',
			'search' : 'fetchDataDebounced',
			'order_by.column' : 'fetchData',
			'order_by.direction' : 'fetchData',
		},

		methods: {
			fetchData: function() {
				this.selectedRows = [];

				var params = {
					page: this.page,
					limit: this.limit,
					search: this.search,
					order_by: this.order_by,
					include: this.requestInclude,
				};

				for (var param_name in this.requestExtraParameters) {
					params[param_name] = this.requestExtraParameters[param_name];
				}

				this.$store.dispatch(this.dataDispatchAction, params);
			},
			fetchDataDebounced: _.debounce(
				function() {
					this.selectedRows = [];

					var params = {
						page: this.page,
						limit: this.limit,
						search: this.search,
						order_by: this.order_by,
						include: this.requestInclude,
					};

					for (var param_name in this.requestExtraParameters) {
						params[param_name] = this.requestExtraParameters[param_name];
					}

					this.$store.dispatch(this.dataDispatchAction, params);
				}, 500
			),
			toggleOrderBy(column) {
				if (!column.orderable) {
					return;
				}

				if (this.order_by.column == column.order_by_field) {
					if (this.order_by.direction == 'asc') {
						this.order_by.direction = 'desc';
					}
					else {
						this.order_by.direction = 'asc';
					}
				} else {
					this.order_by.column = column.order_by_field;
					this.order_by.direction = 'asc';
				}
			},
			orderByThClassObject(column) {
				if (!column.orderable) {
					return {};
				}

				return {
					'sorting' : (this.order_by.column != column.name),
					'sorting_asc' : ((this.order_by.column == column.name) && (this.order_by.direction == 'asc')),
					'sorting_desc' : ((this.order_by.column == column.name) && (this.order_by.direction == 'desc')),
				};
			},
			buttonsColumnClassObject() {
				var classes = {
					'buttons-column': true
				};
				if (this.buttonsColumnClass != '') {
					classes[this.buttonsColumnClass] = true;
				} else {
					classes['buttons-column-spacing'] = true;
				}
				return classes;
			},
			dataRowTrClassObject(index, dataRow) {
				var rowExtraClasses = this.rowClasses(dataRow);

				var classes = {
					'even' : index % 2 == 0,
					'odd' : index % 2 != 0,
					'selected' : (_.indexOf(this.selectedRows, dataRow) != -1)
				};

				rowExtraClasses.forEach((extraClass) => {
					classes[extraClass] = true;
				});

				return classes;
			},
			selectRow(dataRow) {
				var rowIndex = _.indexOf(this.selectedRows, dataRow);
				if (rowIndex != -1) {
					this.selectedRows.splice(rowIndex, 1);
				} else {
					this.selectedRows.push(dataRow);
				}
			},
			resolveColumnDataValue(dataRow, column) {
				if ('resolveColumnDataValue' in column) {
					if (typeof column.resolveColumnDataValue == 'function') {
						return column.resolveColumnDataValue(dataRow, column);
					}
				}
				if ('transformValue' in column) {
					if (typeof column.transformValue == 'function') {
						return column.transformValue(column.name.split('.').reduce((o,i)=>o[i], dataRow), dataRow);
					}
				}
				return column.name.split('.').reduce((o,i)=>o[i], dataRow);
			},
			resolveColumnRouterTo(dataRow, column) {
				var to = {
					name: column.routerLink.routeName,
					params : {}
				};

				for (var paramName in column.routerLink.paramsNames) {
					to.params[paramName] = column.routerLink.paramsNames[paramName].split('.').reduce((o,i)=>o[i], dataRow);
				}

				return to;
			}
		},

		computed: {
			dataStoreState() {
				return this.$store.state[this.dataStoreStateName];
			},
			dataLoadingStoreState() {
				return this.$store.state[this.dataLoadingStoreStateName];
			},
			showingInfo() {
				try {
					return this.$i18n.t('common.pagination.showing_info', {
						from: (this.dataStoreState.meta.pagination.current_page - 1) * this.dataStoreState.meta.pagination.per_page + 1,
						to: (this.dataStoreState.meta.pagination.current_page - 1) * this.dataStoreState.meta.pagination.per_page + this.dataStoreState.meta.pagination.count,
						total: this.dataStoreState.meta.pagination.total
					});
				} catch (e) {
					return '';
				}
			},
		},
	}
</script>
