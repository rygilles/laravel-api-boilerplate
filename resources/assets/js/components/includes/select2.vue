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
			value : null,
			labelProp : {
				type : String,
				default : 'text'
			},
			valueProp : {
				type: String,
				default : 'id'
			},
			feed : {
				default : function() {
					return {
						getUri : null,
						params : {
							limit: 10,
							order_by: '',
						}
					};
				}
			},
		},
		data() {
			return {
				currentOptions: [],
			}
		},
		watch: {
			value: function (value) {
				//console.log('trig value watch', value);

				if (this.labelProp == this.valueProp) {
					if (this.options.length == 0) {
						this.currentOptions = [{
							id: value,
							text: value,
						}];

						$(this.$el).select2().empty();
						$(this.$el).select2('destroy');
						$(this.$el).find('option').remove();

						this.init();
					}
				} else {
					if (this.feed.getUri != null) {
						$(this.$el).select2().empty();
						$(this.$el).select2('destroy');
						$(this.$el).find('option').remove();

						apiAxios
							.get(this.feed.getUri + '/' + this.value)
							.then(response => {
								this.currentOptions = [{
									id: this.value,
									text: response.data.data[this.labelProp],
								}];
								this.initWithDefaultValueFromAjax();
							})
							.catch(error => {
								this.$root.axiosError(error);
							});

						return;
					}
				}

				$(this.$el).val(value).trigger('change');
			},

			options: function (options) {
				//console.log('trig options watch', options);

				// Initial options
				var oldValue = this.value;
				var oldValueFound = false;
				this.currentOptions = [];
				if (this.options.length > 0) {
					this.options.forEach((option) => {
						if (option[this.valueProp] == oldValue) {
							oldValueFound = true;
						}
						this.currentOptions.push({
							id: option[this.valueProp],
							text: option[this.labelProp],
						})
					});
				}

				$(this.$el).select2().empty();
				$(this.$el).select2('destroy');
				$(this.$el).find('option').remove();

				// Select first option in this case
				if (!oldValueFound && (this.currentOptions.length > 0)) {
					//this.value = this.currentOptions[0].id;
				}

				this.init();
			}
		},
		mounted() {
			//console.log('trig mounted');

			// Initial options
			if (this.options.length > 0) {
				this.options.forEach((option) => {
					this.currentOptions.push({
						id: option[this.valueProp],
						text: option[this.labelProp],
					})
				});
			}

			this.init();
		},
		destroyed() {
			//console.log('trig destroyed');
		},
		methods : {
			initWithDefaultValueFromAjax() {
				//console.log('init with default value form ajax');
				//console.log(this.currentOptions);

				var config = {};

				config.data = this.currentOptions;

				// Ajax feed
				if (this.feed.getUri != null) {
					config.ajax = {
						url: this.feed.getUri,
						delay : 250,
						data: (params) => {
							var query = {
								page: 1,
								limit: this.feed.limit,
								order_by: this.feed.order_by
							}

							if (params.term) {
								query.search = params.term + '*';
							}

							if (params.page) {
								query.page = params.page;
							}

							return query;
						},
						transport: (params, success, failure) => {
							var config = {
								params: params.data
							};
							apiAxios
								.get(this.feed.getUri, config)
								.then(success)
								.catch(failure);
						},
						processResults: (data, params) => {
							var results = [];
							data.data.data.forEach((row) => {
								results.push({
									id : row[this.valueProp],
									text : row[this.labelProp],
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

				//console.log('config', config);

				$(this.$el).select2(config);

				// Default value
				if (this.value != null) {
					$(this.$el).val(this.value).trigger('change');
				}

				$(this.$el).on('change', (evt) => {
					//this.value = evt.target.value;
					this.$emit('input', evt.target.value);
				});
			},

			init() {
				//console.log('init');
				var config = {};

				// Default value
				if (this.value != null) {
					if (this.labelProp == this.valueProp) {
						if (this.options.length == 0) {
							this.currentOptions = [{
								id: this.value,
								text: this.value,
							}];
						}
					} else if (this.feed.getUri != null) {
						apiAxios
							.get(this.feed.getUri + '/' + this.value)
							.then(response => {
								this.currentOptions = [{
									id: this.value,
									text: response.data.data[this.labelProp],
								}];
								this.initWithDefaultValueFromAjax();
							})
							.catch(error => {
								this.$root.axiosError(error);
							});

						return;
					}
				}

				config.data = this.currentOptions;

				// Ajax feed
				if (this.feed.getUri != null) {
					config.ajax = {
						url: this.feed.getUri,
						delay : 250,
						data: (params) => {
							var query = {
								page: 1,
								limit: this.feed.limit,
								order_by: this.feed.order_by
							}

							if (params.term) {
								query.search = params.term + '*';
							}

							if (params.page) {
								query.page = params.page;
							}

							return query;
						},
						transport: (params, success, failure) => {
							var config = {
								params: params.data
							};
							apiAxios
								.get(this.feed.getUri, config)
								.then(success)
								.catch(failure);
						},
						processResults: (data, params) => {
							var results = [];
							data.data.data.forEach((row) => {
								results.push({
									id : row[this.valueProp],
									text : row[this.labelProp],
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

				//console.log('config', config);

				$(this.$el).select2(config);

				// Default value
				if (this.value != null) {
					$(this.$el).val(this.value).trigger('change');
				}

				$(this.$el).on('change', (evt) => {
					//this.value = evt.target.value;
					this.$emit('input', evt.target.value);
				});
			}
		}
	}
</script>