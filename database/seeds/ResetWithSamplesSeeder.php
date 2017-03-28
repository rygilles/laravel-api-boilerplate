<?php

use Illuminate\Database\Seeder;

class ResetWithSamplesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset all tables

	    $this->command->warn('Reseting all tables !');
	    $this->call(ResetTables::class);

        // Initialize with required data

	    $this->command->info('Initialize with required data');
	    $this->call(InitSeeder::class);

        // Seed with samples data

	    $this->command->info('Seed with samples data');
	    $this->call(SamplesSeeder::class);
    }
}
