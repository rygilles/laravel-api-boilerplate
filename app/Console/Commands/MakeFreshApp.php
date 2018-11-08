<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MakeFreshApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:makeFresh
                            {--noDown : Disable auto shut down and up of laravel during the setup process}
                            {--noInteraction : Disable interactions and auto-validate confirm steps }
                            {--noPassport : Disable passport package install (If --noInteraction arg is set) }
                            {--seedWithSamples : Seed with samples (If --noInteraction arg is set) }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will reset/refresh migrations, '.
                              're-create required database data and (optionally) '.
                              'create a fresh app with samples data.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $noDown = $this->option('noDown');
        $noInteraction = $this->option('noInteraction');
        $noPassport = $this->option('noPassport');
        $seedWithSamples = $this->option('seedWithSamples');

        $this->info('LaravelApiBoilerplate Setup : Fresh App (For DEV purpose only !)');
        $this->info('(Ask to ryan@e-monsite.com for more information)');
        $this->warn('');
        $this->warn('This command will refresh migrations, '."\n".
                    're-create required database data and (optionally) '."\n".
                    'create a fresh app with samples data.');

        $confirm = true;
        if (! $noInteraction) {
            $confirm = $this->confirm('Do you wish to continue ?', false);
        }

        if ($confirm) {
            $this->info('Refresh migrations');

            if (! $noDown) {
                // Turn down the app (to prevent cron/jobs execution)
                Artisan::call('down', [], $this->getOutput());
            }

            Artisan::call('migrate:refresh', [], $this->getOutput());
            if ($noInteraction) {
                Artisan::call('migrate:refresh', [
                        '--no-interaction' => true,
                        '--force' => true,
                    ], $this->getOutput()
                );
            } else {
                Artisan::call('migrate:refresh', [], $this->getOutput());
            }

            // Initialize with required data
            $this->info('Initialize with required data seeder');
            Artisan::call('db:seed', ['--class' => 'InitSeeder'], $this->getOutput());

            if (! $noInteraction) {
                if ($this->confirm('Run Passport install ? (highly recommended ! generate required app clients)', true)) {
                    Artisan::call('passport:install', [], $this->getOutput());
                }
            } else {
                if (! $noPassport) {
                    Artisan::call('passport:install', [], $this->getOutput());
                }
            }
            if (! $noInteraction) {
                if ($this->confirm('Do you want to seed your application with some samples data ?', false)) {
                    // Seed with samples data
                    $this->info('Seed with samples data');
                    Artisan::call('db:seed', ['--class' => 'SamplesSeeder'], $this->getOutput());
                }
            } else {
                if ($seedWithSamples) {
                    $this->info('Seed with samples data');
                    Artisan::call('db:seed', ['--class' => 'SamplesSeeder'], $this->getOutput());
                }
            }

            if (! $noDown) {
                // Turn up back the app
                Artisan::call('up', [], $this->getOutput());
            }

            $this->info('Your application is ready now.');
        } else {
            $this->info('Ok, nothing changes');
        }
    }
}
