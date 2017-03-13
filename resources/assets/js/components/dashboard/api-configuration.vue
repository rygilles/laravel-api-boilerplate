<template>
	<div>
		<passport-clients></passport-clients>
		<passport-authorized-clients></passport-authorized-clients>
		<passport-personal-access-tokens></passport-personal-access-tokens>
	</div>
</template>

<script>
	import passportClients from '../passport/Clients.vue';
	import passportAuthorizedClients from '../passport/AuthorizedClients.vue';
	import passportPersonalAccessTokens from '../passport/PersonalAccessTokens.vue';

	export default {
		components: {
			passportClients,
			passportAuthorizedClients,
			passportPersonalAccessTokens
		}
	}
</script>