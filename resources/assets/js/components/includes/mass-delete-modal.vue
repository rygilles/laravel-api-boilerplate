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
		name: 'MassDeleteModal',
		components: { Modal },
		props: {
			id : String,
			title : String,
			rows : {
				type: Array,
				default : []
			},
			deleteUriTemplate : {
				type : String,
				default : function() {
					return 'you/need/to/specify/this/prop';
				}
			},
			onSuccess : Function,
			messageTemplate : {
				type : String,
				default : function() {
					return this.$i18n.t('common.delete_message');
				}
			}
		},
		data() {
			return {
				rowsDoneCount : 0,
				errors : [],
				rawErrors : {},
			}
		},
		computed: {
			message() {
				var compiledMessageTemplate = _.template(this.messageTemplate);
				var message = compiledMessageTemplate({'rows' : this.rows});
				return message;
			}
		},
		methods: {
			destroy() {
				this.errors = [];
				this.rawErrors = {};
				this.rowsDoneCount = 0;
				var compiledDeleteUriTemplate = _.template(this.deleteUriTemplate);
				this.rows.forEach((row) => {
					apiAxios.delete(compiledDeleteUriTemplate({'resourceRow' : row}))
						.then(response => {
							this.rowsDoneCount++;
							this.checkProgress();
						})
						.catch(error => {
							if (typeof error.response.data === 'object') {
								this.rawErrors = error.response.data.errors;
								this.errors = _.flatten(_.toArray(error.response.data.errors));
							} else {
								this.$root.axiosError(error);
							}
						});
				});
			},
			checkProgress() {
				if (this.rowsDoneCount == this.rows.length) {
					this.onSuccess();
					this.errors = [];
					this.rawErrors = {};

					$('#' + this.id).modal('hide');
				}
			}
		}
	}
</script>