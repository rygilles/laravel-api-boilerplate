<template>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">{{ $t('home.dashboard') }}</h3>
					</div>
					<div class="box-body">
						<p>{{ $t('home.welcome', { name : $root.me.name }) }}</p>
					</div>
				</div>
			</div>
		</div>
		<ProjectCreateWizard></ProjectCreateWizard>
		<div v-if="(['Developer', 'Support'].indexOf(this.$store.getters.me.user_group_id) != -1)" class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Sync. Tasks Logs Created Events in Real Time ! (WIP)</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<textarea class="form-control" rows="15" readonly style="font-family: 'Courier New',Monospace; font-size: 12px" v-html="syncTaskLogCreatedEventsEntries"></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	import ProjectCreateWizard from '../includes/project-create-wizard'

	export default {
		name: 'Home',

		components: { ProjectCreateWizard },

		data() {
			return {
				'syncTaskLogCreatedEvents': []
			}
		},

		props: {

		},

		/**
		 * Component created
		 */
		created() {
			// fetch the data when the view is created and the data is
			// already being observed
			this.fetchData();
		},

		/**
		 * Component watcher
		 */
		watch: {
			// call again the method if the route changes
			'$route': 'fetchData'
		},

		methods: {
			fetchData() {
				this.listenForAdminEvents();
			},

			listenForAdminEvents() {
				Echo.private('AdminChan')
					.listen('SyncTaskLogCreatedEvent', (e) => {
						this.syncTaskLogCreatedEvents.push(e);
					});
			},
		},

		computed: {
			syncTaskLogCreatedEventsEntries() {
				var lines = '';
				this.syncTaskLogCreatedEvents.forEach((e, index) => {
					if (e.sync_task_type_id == 'Main') {
						lines += '[Main Task "' + e.sync_task_id +  '"] : "' + e.sync_task_type_id + '" : ' + e.entry + "\n";
					} else {
						lines += '[Main Task "' + e.main_sync_task_id +  '" - Sub Task "' + e.sync_task_id + '"] : "' + e.sync_task_type_id + '" : ' + e.entry + "\n";
					}
				});
				return lines;
			}
		}
	}
</script>