<template>
	<select style="width: 100%"></select>
</template>
<script>
	export default {
		name: 'Select2',
		props: {
			options : {
				default : function() {
					return [];
				}
			},
			value : {
				type : String,
				default : '',
			},
			feed : {
				default : function() {
					return {
						getUri : '',
						params : {
							limit: 10,
							order_by: '',
						}
					};
				}
			},
			labelProp : {
				type : String,
				default : 'name'
			},
			valueProp : {
				type: String,
				default : 'value'
			},
		},
		data() {
			return {
				currentOptions: [],
			}
		},
		watch: {
			value: function (value) {
				// Get the current value
				if (this.value != '') {
					if (this.labelProp == this.valueProp) {
						$(this.$el).select2('destroy');
						if (this.options.length > 0) {
							this.currentOptions = [];
							this.options.forEach((option) => {
								this.currentOptions.push(option);
							});
						} else {
							this.currentOptions = [];
							this.currentOptions.push({
								id: value,
								text: value,
							});
						}
						this.initializeSelect2();
						$(this.$el).val(value).trigger('change');
					} else {
						if (this.options.length > 0) {
							this.currentOptions = [];
							this.options.forEach((option) => {
								this.currentOptions.push(option);
							});
							this.initializeSelect2();
							$(this.$el).val(value).trigger('change');
						} else if (this.feed.getUri != '') {
							apiAxios
								.get(this.feed.getUri + '/' + value)
								.then(response => {
									$(this.$el).select2('destroy');
									this.currentOptions = [];
									this.currentOptions.push({
										id: value,
										text: response.data.data[this.labelProp]
									});
									this.initializeSelect2();
									$(this.$el).val(value).trigger('change');
								})
								.catch(error => {
									this.$root.axiosError(error);
								});
						}
					}
				} else {
					$(this.$el).select2('destroy');
					this.initializeSelect2();
					$(this.$el).val(value).trigger('change');
				}
			},
			options: function (options) {
				this.currentOptions = [];
				options.forEach((option) => {
					this.currentOptions.push(option);
				});
				this.initializeSelect2();
			}
		},
		mounted() {
			this.currentOptions = this.options;
			this.initializeSelect2();

			var vm = this;
			$(this.$el)
				.val(vm.value)
				.trigger('change')
				.on('change', function() {
					vm.$emit('input', this.value);
				})
		},
		destroyed() {
			$(this.$el).off().select2('destroy');
		},
		methods : {
			initializeSelect2() {
				var vm = this;

				var config = {
					data: this.currentOptions,
				};

				if (this.feed.getUri != '') {
					config.ajax = {
						url: this.feed.getUri,
						delay : 250,
						data: function(params) {
							var query = {
								page: 1,
								limit: vm.feed.limit,
								order_by: vm.feed.order_by
							}

							if (params.term) {
								query.search = params.term + '*';
							}

							if (params.page) {
								query.page = params.page;
							}

							return query;
						},
						transport: function (params, success, failure) {
							var config = {
								params: params.data
							};
							apiAxios
								.get(vm.feed.getUri, config)
								.then(success)
								.catch(failure);
						},
						processResults: function (data, params) {
							var results = [];
							data.data.data.forEach((row) => {
								results.push({
									id : row[vm.valueProp],
									text : row[vm.labelProp],
								});
							});
							return {
								results : results,
								pagination: {
									more: (data.data.meta.pagination.current_page < data.data.meta.pagination.total_pages)
								},
								totals : data.data.meta.pagination.total
							};
						}
					}
				}

				$(this.$el).select2(config);
			}
		}
	}
</script>