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

		<!-- Form -->
		<form class="form-horizontal">
			<div v-for="field in fields" :class="['form-group', formGroupErrorClassObject(field)]">
				<label class="col-md-3 control-label">{{ field.title }}</label>
				<div class="col-md-7">
					<input v-if="field.type == 'input'" type="text" class="form-control" @keyup.enter="update" v-model="field.value">
					<textarea v-if="field.type == 'textarea'" class="form-control"  v-model="field.value"></textarea>
					<span v-if="'help' in field" class="help-block" v-html="field.help"></span>
				</div>
			</div>
		</form>

		<span slot="buttons">
			 <button type="button" class="btn btn-primary" @click="update">
				 {{ $t('common.edit_btn') }}
			 </button>
		</span>
	</Modal>
</template>
<script>
	import Modal from './modal'

	export default {
		name: 'EditModal',
		components: { Modal },
		props: {
			id : String,
			title : String,
			putUri : '',
			onSuccess : Function,
			fields : {
				type : Array,
				default : [
					{
						name : 'example',
						title : 'Example',
						help : 'Help example',
						value : 'value example',
						type : 'input'
					}
				]
			}
		},
		data() {
			return {
				errors : [],
				rawErrors : {},
			}
		},
		methods: {
			update() {
				this.errors = [];
				var form = {};

				this.fields.forEach((field) => {
					form[field.name] = field.value;
				});

				apiAxios.put(this.putUri, form)
						.then(response => {
							this.onSuccess();
							this.errors = [];
							this.rawErrors = {};
							this.fields.forEach((field) => {
								field.value = '';
							});
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
			formGroupErrorClassObject(field) {
				return {
					'has-error' : (field.name in this.rawErrors)
				};
			},
		}
	}
</script>