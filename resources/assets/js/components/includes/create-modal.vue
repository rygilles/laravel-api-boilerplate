<style scoped>
	.checkbox-label > span {
		vertical-align: 2px;
	}

	.checkbox-label > input[type=checkbox] {
		margin-right: 1px;
	}
</style>

<template>
	<Modal
		ref="modal"
		:id="id"
		:title="modalTitle"
		:onClose="onClose"
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
					<label v-if="field.type != 'boolean'" class="col-md-3 control-label" v-html="fieldTitle(field)"></label>
					<div :class="['col-md-7', {'col-md-offset-3' : field.type == 'boolean'}]">
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
						<label v-if="field.type == 'boolean'" class="control-label checkbox-label">
							<input type="checkbox" v-model="field.value">
							<span v-html="fieldTitle(field)"></span>
						</label>
						<span v-if="fieldHelp(field) != ''" class="help-block" v-html="fieldHelp(field)"></span>
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
			title : {
				default: null,
			},
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
			},
			onClose: {
				type: Function,
				default: function() {}
			},
			i18nPath : {
				type: String,
				default: '',
			},
		},
		watch: {
			onClose : function(value) {
				$(document).ready(() => {
					$('#' + this.id).on('hide.bs.modal', this.onClose);
				})
			}
		},
		data() {
			return {
				errors : [],
				rawErrors : {},
			}
		},
		computed: {
			modalTitle() {
				if (this.title != null) {
					return this.title;
				}

				if (this.i18nExist('title_template')) {
					var compiledTitleTemplate = _.template(this.i18n('title_template'));

					var resourceRow = {};
					this.fields.forEach((field) => {
						resourceRow[field.name] = field.value;
					});

					return compiledTitleTemplate({'resourceRow' : resourceRow});
				}

				return '';
			},
		},
		methods: {
			clearErrors() {
				this.errors = [];
				this.rawErrors = {};
			},
			store() {
				this.errors = [];
				var form = {};

				this.fields.forEach((field) => {
					if (('optional' in field) && field.optional) {
						if (field.value !== null && field.value != '') {
							form[field.name] = field.value;
						}
					} else {
						form[field.name] = field.value;
					}
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
												translatedErrors[errFieldName][index] = _.replace(errLine, new RegExp(_.replace(field.name, new RegExp('_', 'g'), ' '), 'g'), '"' + this.fieldTitle(field) + '"');
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

			i18n(path) {
				return this.$i18n.t(this.i18nPath + '.' + path);
			},

			i18nExist(path) {
				return this.$i18n._exist(this.$i18n.messages[this.$i18n.locale], this.i18nPath + '.' + path)
			},

			fieldTitle(field) {
				if ('title' in field) {
					return field.title;
				}

				if (this.i18nExist('fields.' + field.name + '.title')) {
					return this.i18n('fields.' + field.name + '.title')
				}

				return '';
			},

			fieldHelp(field) {
				if ('help' in field) {
					return field.help;
				}

				if (this.i18nExist('fields.' + field.name + '.help')) {
					return this.i18n('fields.' + field.name + '.help')
				}

				return '';
			},
		}
	}
</script>