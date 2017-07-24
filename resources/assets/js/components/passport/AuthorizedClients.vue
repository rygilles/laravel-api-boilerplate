<template>
	<div>
		<div class="row" v-if="tokens.length > 0">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">{{ $t('auth.authorized_applications.title') }}</h3>
					</div>
					<div class="overlay" v-if="loading_tokens">
						<i class="fa fa-refresh fa-spin"></i>
					</div>
					<div class="box-body" v-if="!loading_tokens">
						<div class="dataTables_wrapper form-inline dt-bootstrap">
							<div class="row">
								<div class="col-sm-6">
									<div class="dataTables_length">

									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-12 table-responsive">
									<table aria-describedby="example1_info" role="grid" class="table table-bordered table-striped dataTable">
										<thead>
										<tr role="row">
											<th>{{ $t('auth.authorized_applications.name') }}</th>
											<th>{{ $t('auth.authorized_applications.scopes') }}</th>
											<th></th>
										</tr>
										</thead>
										<tbody>

										<tr v-for="token in tokens">
											<!-- Client Name -->
											<td class="col-md-3" style="vertical-align: middle;">
												{{ token.client.name }}
											</td>

											<!-- Scopes -->
											<td class="col-md-4 text-center" style="vertical-align: middle;">
												<span v-if="token.scopes.length > 0">
													{{ token.scopes.join(', ') }}
												</span>
											</td>

											<!-- Revoke Button -->
											<td class="col-md-1 text-right" style="vertical-align: middle;">
												<a class="action-link btn btn-danger" @click="revoke(token)">
													{{ $t('auth.authorized_applications.revoke') }}
												</a>
											</td>
										</tr>

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        /*
         * The component's data.
         */
        data() {
            return {
                tokens: [],
				loading_tokens: true,
            };
        },

        /**
         * Prepare the component (Vue 1.x).
         */
        ready() {
            this.prepareComponent();
        },

        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.prepareComponent();
        },

        methods: {
            /**
             * Prepare the component (Vue 2.x).
             */
            prepareComponent() {
                this.getTokens();
            },

            /**
             * Get all of the authorized tokens for the user.
             */
            getTokens() {
				this.loading_tokens = true;
                oauthAxios.get('/oauth/tokens')
					.then(response => {
						this.tokens = response.data;
						this.loading_tokens = false;
					}).catch(error => {
						this.$root.axiosError(error);
					});
            },

            /**
             * Revoke the given token.
             */
            revoke(token) {
                oauthAxios.delete('/oauth/tokens/' + token.id)
					.then(response => {
						this.getTokens();
					}).catch(error => {
						this.$root.axiosError(error);
					});
            }
        }
    }
</script>
