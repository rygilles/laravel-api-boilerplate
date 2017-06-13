<template>
	<div class="modal fade" :id="id">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

					<h4 class="modal-title" v-html="title"></h4>
				</div>

				<div class="modal-body">
					<slot></slot>
				</div>

				<!-- Modal Actions -->
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">{{ $t('common.close_btn') }}</button>
					<slot name="buttons"></slot>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		name: 'Modal',
		props: {
			id: String,
			title: String,
			onClose: {
				type : Function,
				default : function() {}
			}
		},
		watch: {
			onClose : function(value) {
				$(document).ready(() => {
					$('#' + this.id).on('hide.bs.modal', this.onClose);
				})
			}
		},
		created() {
			$(document).ready(() => {
				$('#' + this.id).on('hide.bs.modal', this.onClose);
			})
		}
	}
</script>