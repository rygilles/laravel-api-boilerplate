<style scoped>
	.action-link {
		cursor: pointer;
	}
</style>

<template>
	<div v-if="$root.fetched">
		<div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<span>
							{{ $t('i18n_langs.i18n_langs') }}
						</span>
					</div>
				</div>

				<div class="panel-body">

					<p>Test...</p>

				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'I18nLang',

		/**
		 * The component's data.
		 */
		data() {
			return {
				project: null
			};
		},
	}
</script>
