<template>
	<Modal
		:id="id"
		:title="title"
	>
		<!-- Errors -->
		<div class="alert alert-danger" v-if="errors.length > 0">
			<p>{{ $t('common.error') }}</p>
			<br>
			<ul>
				<li v-for="error in errors">
					{{ error }}
				</li>
			</ul>
		</div>

		<!-- Message -->
		<slot>
			<p v-html="message"></p>
		</slot>

		<span slot="buttons">
			 <button type="button" class="btn btn-danger" @click="destroy">
				 {{ $t('common.delete_btn') }}
			 </button>
		</span>
	</Modal>
</template>
<script>
	import Modal from './modal'

	export default {
		name: 'DeleteModal',
		components: { Modal },
		props: {
			id : String,
			title : String,
			deleteUri : '',
			onSuccess : Function,
			message : {
				type : String,
				default : function() {
					return this.$i18n.t('common.delete_message');
				}
			}
		},
		data() {
			return {
				errors : [],
				rawErrors : {},
			}
		},
		methods: {
			destroy() {
				this.errors = [];

				apiAxios.delete(this.deleteUri)
					.then(response => {
						this.onSuccess();
						this.errors = [];
						this.rawErrors = {};

						$('#' + this.id).modal('hide');
					})
					.catch(error => {
						if (typeof error.response.data === 'object') {
						this.rawErrors = error.response.data.errors;
						this.errors = _.flatten(_.toArray(error.response.data.errors));
					} else {
						this.$root.axiosError(error);
					}
				});
			},
		}
	}
</script>