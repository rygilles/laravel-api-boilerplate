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
			<div v-for="field in fields">
				<input v-if="field.type == 'hidden'" type="hidden" v-model="field.value">
				<div v-else :class="['form-group', formGroupErrorClassObject(field)]">
					<label class="col-md-3 control-label">{{ field.title }}</label>
					<div class="col-md-7">
						<input v-if="field.type == 'input'" type="text" class="form-control" @keyup.enter="store" v-model="field.value">
						<input v-if="field.type == 'password'" type="password" class="form-control" @keyup.enter="store" v-model="field.value">
						<textarea v-if="field.type == 'textarea'" class="form-control" v-model="field.value"></textarea>
						<Select2
							v-if="field.type == 'select2'"
							v-model="field.value"
							:options="field.select2.options"
							:feed="field.select2.feed"
							:labelProp="field.select2.labelProp"
							:valueProp="field.select2.valueProp"
							class="form-control"
						></Select2>
						<span v-if="'help' in field" class="help-block" v-html="field.help"></span>
					</div>
				</div>
			</div>
		</form>

		<span slot="buttons">
			 <button type="button" class="btn btn-primary" @click="store">
				 {{ $t('common.create_btn') }}
			 </button>
		</span>
	</Modal>
</template>
<script>
	import Modal from './modal';
	import Select2 from './select2';

	export default {
		name: 'CreateModal',
		components: { Modal, Select2 },
		props: {
			id : String,
			title : String,
			postUri : String,
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
			store() {
				this.errors = [];
				var form = {};

				this.fields.forEach((field) => {
					form[field.name] = field.value;
				});

				apiAxios.post(this.postUri, form)
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
							if (('response' in error) && (typeof error.response.data === 'object')) {
								if ('errors' in error.response.data) {
									this.rawErrors = error.response.data.errors;
									var translatedErrors = error.response.data.errors;
									for (var errFieldName in translatedErrors) {
										this.fields.forEach((field) => {
											if (field.name == errFieldName) {
												translatedErrors[errFieldName].forEach((errLine, index) => {
													translatedErrors[errFieldName][index] = _.replace(errLine, new RegExp(_.replace(field.name, new RegExp('_', 'g'), ' '), 'g'), '"' + field.title + '"');
												});
											}
										});
									}
									this.errors = _.flatten(_.toArray(translatedErrors));
								} else if ('message' in error.response.data) {
									this.errors = [error.response.data.message];
								}
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