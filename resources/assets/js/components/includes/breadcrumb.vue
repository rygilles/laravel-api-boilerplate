<template>
	<ol class="breadcrumb">
		<li v-for="r in routes">
			<router-link :to="{ name: r.name }">
				<i v-if="('meta' in r) && ('breadcrumbIconClass' in r.meta)" :class="[r.meta.breadcrumbIconClass]"></i><span v-html="routeTitle(r.name)"></span>
			</router-link>
		</li>
	</ol>
</template>

<script>
	export default {
		name:'breadcrumb',
		props: [
			'route'
		],
		computed: {
			routes() {
				var routes = this.recurParentRoute(this.route);
				return routes;
			},
			ownerProjectsMainTitle() {
				return this.$i18n.t('projects.owner_projects');
			},
		},
		methods: {
			routeTitle(routeName) {
				return this.$i18n.t('routes.' + routeName + '.title');
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