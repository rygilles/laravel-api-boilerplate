<template>
	<div id="widget">
		<p>This is a VueJs Widget !</p>
	</div>
</template>
<script>
	export default {
		created() {
			this.fetchData();
		},
		methods: {
			fetchData() {
				this.performSearch();
			},
			performSearch() {
				let params = {
					query_string: 'site internet',
					i18n_lang_id: 'fr',
					page: 1,
					limit: 5
				}
				apiAxios.get('searchUseCase/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0/search', {params})
						.then((response) => {
							console.log(response);
						}).catch(error => {
							console.log(error);
						});
			},
		}
	}
</script>