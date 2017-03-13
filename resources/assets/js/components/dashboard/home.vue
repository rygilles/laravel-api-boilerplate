<template>
	<div class="panel panel-default">
		<div class="panel-heading">{{ $t('home.dashboard') }}</div>

		<div class="panel-body">
			{{ $t('home.welcome', { name : $root.me.name }) }}
		</div>
	</div>
</template>