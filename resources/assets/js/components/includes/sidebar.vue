<template>
	<aside class="main-sidebar">

		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">

			<!-- Sidebar user panel (optional) -->
			<div class="user-panel">
				<div class="pull-left image">
					<v-gravatar :email="me.email" default-img="mm" :size="45" />
				</div>
				<div class="pull-left info">
					<div>
						<p class="white">{{ me.name }}</p>
					</div>
					<a href="javascript:;">
						<i class="fa fa-circle text-success"></i> {{ $t('sidebar.online') }}
					</a>
				</div>
			</div>

			<!-- Sidebar Menu -->
			<sidebar-menu :me="me" />
			<!-- /.sidebar-menu -->
		</section>
		<!-- /.sidebar -->
	</aside>
</template>
<script>
	import SidebarMenu from './sidebar-menu'

	export default {
		name: 'Sidebar',
		props: ['me'],
		components: { SidebarMenu },
	}
</script>
<style>
	.user-panel .image img {
		border-radius: 50%;
	}
</style>