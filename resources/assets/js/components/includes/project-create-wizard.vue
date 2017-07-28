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
						<form class="form-horizontal">
							<div class="form-group">
								<label class="col-md-3 control-label">{{ $t('project_create_wizard.fields.projectName.label') }}</label>
								<div class="col-md-7">
									<input type="text" class="form-control" v-model="projectName">
									<span class="help-block">{{ $t('project_create_wizard.fields.projectName.help') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">{{ $t('project_create_wizard.fields.dataStreamFeedUrl.label') }}</label>
								<div class="col-md-7">
									<input type="text" class="form-control" v-model="dataStreamFeedUrl">
									<span class="help-block">{{ $t('project_create_wizard.fields.dataStreamFeedUrl.help') }}</span>
								</div>
							</div>
							<div class="form-group">
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
									></Select2>
									<span class="help-block">{{ $t('project_create_wizard.fields.dataStreamPresetId.help') }}</span>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="box-footer clearfix">
					<div class="row">
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
				'dataStreamFeedUrl': '',
				'dataStreamPresetId': '',
			}
		},
		props: {

		},
		computed: {

		},
		methods: {
			previousStep() {

			},
			nextStep() {

			}
		}
	}
</script>