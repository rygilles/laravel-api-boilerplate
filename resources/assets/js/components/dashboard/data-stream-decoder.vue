<style scoped>
	.data-stream-decoder-name {
		font-size: 21px;
		margin-top: 5px;
		margin-bottom: 10px;
	}
</style>

<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div v-if="dataStreamDecoder != null" class="col-md-3 no-right-padding">
				<div class="box box-primary">
					<div class="box-body">
						<h3 class="text-center data-stream-decoder-name" v-html="dataStreamDecoder.name"></h3>

						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<b v-html="$t('data_stream_decoders.id')"></b>
								<span class="pull-right" v-html="dataStreamDecoder.id"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('data_stream_decoders.name')"></b>
								<span class="pull-right" v-html="dataStreamDecoder.name"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('data_stream_decoders.class_name')"></b>
								<span class="pull-right" v-html="dataStreamDecoder.class_name"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('data_stream_decoders.file_mime_type')"></b>
								<span class="pull-right" v-html="dataStreamDecoder.file_mime_type"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('common.created_at')"></b>
								<span class="pull-right" v-html="momentLocalDate(dataStreamDecoder.created_at)"></span>
							</li>
							<li class="list-group-item">
								<b v-html="$t('common.updated_at')"></b>
								<span class="pull-right" v-html="momentLocalDate(dataStreamDecoder.updated_at)"></span>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li v-if="dataStreamDecoder != null" class="active">
							<a href="#data-streams-tab-pane" data-toggle="tab">
								<i class="fa fa-list fa-fw"></i> <span v-html="$t('data_stream_decoders.data_streams')"></span>
							</a>
						</li>

						<li v-if="dataStreamDecoder != null">
							<a href="#data-stream-presets-tab-pane" data-toggle="tab">
								<i class="fa fa-tachometer fa-fw"></i> <span v-html="$t('data_stream_presets.data_stream_presets')"></span>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="data-streams-preset-fields">
							TODO
						</div>
						<div class="tab-pane" id="data-stream-presets-tab-pane">
							TODO
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	import DataManager from '../includes/data-manager'

	export default {
		name: 'DataStreamDecoder',

		components: { DataManager },

		data() {
			return {
				dataStreamDecoder : null,
			}
		},

		props : {
			'dataStreamDecoderId' : String
		},

		/**
		 * Component created
		 */
		created() {
			// fetch the data when the view is created and the data is
			// already being observed
			this.fetchData();
		},

		/**
		 * Component watcher
		 */
		watch: {
			// call again the method if the route changes
			'$route' : function(val) {
				this.fetchData();
			}
		},

		computed: {

		},

		methods: {
			fetchData() {
				this.dataStreamDecoder = null;

				var propsData = this.$options.propsData;
				this.getDataStreamDecoder(propsData.dataStreamDecoderId);
			},

			getDataStreamDecoder(dataStreamDecoderId) {
				apiAxios
					.get('/dataStreamDecoder/' + dataStreamDecoderId)
					.then(response => {
						this.dataStreamDecoder = response.data.data;
						this.$emit('routeTitleDataUpdate', this.dataStreamDecoder);
					}).catch(error => {
						this.$root.axiosError(error);
					});
			},
		}
	}
</script>
