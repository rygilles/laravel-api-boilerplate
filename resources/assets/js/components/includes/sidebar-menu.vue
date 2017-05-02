<template>
	<div>
		<!-- Developer menu -->
		<ul v-if="me.user_group_id == 'Developer'" class="sidebar-menu">
			<li class="pageLink" v-on:click="toggleMenu">
				<router-link to="/"><i class="fa fa-desktop"></i>
					<span class="page">{{ $t('routes.home.title') }}</span>
				</router-link>
			</li>
			<li class="treeview">
				<a href="javascript:;">
					<i class="fa fa-folder"></i>
					<span>{{ $t('routes.projects-folder.title ') }}</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li v-on:click="toggleMenu">
						<router-link :to="{ name: 'user-projects' }"><i class="fa fa-table"></i>
							<span class="page">{{ $t('routes.user-projects.title ') }}</span>
						</router-link>
					</li>
					<li v-on:click="toggleMenu">
						<router-link :to="{ name: 'all-projects' }"><i class="fa fa-table"></i>
							<span class="page">{{ $t('routes.all-projects.title ') }}</span>
						</router-link>
					</li>
				</ul>
			</li>
			<li class="treeview">
				<a href="javascript:;">
					<i class="fa fa-folder"></i>
					<span>{{ $t('routes.misc-folder.title ') }}</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li v-on:click="toggleMenu">
						<router-link :to="{ name: 'i18n-langs' }"><i class="fa fa-table"></i>
							<span class="page">{{ $t('routes.i18n-langs.title ') }}</span>
						</router-link>
					</li>
				</ul>
			</li>
		</ul>
		<!-- Support menu -->
		<ul v-if="me.user_group_id == 'Support'" class="sidebar-menu">
			<li class="pageLink" v-on:click="toggleMenu">
				<router-link to="/"><i class="fa fa-desktop"></i>
					<span class="page">{{ $t('routes.home.title') }}</span>
				</router-link>
			</li>
			<li class="treeview">
				<a href="javascript:;">
					<i class="fa fa-folder"></i>
					<span>{{ $t('routes.projects-folder.title ') }}</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li v-on:click="toggleMenu">
						<router-link :to="{ name: 'user-projects' }"><i class="fa fa-table"></i>
							<span class="page">{{ $t('routes.user-projects.title ') }}</span>
						</router-link>
					</li>
					<li v-on:click="toggleMenu">
						<router-link :to="{ name: 'all-projects' }"><i class="fa fa-table"></i>
							<span class="page">{{ $t('routes.all-projects.title ') }}</span>
						</router-link>
					</li>
				</ul>
			</li>
		</ul>
		<!-- End-User menu -->
		<ul v-if="me.user_group_id == 'End-User'" class="sidebar-menu">
			<li class="pageLink" v-on:click="toggleMenu">
				<router-link to="/"><i class="fa fa-desktop"></i>
					<span class="page">{{ $t('routes.home.title') }}</span>
				</router-link>
			</li>
			<li class="pageLink" v-on:click="toggleMenu">
				<router-link :to="{ name: 'user-projects' }"><i class="fa fa-table"></i>
					<span class="page">{{ $t('routes.user-projects.title ') }}</span>
				</router-link>
			</li>
		</ul>
	</div>
</template>
<script>
	export default {
		name: 'SidebarName',
		props: ['me'],
		methods: {
			toggleMenu (event) {
				// remove active from li
				var active = document.querySelector('li.pageLink.active')

				if (active) {
					active.classList.remove('active')
				}
				// window.$('li.pageLink.active').removeClass('active')
				// Add it to the item that was clicked
				event.toElement.parentElement.className = 'pageLink active'
			}
		}
	}
</script>
<style>
	/* override default */
	.sidebar-menu>li>a {
		padding: 12px 15px 12px 15px;
	}

	.sidebar-menu li.active>a>.fa-angle-left, .sidebar-menu li.active>a>.pull-right-container>.fa-angle-left {
		animation-name: rotate;
		animation-duration: .2s;
		animation-fill-mode: forwards;
	}

	@keyframes rotate {
		0% {
			transform: rotate(0deg);
		}

		100% {
			transform: rotate(-90deg);
		}
	}
</style>