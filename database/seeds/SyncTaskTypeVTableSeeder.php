<?php

use App\Models\SyncTaskTypeVersion;
use Illuminate\Database\Seeder;

class SyncTaskTypeVTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    // Main

	    SyncTaskTypeVersion::create([
		    'sync_task_type_id' => 'Main',
		    'i18n_lang_id'      => 'en_US',
		    'description'       => 'Main task who rules and manage subtasks.'
	    ]);

	    SyncTaskTypeVersion::create([
		    'sync_task_type_id' => 'Main',
		    'i18n_lang_id'      => 'fr_FR',
		    'description'       => 'Tâche principale qui règle et gère les sous-tâches.'
	    ]);

	    // DataStreamDownload

	    SyncTaskTypeVersion::create([
		    'sync_task_type_id' => 'DataStreamDownload',
		    'i18n_lang_id'      => 'en_US',
		    'description'       => 'Downloading the provided data feed url of the data stream.'
	    ]);

	    SyncTaskTypeVersion::create([
		    'sync_task_type_id' => 'DataStreamDownload',
		    'i18n_lang_id'      => 'fr_FR',
		    'description'       => 'Téléchargement des données fournies par l\'url du flux de données.'
	    ]);

	    // DataStreamCheck

	    SyncTaskTypeVersion::create([
		    'sync_task_type_id' => 'DataStreamCheck',
		    'i18n_lang_id'      => 'en_US',
		    'description'       => 'Comparison and verification of downloaded data.'
	    ]);

	    SyncTaskTypeVersion::create([
		    'sync_task_type_id' => 'DataStreamCheck',
		    'i18n_lang_id'      => 'fr_FR',
		    'description'       => 'Comparaison et vérification des données téléchargées.'
	    ]);

	    // DataStreamPrepare

	    SyncTaskTypeVersion::create([
		    'sync_task_type_id' => 'DataStreamPrepare',
		    'i18n_lang_id'      => 'en_US',
		    'description'       => 'Data breakdown for creation, edition or deletion.'
	    ]);

	    SyncTaskTypeVersion::create([
		    'sync_task_type_id' => 'DataStreamPrepare',
		    'i18n_lang_id'      => 'fr_FR',
		    'description'       => 'Ventilation des données pour la création, modification ou suppression.'
	    ]);

	    // ItemsInsertion

	    SyncTaskTypeVersion::create([
		    'sync_task_type_id' => 'ItemsInsertion',
		    'i18n_lang_id'      => 'en_US',
		    'description'       => 'Creating new records.'
	    ]);

	    SyncTaskTypeVersion::create([
		    'sync_task_type_id' => 'ItemsInsertion',
		    'i18n_lang_id'      => 'fr_FR',
		    'description'       => 'Création des nouveaux enregistrements.'
	    ]);

	    // ItemsUpdate

	    SyncTaskTypeVersion::create([
		    'sync_task_type_id' => 'ItemsUpdate',
		    'i18n_lang_id'      => 'en_US',
		    'description'       => 'Updating records.'
	    ]);

	    SyncTaskTypeVersion::create([
		    'sync_task_type_id' => 'ItemsUpdate',
		    'i18n_lang_id'      => 'fr_FR',
		    'description'       => 'Modification des enregistrements.'
	    ]);

	    // ItemsDelete

	    SyncTaskTypeVersion::create([
		    'sync_task_type_id' => 'ItemsDelete',
		    'i18n_lang_id'      => 'en_US',
		    'description'       => 'Deleting records.'
	    ]);

	    SyncTaskTypeVersion::create([
		    'sync_task_type_id' => 'ItemsDelete',
		    'i18n_lang_id'      => 'fr_FR',
		    'description'       => 'Suppression d\'enregistrements.'
	    ]);
    }
}
