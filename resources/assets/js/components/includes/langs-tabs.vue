<template>
	<li class="btn-group dropdown langs-tabs-menu">
		<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
			<span class="lang-sm lang-lbl" :lang="currentLang"></span>
		</a>
		<ul class="dropdown-menu" role="menu">
			<li v-for="lang in langs">
				<a href="javascript:;" @click="selectLang(lang)">
					<span class="lang-sm lang-lbl" :lang="lang"></span>
				</a>
			</li>
		</ul>
	</li>
</template>

<script>
	export default {
		name: 'LangsTabs',

		props: {
			langs: {
				type: Array,
				default: function() {
					return [
						'en',
						'fr',
					]
				}
			},
			defaultLang: {
				type: String,
				default: 'en',
			}
		},

		data() {
			return {
				currentLang: 'en',
			};
		},

		mounted() {
			this.currentLang = this.defaultLang;
		},

		methods: {
			selectLang(lang) {
				// @todo Cookie save !
				window.changeLang(lang);
				this.currentLang = lang;
			}
		},
	}
</script>