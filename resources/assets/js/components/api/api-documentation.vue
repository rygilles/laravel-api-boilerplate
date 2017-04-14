<template>
	<div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div style="display: flex; justify-content: space-between; align-items: center;">
                    <span>
                        {{ $t('api.documentation.title') }}
                    </span>
				</div>
			</div>

			<div class="panel-body">
				<!-- Current Clients -->
				<p class="m-b-none">
					{{ $t('api.documentation.description', { userGroup : $root.me.user_group_id }) }} :<br />
					<a v-bind:href="$root.apiDocBaseUrl + '/' + $root.me.user_group_id  + '/' + $root.apiDocVersionUri">
						{{ $root.apiDocBaseUrl + '/' + $root.me.user_group_id  + '/' + $root.apiDocVersionUri }}
					</a>
				</p>
			</div>
		</div>
	</div>
</template>