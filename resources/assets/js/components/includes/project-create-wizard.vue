<template>
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">{{ $t('project_create_wizard.title') }}</h3>
				</div>
				<div class="box-body">
					<p>
						{{ $t('project_create_wizard.steps[' + (step - 1) + '].description') }}
					</p>
					<div v-if="step == 1">
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
						<form class="form-horizontal">
							<div :class="['form-group', formGroupErrorClassObject('project', 'name')]">
								<label class="col-md-3 control-label">{{ $t('project_create_wizard.fields.projectName.label') }}</label>
								<div class="col-md-7">
									<input type="text"
										   class="form-control"
										   v-model="projectName"
										   :placeholder="$t('project_create_wizard.fields.projectName.placeholder')"
										   :disabled="(this.project != null)">
									<span class="help-block">{{ $t('project_create_wizard.fields.projectName.help') }}</span>
								</div>
							</div>
							<div v-if="(['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1)"
								 :class="['form-group', formGroupErrorClassObject('project', 'search_egine_id')]">
								<label class="col-md-3 control-label">{{ $t('project_create_wizard.fields.projectSearchEngineId.label') }}</label>
								<div class="col-md-7">
									<Select2
										v-model="projectSearchEngineId"
										:feed="{
											getUri : '/searchEngine',
											params : {
												limit: 10,
												order_by: 'name,asc',
											}
										}"
										labelProp="name"
										valueProp="id"
										class="form-control"
										:disabled="(this.project != null)"
									></Select2>
									<span class="help-block">{{ $t('project_create_wizard.fields.projectSearchEngineId.help') }}</span>
								</div>
							</div>
							<div :class="['form-group', formGroupErrorClassObject('projectDataStream', 'feed_url')]">
								<label class="col-md-3 control-label">{{ $t('project_create_wizard.fields.dataStreamFeedUrl.label') }}</label>
								<div class="col-md-7">
									<input type="text"
										   class="form-control"
										   v-model="dataStreamFeedUrl"
										   :disabled="(this.dataStream != null)">
									<span class="help-block">{{ $t('project_create_wizard.fields.dataStreamFeedUrl.help') }}</span>
								</div>
							</div>
							<div :class="['form-group', formGroupErrorClassObject('projectDataStreamPreset', 'id')]">
								<label class="col-md-3 control-label">{{ $t('project_create_wizard.fields.dataStreamPresetId.label') }}</label>
								<div class="col-md-7">
									<Select2
										v-model="dataStreamPresetId"
										:feed="{
											getUri : '/dataStreamPreset',
											params : {
												limit: 10,
												order_by: 'name,asc',
											}
										}"
										labelProp="name"
										valueProp="id"
										class="form-control"
										:disabled="(this.dataStream != null)"
									></Select2>
									<span class="help-block">{{ $t('project_create_wizard.fields.dataStreamPresetId.help') }}</span>
								</div>
							</div>
							<div :class="['form-group', formGroupErrorClassObject('projectI18nLangs', 'ids')]">
								<label class="col-md-3 control-label">{{ $t('project_create_wizard.fields.i18nLangsIds.label') }}</label>
								<div class="col-md-7">
									<Select2
										v-model="i18nLangsIds"
										:feed="{
											getUri : '/i18nLang',
											params : {
												limit: 10,
												order_by: 'id,asc',
											}
										}"
										labelProp="id"
										valueProp="id"
										class="form-control"
										:multiple="true"
										:disabled="(this.dataStreamHasI18nLangs != null)"
									></Select2>
									<span class="help-block">{{ $t('project_create_wizard.fields.i18nLangsIds.help') }}</span>
								</div>
							</div>
						</form>
					</div>
					<div v-if="step == 2">
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
						<form class="form-horizontal">
							<div v-if="this.dataStreamPresetId != null" :class="['form-group', formGroupErrorClassObject('widgetPresetId', 'ids')]">
								<label class="col-md-3 control-label">{{ $t('project_create_wizard.fields.widgetPresetId.label') }}</label>
								<div class="col-md-7">
									<Select2
										v-model="widgetPresetId"
										:feed="{
											getUri : '/dataStreamPreset/' + this.dataStreamPresetId + '/widgetPreset',
											getSingleResourceUri : 'widgetPreset',
											params : {
												limit: 10,
												order_by: 'id,asc',
											}
										}"
										labelProp="name"
										valueProp="id"
										class="form-control"
										:disabled="(this.widgetPreset != null)"
									></Select2>
									<span class="help-block">{{ $t('project_create_wizard.fields.widgetPresetId.help') }}</span>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="box-footer clearfix">
					<div class="row">
						<div class="col-xs-12">
							<button v-if="step > 1" type="button" class="btn btn-default" @click="previousStep">
								<i class="fa fa-arrow-circle-left"></i>
								&nbsp;{{ $t('project_create_wizard.buttons.previous_step') }}
							</button>
							<button type="button" class="btn btn-default pull-right" @click="nextStep">
								{{ $t('project_create_wizard.buttons.next_step') }}
								&nbsp;<i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import Select2 from './select2';

	export default {
		name: 'ProjectCreateWizard',
		components: { Select2 },
		data() {
			return {
				'step': 1,

				'projectName': '',
				'projectSearchEngineId': 'ee87e3b2-1388-11e7-93ae-92361f002671', /* Algolia */
				'dataStreamFeedUrl': '',
				'dataStreamPresetId': '',
				'i18nLangsIds': [],
				'widgetPresetId': null,

				'project': null,
				'dataStream': null,
				'dataStreamFields': null,
				'dataStreamPresetFields': null,
				'dataStreamHasI18nLangs': null,

				'widgetPreset': null,
				'searchUseCasePreset': null,
				'searchUseCasePresetFields': null,
				'widget': null,
				'searchUseCase': null,

				'errors' : [],
				'rawErrors' : {
					'project' : {},
					'projectDataStream' : {},
					'projectDataStreamPreset' : {},
				},
			}
		},
		props: {

		},
		computed: {

		},
		methods: {
			previousStep() {
				this.step--;
			},
			nextStep() {
				switch (this.step) {
					case 1:
						if ((this.project != null) && (this.dataStream != null)) {
							this.step++;
						} else {
							this.getDataStreamPreset(() => {
								this.getDataStreamPresetFields(() => {
									if ((this.project == null) ) {
										this.createProject(() => {
											this.createProjectDataStream(() => {
												this.createProjectDataStreamFields(() => {
													this.createDataStreamHasI18nLangs(() => {
														this.step++;
													});
												});
											});
										});
									} else {
										if ((this.dataStream == null)) {
											this.createProjectDataStream(() => {
												this.createProjectDataStreamFields(() => {
													this.createDataStreamHasI18nLangs(() => {
														this.step++;
													});
												});
											});
										} else {
											this.step++;
										}
									}
								});
							});
						}
						break;

					case 2:
						if (this.searchUseCase != null) {
							this.step++;
						} else {
							this.getWidgetPreset(() => {
								this.getSearchUseCasePreset(() => {
									this.getSearchUseCasePresetFields(() => {
										this.createSearchUseCase(() => {
											this.createSearchUseCaseFields(() => {
												this.createWidget();
											});
										});
									});
								});
							});
						}
						break;
				}
			},
			createProject(callback) {
				this.clearErrors();

				var form = {
					'name': this.projectName,
				};
				if (form.name == '') {
					form.name = this.$i18n.t('project_create_wizard.fields.projectName.placeholder');
				}
				if (['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1) {
					form.search_engine_id = this.projectSearchEngineId;
				}

				apiAxios.post('/project', form)
						.then(response => {
							this.clearErrors();
							this.project = response.data.data;
							if (typeof callback === 'function') {
								callback();
							}
						})
						.catch(error => {
							this.manageErrors('project', error)
						});
			},
			getDataStreamPreset(callback) {
				apiAxios.get('/dataStreamPreset/' + this.dataStreamPresetId)
						.then(response => {

							this.dataStreamPreset = response.data.data;

							if (typeof callback === 'function') {
								callback();
							}
						})
						.catch(error => {
							this.manageErrors('projectDataStreamPreset', error)
						});
			},
			getDataStreamPresetFields(callback) {
				apiAxios.get('/dataStreamPreset/' + this.dataStreamPresetId + '/dataStreamPresetField')
						.then(response => {

							this.dataStreamPresetFields = response.data.data;

							if (typeof callback === 'function') {
								callback();
							}
						})
						.catch(error => {
							this.manageErrors('projectDataStreamPresetFields', error)
						});
			},
			createProjectDataStream(callback) {
				this.clearErrors();

				var form = {
					'name': this.project.name + ' - ' + this.dataStreamPreset.name,
					'data_stream_decoder_id': this.dataStreamPreset.data_stream_decoder_id,
					'feed_url': this.dataStreamFeedUrl
				};

				apiAxios.post('/project/' + this.project.id + '/dataStream', form)
						.then(response => {
							this.clearErrors();
							this.dataStream = response.data.data;

							if (typeof callback === 'function') {
								callback();
							}
						})
						.catch(error => {
							this.manageErrors('projectDataStream', error)
						});
			},
			createProjectDataStreamFields(callback) {
				this.clearErrors();

				let formArray = [];

				_.forEach(this.dataStreamPresetFields, (dataStreamPresetField) => {
					var form = {
						'data_stream_id': this.dataStream.id,
						'name': dataStreamPresetField.name,
						'path': dataStreamPresetField.path,
						'versioned': dataStreamPresetField.versioned,
						'searchable': dataStreamPresetField.searchable,
						'to_retrieve': dataStreamPresetField.to_retrieve,
					};

					formArray.push(form);
				});

				let promiseArray = formArray.map((form) => apiAxios.post('/dataStreamField', form));

				Promise.all(promiseArray)
						.then((results) => {
							this.dataStreamFields = [];
							_.forEach(results, (response) => {
								this.dataStreamFields.push(response.data.data);
							});
							if (typeof callback === 'function') {
								callback();
							}
						})
						.catch(error => {
							this.manageErrors('projectDataStreamFields', error)
						});
			},
			createDataStreamHasI18nLangs(callback) {
				this.clearErrors();

				let formArray = [];

				_.forEach(this.i18nLangsIds, (i18nLangId) => {
					var form = {
						'data_stream_id': this.dataStream.id,
						'i18n_lang_id': i18nLangId,
					};

					formArray.push(form);
				});

				let promiseArray = formArray.map((form) => apiAxios.post('/dataStreamHasI18nLang', form));

				Promise.all(promiseArray)
						.then((results) => {
							this.dataStreamHasI18nLangs = [];
							_.forEach(results, (response) => {
								this.dataStreamHasI18nLangs.push(response.data.data);
							});
							if (typeof callback === 'function') {
								callback();
							}
						})
						.catch(error => {
							this.manageErrors('dataStreamHasI18nLangs', error)
						});
			},
			getWidgetPreset(callback) {
				apiAxios.get('/widgetPreset/' + this.widgetPresetId)
						.then(response => {

							this.widgetPreset = response.data.data;

							if (typeof callback === 'function') {
								callback();
							}
						})
						.catch(error => {
							this.manageErrors('widgetPreset', error)
						});
			},
			getSearchUseCasePreset(callback) {
				apiAxios.get('/searchUseCasePreset/' + this.widgetPreset.search_use_case_preset_id)
						.then(response => {

							this.searchUseCasePreset = response.data.data;

							if (typeof callback === 'function') {
								callback();
							}
						})
						.catch(error => {
							this.manageErrors('searchUseCasePreset', error)
						});
			},
			getSearchUseCasePresetFields(callback) {
				apiAxios.get('/searchUseCasePreset/' + this.searchUseCasePreset.id + '/searchUseCasePresetField')
						.then(response => {

							this.searchUseCasePresetFields = response.data.data;

							if (typeof callback === 'function') {
								callback();
							}
						})
						.catch(error => {
							this.manageErrors('searchUseCasePresetFields', error)
						});
			},
			createSearchUseCase(callback) {
				this.clearErrors();

				var form = {
					'name': this.project.name + ' - ' + this.dataStreamPreset.name + ' - ' + this.searchUseCasePreset.name,
					'project_id': this.project.id,
				};

				apiAxios.post('/searchUseCase', form)
						.then(response => {
							this.clearErrors();
							this.searchUseCase = response.data.data;

							if (typeof callback === 'function') {
								callback();
							}
						})
						.catch(error => {
							this.manageErrors('searchUseCase', error)
						});
			},
			createSearchUseCaseFields(callback) {
				this.clearErrors();

				let formArray = [];

				_.forEach(this.searchUseCasePresetFields, (searchUseCasePresetField) => {

					// Retrieve data stream field matching the search use case preset field name
					var data_stream_field_id = _.find(this.dataStreamFields, {'name': searchUseCasePresetField.name}).id;

					var form = {
						'search_use_case_id': this.searchUseCase.id,
						'data_stream_field_id': data_stream_field_id,
						'name': searchUseCasePresetField.name,
						'searchable': searchUseCasePresetField.searchable,
						'to_retrieve': searchUseCasePresetField.to_retrieve,
					};

					formArray.push(form);
				});

				let promiseArray = formArray.map((form) => apiAxios.post('/searchUseCaseField', form));

				Promise.all(promiseArray)
						.then((results) => {
							this.searchUseCaseFields = [];
							_.forEach(results, (response) => {
								this.searchUseCaseFields.push(response.data.data);
							});
							if (typeof callback === 'function') {
								callback();
							}
						})
						.catch(error => {
							this.manageErrors('searchUseCaseFields', error)
						});
			},
			createWidget(callback) {
				this.clearErrors();

				var form = {
					'name': this.project.name + ' - ' + this.widgetPreset.name,
					'search_use_case_id': this.searchUseCase.id,
				};

				apiAxios.post('/widget', form)
						.then(response => {
							this.clearErrors();
							this.widget = response.data.data;

							if (typeof callback === 'function') {
								callback();
							}
						})
						.catch(error => {
							this.manageErrors('widget', error)
						});
			},
			manageErrors(context, error) {
				if (('response' in error) && (typeof error.response.data === 'object')) {
					if ('errors' in error.response.data) {
						this.rawErrors[context] = error.response.data.errors;
						this.errors = _.flatten(_.toArray(error.response.data.errors));
					} else if ('message' in error.response.data) {
						this.errors = [error.response.data.message];
					}
				} else {
					this.$root.axiosError(error);
				}
			},
			clearErrors() {
				this.errors = [];
				this.rawErrors = {
					'project' : {},
					'projectDataStream' : {},
					'projectDataStreamPreset' : {},
				};
			},
			formGroupErrorClassObject(context, fieldName) {
				if (context in this.rawErrors) {
					if (fieldName in this.rawErrors[context]) {
						return {'has-error' : true};
					}
				}
				return {};
			},
		}
	}
</script>