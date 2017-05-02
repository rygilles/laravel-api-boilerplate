<style scoped>
	.action-link {
		cursor: pointer;
	}
</style>

<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">{{ $t('i18n_langs.i18n_langs') }}</h3>
						<a class="action-link pull-right">
							{{ $t('i18n_langs.create_new_i18n_lang') }}
						</a>
					</div>
					<div class="overlay" v-if="i18nLangsLoading">
						<i class="fa fa-refresh fa-spin"></i>
					</div>
					<div class="box-body">
						<div class="dataTables_wrapper form-inline dt-bootstrap">
							<div class="row">
								<div class="col-sm-6">
									<div class="dataTables_length" id="i18nLangs_length">
										<label>
											{{ $t('common.pagination.show') }}
											<select v-model.number="limit" name="i18nLangs_length" class="form-control input-sm">
												<option value="10">10</option>
												<option value="25">25</option>
												<option value="50">50</option>
											</select>
											{{ $t('common.pagination.entries') }}
										</label>
									</div>
								</div>
								<div class="col-sm-6">
									<div id="i18nLangs_filter" class="dataTables_filter">
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
											<th @click="toggleOrderBy('id')"
												:class="orderByThClassObject('id')">
												{{ $t('i18n_langs.i18n_lang_id') }}
											</th>
											<th @click="toggleOrderBy('description')"
												:class="orderByThClassObject('description')">
												{{ $t('i18n_langs.i18n_lang_description') }}
											</th>
											<th></th>
										</tr>
										</thead>
										<tbody>

										<tr v-for="i18nLang in i18nLangs.data" role="row">
											<!-- Id -->
											<td class="col-md-2" style="vertical-align: middle;">
												<router-link :to="{ name: 'i18n-lang', params: { i18nLangId: i18nLang.id }}">{{ i18nLang.id }}</router-link>
											</td>

											<!-- Description -->
											<td style="vertical-align: middle;">
												{{ i18nLang.description }}
											</td>

											<!-- Buttons -->
											<td class="col-md-2 text-right" style="vertical-align: middle;">
												<a class="btn btn-default">
													{{ $t('i18n_langs.edit_btn') }}
												</a>
												<a class="btn btn-danger">
													{{ $t('i18n_langs.delete_btn') }}
												</a>
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
									 id="i18nLangs_info"
									 role="status"
									 v-html="$t('common.pagination.showing_info', {
												from: (i18nLangs.meta.pagination.current_page - 1) * i18nLangs.meta.pagination.per_page + 1,
												to: (i18nLangs.meta.pagination.current_page - 1) * i18nLangs.meta.pagination.per_page + i18nLangs.meta.pagination.count,
												total: i18nLangs.meta.pagination.total
											 })">
								</div>
							</div>
							<div class="col-sm-7">
								<Pagination
									@update:page="val => page = val"
									:limit="limit"
									:metaPagination="i18nLangs.meta.pagination"
								/>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	require('lodash');

	import Pagination from '../includes/pagination'

	export default {
		name: 'I18nLangs',

		components: { Pagination },

		data() {
			return {
				'page' : 1,
				'limit' : 25,
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
				this.$store.dispatch('getI18nLangs', {
					page: this.page,
					limit: this.limit,
					search: this.search,
					order_by: this.order_by,
				});
			},
			fetchDataDebounced: _.debounce(
				function() {
					this.$store.dispatch('getI18nLangs', {
						page: this.page,
						limit: this.limit,
						search: this.search,
						order_by: this.order_by,
					});
				}, 500
			),
			toggleOrderBy(column) {
				if (this.order_by.column == column) {
					if (this.order_by.direction == 'asc') {
						this.order_by.direction = 'desc';
					}
					else {
						this.order_by.direction = 'asc';
					}
				} else {
					this.order_by.column = column;
					this.order_by.direction = 'asc';
				}
			},
			orderByThClassObject(column) {
				return {
					'sorting' : (this.order_by.column != column),
					'sorting_asc' : ((this.order_by.column == column) && (this.order_by.direction == 'asc')),
					'sorting_desc' : ((this.order_by.column == column) && (this.order_by.direction == 'desc')),
				};
			},
		},

		computed: {
			i18nLangs() {
				return this.$store.state.i18nLangs;
			},
			i18nLangsLoading() {
				return this.$store.state.i18nLangsLoading;
			},
		},
	}
</script>
