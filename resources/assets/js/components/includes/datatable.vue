<style scoped>
	.action-link {
		cursor: pointer;
	}
	.buttons-column {
		vertical-align: middle;
		width: 1%;
		white-space: nowrap;
	}

	.buttons-column .btn {
		margin-right: 4px;
	}

	.buttons-column .btn:last-child {
		margin-right: 0;
	}
</style>

<template>
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">{{ mainTitle }}</h3>
			<slot name="top-actions"></slot>
		</div>
		<div class="overlay" v-if="dataLoadingStoreState">
			<i class="fa fa-refresh fa-spin"></i>
		</div>
		<div class="box-body">
			<div class="dataTables_wrapper form-inline dt-bootstrap">
				<div class="row">
					<div class="col-sm-6">
						<div class="dataTables_length">
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
						<div class="dataTables_filter">
							<label>
								{{ $t('common.search') }} :
								<input v-model="search" type="search" class="form-control input-sm" placeholder="">
							</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 table-responsive">
						<table role="grid" class="table table-bordered table-striped dataTable">
							<thead>
							<tr role="row">
								<th v-for="column in columns" @click="toggleOrderBy(column)"
									:class="[column.class, orderByThClassObject(column)]">
									{{ column.title }}
								</th>
								<th></th>
							</tr>
							</thead>
							<tbody>

							<tr v-for="dataRow in dataStoreState.data" role="row">

								<td v-for="column in columns"
									:class="column.class"
									style="vertical-align: middle;">
									{{ dataRow[column.name] }}
								</td>

								<!-- Buttons -->
								<td class="buttons-column">
									<button v-for="rowButton in rowsButtons" type="button" :class="rowButton.class" @click="rowButton.onClick(dataRow)">
										{{ rowButton.title }}
									</button>
								</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="box-footer clearfix">
			<div class="row">
				<div class="col-sm-5">
					<div class="dataTables_info"
						 role="status"
						 v-html="$t('common.pagination.showing_info', {
									from: (dataStoreState.meta.pagination.current_page - 1) * dataStoreState.meta.pagination.per_page + 1,
									to: (dataStoreState.meta.pagination.current_page - 1) * dataStoreState.meta.pagination.per_page + dataStoreState.meta.pagination.count,
									total: dataStoreState.meta.pagination.total
								 })">
					</div>
				</div>
				<div class="col-sm-7">
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
			'defaultPaginationLimit': {
				type: Number,
				default: function() { return 25; }
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
			'columns': {
				type: Array,
				default: function() {
					return [
						{
							'name': 'id',
							'class': 'col-md-2',
							'title': 'Id',
							'orderable': true,
						}
					]
				}
			},
			'rowsButtons' : {
				type : Array,
				default : [
					{
						title : 'example',
						class : 'btn btn-default',
						onClick : function(row) {
							alert(row);
						}
					}
				]
			}
		},

		data() {
			return {
				'page' : 1,
				'limit' : this.defaultPaginationLimit,
				'search' : '',
				'order_by' : {
					'column' : 'id',
					'direction' : 'asc',
				},
				'paginationPreviousRange' : 3,
				'paginationNextRange' : 3,
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
				this.$store.dispatch(this.dataDispatchAction, {
					page: this.page,
					limit: this.limit,
					search: this.search,
					order_by: this.order_by,
				});
			},
			fetchDataDebounced: _.debounce(
				function() {
					this.$store.dispatch(this.dataDispatchAction, {
						page: this.page,
						limit: this.limit,
						search: this.search,
						order_by: this.order_by,
					});
				}, 500
			),
			toggleOrderBy(column) {
				if (!column.orderable) {
					return;
				}

				if (this.order_by.column == column.name) {
					if (this.order_by.direction == 'asc') {
						this.order_by.direction = 'desc';
					}
					else {
						this.order_by.direction = 'asc';
					}
				} else {
					this.order_by.column = column.name;
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
		},

		computed: {
			dataStoreState() {
				return this.$store.state[this.dataStoreStateName];
			},
			dataLoadingStoreState() {
				return this.$store.state[this.dataLoadingStoreStateName];
			},
		},
	}
</script>
