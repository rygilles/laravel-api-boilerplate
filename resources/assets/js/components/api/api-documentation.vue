<template>
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">{{ $t('api.documentation.title') }}</h3>
				</div>
				<div class="box-body">
					<p class="m-b-none">
						{{ $t('api.documentation.description', { userGroup : $root.me.user_group_id }) }} :<br />
						<a v-bind:href="$root.apiDocBaseUrl + '/' + $root.me.user_group_id  + '/' + $root.apiDocVersionUri">
							{{ $root.apiDocBaseUrl + '/' + $root.me.user_group_id  + '/' + $root.apiDocVersionUri }}
						</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</template>