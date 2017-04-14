<?php

use App\Models\SyncTaskStatusVersion;
use Illuminate\Database\Seeder;

class SyncTaskStatusVTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    // Planned

	    SyncTaskStatusVersion::create([
		    'sync_task_status_id' => 'Planned',
		    'i18n_lang_id'      => 'en_US',
		    'description'       => 'Items synchronization is planned.'
	    ]);

	    SyncTaskStatusVersion::create([
		    'sync_task_status_id' => 'Planned',
		    'i18n_lang_id'      => 'fr_FR',
		    'description'       => 'La synchronisation des items est plannifiée'
	    ]);

	    // InProgress

	    SyncTaskStatusVersion::create([
		    'sync_task_status_id' => 'InProgress',
		    'i18n_lang_id'      => 'en_US',
		    'description'       => 'Items synchronization is in progress.'
	    ]);

	    SyncTaskStatusVersion::create([
		    'sync_task_status_id' => 'InProgress',
		    'i18n_lang_id'      => 'fr_FR',
		    'description'       => 'La synchronisation des items est en cours.'
	    ]);

	    // Complete

	    SyncTaskStatusVersion::create([
		    'sync_task_status_id' => 'Complete',
		    'i18n_lang_id'      => 'en_US',
		    'description'       => 'Items synchronization is complete.'
	    ]);

	    SyncTaskStatusVersion::create([
		    'sync_task_status_id' => 'Complete',
		    'i18n_lang_id'      => 'fr_FR',
		    'description'       => 'La synchronisation des items est terminée'
	    ]);
    }
}
