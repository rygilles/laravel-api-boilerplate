<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GenerateApiDocs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generateApiDocs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate API documentation using current database resources.';

	protected $actAsUserId = '';
	
	/**
	 * Bindings.
	 *
	 * @see SamplesSeeder
	 * @var string[]
	 */
	protected $bindings = [
		// John Smith Sample Project 1
		'project' => '1bcc7efc-138c-11e7-93ae-92361f002671'
	];

	/**
	 * Create a new command instance.
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
        $this->info('EMSEARCH Tools : Generate Api Documentation (For DEV purpose only !)');
        $this->info('(Ask to ryan@e-monsite.com for more information)');
        $this->info('');

	    $profiles = config('apidocs.profiles');

	    $possibleProfiles = array_keys($profiles);

	    $profileName = $this->choice('For which profile ?', $possibleProfiles);
	    $profile = $profiles[$profileName];

        $routePrefix = $this->ask('For which route prefix version ?', $profile['defaultRoutePrefix']);
	    $outputPath = $profile['outputPathBase'] . DIRECTORY_SEPARATOR . $routePrefix;

	    $bindingsArgument = '';

	    foreach ($profile['bindings'] as $bindingName => $bindingValue) {
		    $bindingsArgument .= $bindingName . ',' . $bindingValue . '|';
	    }
	    $bindingsArgument = rtrim($bindingsArgument, '|');

	    $routesPreview = implode(', ', $profile['routes']);

	    $this->info('This script will generate the documentation using this parameters :');

	    $this->info('Output path : ' . $outputPath);
	    $this->info('Routes : ' . ($routesPreview ? $routesPreview : 'Not specified'));
	    $this->info('Act as User ID : ' . $profile['actAsUserId']);
	    $this->info('Bindings : ' . ($bindingsArgument ? $bindingsArgument : 'Not specified'));

	    if ($this->confirm('Do you wish to continue ?', true)) {
		    $this->info('Generate Api documentation');

		    $commandParameters = [
			    '--router' => 'dingo',
			    '--routePrefix' => $routePrefix,
			    '--output' => $outputPath,
			    '--actAsUserId' => $profile['actAsUserId'],
			    '--force' => ''
		    ];

		    if ($profile['bindings']) {
			    $commandParameters['--bindings'] = $bindingsArgument;
		    }

		    if ($profile['routes']) {
			    $commandParameters['--routes'] = $profile['routes'];
		    }

		    Artisan::call('api:generate', $commandParameters);
	    } else {
		    $this->info('Ok, nothing changes');
	    }
    }
}
