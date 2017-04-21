<template>
	<div>
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">{{ $t('auth.personal_access_tokens.title') }}</h3>
						<a class="action-link pull-right" @click="showCreateTokenForm">
							{{ $t('auth.personal_access_tokens.create_new_token') }}
						</a>
					</div>
					<div class="overlay" v-if="loading_pat || loading_scopes">
						<i class="fa fa-refresh fa-spin"></i>
					</div>
					<div class="box-body" v-if="!loading_pat && !loading_scopes">
						<p class="m-b-none" v-if="tokens.length === 0">
							{{ $t('auth.personal_access_tokens.no_token_yet') }}
						</p>
						<div class="dataTables_wrapper form-inline dt-bootstrap" v-if="tokens.length > 0">
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
											<th>{{ $t('auth.personal_access_tokens.name') }}</th>
											<th></th>
										</tr>
										</thead>
										<tbody>

										<tr v-for="token in tokens">
											<!-- Client Name -->
											<td style="vertical-align: middle;">
												{{ token.name }}
											</td>

											<!-- Delete Button -->
											<td class="col-md-2 text-right"  style="vertical-align: middle;">
												<a class="btn btn-danger action-link" @click="revoke(token)">
													{{ $t('auth.personal_access_tokens.delete') }}
												</a>
											</td>
										</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="box-footer clearfix">
						<ul class="pagination pagination-sm no-margin pull-right">
							<li><a href="#">&laquo;</a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">&raquo;</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- Create Token Modal -->
		<div class="modal fade" id="modal-create-token" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

						<h4 class="modal-title">
							{{ $t('auth.personal_access_tokens_create_modal.title') }}
						</h4>
					</div>

					<div class="modal-body">
						<!-- Form Errors -->
						<div class="alert alert-danger" v-if="form.errors.length > 0">
							<p>{{ $t('auth.personal_access_tokens_create_modal.error') }}</p>
							<br>
							<ul>
								<li v-for="error in form.errors">
									{{ error }}
								</li>
							</ul>
						</div>

						<!-- Create Token Form -->
						<form class="form-horizontal" role="form" @submit.prevent="store">
							<!-- Name -->
							<div class="form-group">
								<label class="col-md-4 control-label">{{ $t('auth.personal_access_tokens_create_modal.name') }}</label>

								<div class="col-md-6">
									<input id="create-token-name" type="text" class="form-control" name="name" v-model="form.name">
								</div>
							</div>

							<!-- Scopes -->
							<div class="form-group" v-if="scopes.length > 0">
								<label class="col-md-4 control-label">{{ $t('auth.personal_access_tokens_create_modal.scopes') }}</label>

								<div class="col-md-6">
									<div v-for="scope in scopes">
										<div class="checkbox">
											<label>
												<input type="checkbox"
													@click="toggleScope(scope.id)"
													:checked="scopeIsAssigned(scope.id)">

													{{ scope.id }}
											</label>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>

					<!-- Modal Actions -->
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">{{ $t('auth.personal_access_tokens_create_modal.close_btn') }}</button>

						<button type="button" class="btn btn-primary" @click="store">
							{{ $t('auth.personal_access_tokens_create_modal.create_btn') }}
						</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Access Token Modal -->
		<div class="modal fade" id="modal-access-token" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

						<h4 class="modal-title">
							{{ $t('auth.personal_access_tokens_access_modal.title') }}
						</h4>
					</div>

					<div class="modal-body">
						<p>
							{{ $t('auth.personal_access_tokens_access_modal.description') }}
						</p>

						<pre><code>{{ accessToken }}</code></pre>
					</div>

					<!-- Modal Actions -->
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">{{ $t('auth.personal_access_tokens_access_modal.close_btn') }}</button>
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
				loading_pat: true,
				loading_scopes: true,

                accessToken: null,

                tokens: [],
                scopes: [],

                form: {
                    name: '',
                    scopes: [],
                    errors: []
                }
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
             * Prepare the component.
             */
            prepareComponent() {
                this.getTokens();
                this.getScopes();

                $('#modal-create-token').on('shown.bs.modal', () => {
                    $('#create-token-name').focus();
                });
            },

            /**
             * Get all of the personal access tokens for the user.
             */
            getTokens() {
				this.loading_pat = true;
                oauthAxios.get('/oauth/personal-access-tokens')
					.then(response => {
						this.tokens = response.data;
						this.loading_pat = false;
					}).catch(error => {
						this.$root.axiosError(error);
					});
            },

            /**
             * Get all of the available scopes.
             */
            getScopes() {
				this.loading_scopes = true;
                oauthAxios.get('/oauth/scopes')
					.then(response => {
						this.scopes = response.data;
						this.loading_scopes = false;
					}).catch(error => {
						this.$root.axiosError(error);
					});
            },

            /**
             * Show the form for creating new tokens.
             */
            showCreateTokenForm() {
                $('#modal-create-token').modal('show');
            },

            /**
             * Create a new personal access token.
             */
            store() {
                this.accessToken = null;

                this.form.errors = [];

                oauthAxios.post('/oauth/personal-access-tokens', this.form)
					.then(response => {
						this.form.name = '';
						this.form.scopes = [];
						this.form.errors = [];

						this.tokens.push(response.data.token);

						this.showAccessToken(response.data.accessToken);
					})
					.catch(error => {
						if (typeof error.response.data === 'object') {
							this.form.errors = _.flatten(_.toArray(error.response.data));
						} else {
							this.$root.axiosError(error);
						}
					});
            },

            /**
             * Toggle the given scope in the list of assigned scopes.
             */
            toggleScope(scope) {
                if (this.scopeIsAssigned(scope)) {
                    this.form.scopes = _.reject(this.form.scopes, s => s == scope);
                } else {
                    this.form.scopes.push(scope);
                }
            },

            /**
             * Determine if the given scope has been assigned to the token.
             */
            scopeIsAssigned(scope) {
                return _.indexOf(this.form.scopes, scope) >= 0;
            },

            /**
             * Show the given access token to the user.
             */
            showAccessToken(accessToken) {
                $('#modal-create-token').modal('hide');

                this.accessToken = accessToken;

                $('#modal-access-token').modal('show');
            },

            /**
             * Revoke the given token.
             */
            revoke(token) {
                oauthAxios.delete('/oauth/personal-access-tokens/' + token.id)
					.then(response => {
						this.getTokens();
					}).catch(error => {
						this.$root.axiosError(error);
					});
            }
        }
    }
</script>
