<template>
	<ol class="breadcrumb">
		<li v-for="(r, routeIndex) in routes">
			<router-link :to="{ name: r.name }">
				<i v-if="('meta' in r) && ('breadcrumbIconClass' in r.meta)" :class="[r.meta.breadcrumbIconClass]"></i><span v-html="routeTitle(r.name, routeIndex)"></span>
			</router-link>
		</li>
	</ol>
</template>

<script>
	export default {
		name:'breadcrumb',
		props: {
			route : {},
			endRouteTitleData: {},
		},
		computed: {
			routes() {
				var routes = this.recurParentRoute(this.route);
				return routes;
			},
		},
		methods: {
			routeTitle(routeName, routeIndex) {
				// Use route title template if available (only for the end/current real route !)
				if ((routeIndex == (this.routes.length - 1)) && this.$i18n._exist(this.$i18n.messages[this.$i18n.locale], 'routes.' + routeName + '.title_template')) {
					// Compute the template with routeTitleData (catched through "routeTitleDataUpdate" event on child <router-view>)
					var compiledTitleTemplate = _.template(this.$i18n.t('routes.' + routeName + '.title_template'));
					return compiledTitleTemplate({'data' : this.endRouteTitleData});
				} else if (this.$i18n._exist(this.$i18n.messages[this.$i18n.locale], 'routes.' + routeName + '.title')) {
					// use title insteed if available
					return this.$i18n.t('routes.' + routeName + '.title');
				} else {
					// use the translation path insteed
					return 'routes.' + routeName + '.title_template | routes.' + routeName + '.title';
				}
			},
			recurParentRoute(route) {
				var routes = [];

				if ('meta' in route)
				{
					if ('parentRouteName' in route.meta) {
						var otherRoutes = this.recurParentRoute(this.resolveNamedRoute(route.meta.parentRouteName));
						otherRoutes.forEach((r) => {
							routes.push(r);
						});
					}
				}

				routes.push(route);

				return routes;
			},
			resolveNamedRoute(routeName) {
				var r = null;

				this.$router.options.routes.forEach((route) => {
					if (route.name == routeName) {
						r = route;
					}
				});

				if (r != null) {
					return r;
				}

				console.log('Breadcrumb : No parent "' + routeName + '" route found')
			}
		}
	}
</script>