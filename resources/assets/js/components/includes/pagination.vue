<template>
	<div class="dataTables_paginate paging_simple_numbers">
		<ul class="pagination">
			<li v-if="metaPagination.current_page > 1" class="paginate_button first">
				<a @click="setCurrentPage(1)" href="javascript:;" :title="$t('common.pagination.first')">
					<i class="fa fa-angle-double-left"></i>
				</a>
			</li>
			<li v-if="metaPagination.current_page > 1" class="paginate_button previous">
				<a @click="setCurrentPage(metaPagination.current_page - 1)" href="javascript:;" :title="$t('common.pagination.previous')">
					<i class="fa fa-angle-left"></i>
				</a>
			</li>
			<li v-for="pageNum in previousRange" class="paginate_button"
				v-if="(metaPagination.current_page - previousRange + (pageNum - 1)) > 0">
				<a @click="setCurrentPage(metaPagination.current_page - previousRange + (pageNum - 1))"
				   href="javascript:;">
					{{ metaPagination.current_page - previousRange + (pageNum - 1) }}
				</a>
			</li>
			<li class="paginate_button active">
				<a href="javascript:;">
					{{ metaPagination.current_page }}
				</a>
			</li>
			<li v-for="pageNum in nextRange" class="paginate_button"
				v-if="(metaPagination.current_page + pageNum) <= metaPagination.total_pages">
				<a @click="setCurrentPage(metaPagination.current_page + pageNum)" href="javascript:;">
					{{ metaPagination.current_page + pageNum }}
				</a>
			</li>
			<li v-if="metaPagination.current_page < metaPagination.total_pages" class="paginate_button next">
				<a @click="setCurrentPage(metaPagination.current_page + 1)" href="javascript:;" :title="$t('common.pagination.next')">
					<i class="fa fa-angle-right"></i>
				</a>
			</li>
			<li v-if="metaPagination.current_page < metaPagination.total_pages" class="paginate_button last">
				<a @click="setCurrentPage(metaPagination.total_pages)" href="javascript:;" :title="$t('common.pagination.last')">
					<i class="fa fa-angle-double-right"></i>
				</a>
			</li>
		</ul>
	</div>
</template>
<script>
	export default {
		name: 'Pagination',
		props: {
			'page': {
				type: Number,
				default: 1,
			},
			'limit': {
				type: Number,
				default: 25,
			},
			'previousRange': {
				type: Number,
				default: 3,
			},
			'nextRange': {
				type: Number,
				default: 3,
			},
			'metaPagination': {
				// store meta pagination object
				type: Object,
			}
		},
		methods: {
			setCurrentPage(currentPage) {
				this.$emit('update:page', currentPage);
			},
		},
	}
</script>