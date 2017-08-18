<style lang="scss">
	@import './../sass/widget.scss';
</style>
<template>
	<div class="container">
		<div class="row">
			<div class="col-6">
				<div class="Typeahead">
					<!-- optional indicators -->
					<i class="fa fa-spinner fa-spin" v-if="loading"></i>
					<template v-else>
						<i class="fa fa-search" v-show="isEmpty"></i>
						<i class="fa fa-times" v-show="isDirty" @click="reset"></i>
					</template>

					<!-- the input field -->
					<input class="Typeahead__input"
						   type="text"
						   placeholder="..."
						   autocomplete="off"
						   v-model="query"
						   @keydown.down="down"
						   @keydown.up="up"
						   @keydown.enter="hit"
						   @keydown.esc="reset"
						   @blur="reset"
						   @input="update"/>

					<!-- the list -->
					<ul v-show="hasItems">
						<li v-for="(item, $item) in items" :class="activeClass($item)" @mousedown="hit" @mousemove="setActive($item)">
							<span v-text="item.title_fr"></span>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import VueTypeahead from 'vue-typeahead'

	export default {
		extends: VueTypeahead,

		created() {
			this.$http = apiAxios;
		},

		data () {
			return {
				// The source url
				// (required)
				src: 'searchUseCase/<!-- @widget_setting(search_use_case_id) -->/search',

				// The data that would be sent by request
				// (optional)
				data: {
					i18n_lang_id: '<!-- @widget_setting(request_lang) -->',
					page: 1,
					limit: 5
				},

				// Limit the number of items which is shown at the list
				// (optional)
				limit: 5,

				// The minimum character length needed before triggering
				// (optional)
				minChars: 3,

				// Highlight the first item in the list
				// (optional)
				selectFirst: false,

				// Override the default value (`q`) of query parameter name
				// Use a falsy value for RESTful query
				// (optional)
				queryParamName: 'query_string'
			}
		},

		methods: {
			update () {
				this.cancel()

				if (!this.query) {
					return this.reset()
				}

				if (this.minChars && this.query.length < this.minChars) {
					return
				}

				this.loading = true

				this.fetch().then((response) => {
					if (response && this.query) {
						let data = response.data.data
						data = this.prepareResponseData ? this.prepareResponseData(data) : data
						this.items = this.limit ? data.slice(0, this.limit) : data
						this.current = -1
						this.loading = false

						if (this.selectFirst) {
							this.down()
						}
					}
				})
			},

			// The callback function which is triggered when the user hits on an item
			// (required)
			onHit (item) {
				window.location.href = item['url_<!-- @widget_setting(request_lang) -->'];
			},

			// The callback function which is triggered when the response data are received
			// (optional)
			prepareResponseData (data) {
				// data = ...
				return data
			}
		}
	}
</script>