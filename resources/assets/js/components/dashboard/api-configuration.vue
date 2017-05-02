<style>
	.action-link {
		cursor: pointer;
	}
</style>

<template>
	<!-- Main content -->
	<section class="content">
		<passport-clients></passport-clients>
		<passport-authorized-clients></passport-authorized-clients>
		<passport-personal-access-tokens></passport-personal-access-tokens>
		<api-documentation :laravel="laravel" :me="me"></api-documentation>
	</section>
</template>

<script>
	import passportClients from '../passport/Clients.vue';
	import passportAuthorizedClients from '../passport/AuthorizedClients.vue';
	import passportPersonalAccessTokens from '../passport/PersonalAccessTokens.vue';
	import apiDocumentation from '../api/api-documentation.vue';

	export default {
		components: {
			passportClients,
			passportAuthorizedClients,
			passportPersonalAccessTokens,
			apiDocumentation,
		},
		props : ['laravel', 'me']
	}
</script>