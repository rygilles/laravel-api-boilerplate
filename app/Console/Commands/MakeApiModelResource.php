<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Composer;

use Twig_Environment;
use Twig_Extension_Debug;
use Twig_TemplateWrapper;
use PhpParser\ParserFactory;
use PhpParser\Parser;
use PhpParser\Node;
use PhpParser\PrettyPrinter;

class MakeApiModelResource extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'app:makeApiModelResource
                            {--testdump : Dump the files insteed of really creating/modifying them}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'This command create a new Api model resource, ' .
							  'with classes : model, migration, seeder, controller, route, etc.';

	/**
	 * Twig templates environment
	 *
	 * @var Twig_Environment
	 */
	protected $twigEnv;

	/**
	 * Twig model class template
	 *
	 * @var Twig_TemplateWrapper
	 */
	protected $modelClassTemplate;

	/**
	 * Twig migration class template
	 *
	 * @var Twig_TemplateWrapper
	 */
	protected $migrationClassTemplate;

	/**
	 * Twig model init seeder class template
	 *
	 * @var Twig_TemplateWrapper
	 */
	protected $modelInitSeederClassTemplate;

	/**
	 * Twig model samples seeder class template
	 *
	 * @var Twig_TemplateWrapper
	 */
	protected $modelSamplesSeederClassTemplate;

	/**
	 * Twig model controller class template
	 *
	 * @var Twig_TemplateWrapper
	 */
	protected $modelControllerClassTemplate;

	/**
	 * Twig model transformer class template
	 *
	 * @var Twig_TemplateWrapper
	 */
	protected $modelTransformerClassTemplate;

	/**
	 * Twig model store request class template
	 *
	 * @var Twig_TemplateWrapper
	 */
	protected $modelStoreRequestClassTemplate;

	/**
	 * Twig model update request class template
	 *
	 * @var Twig_TemplateWrapper
	 */
	protected $modelUpdateRequestClassTemplate;

	/**
	 * The composer instance.
	 *
	 * @var \Illuminate\Support\Composer
	 */
	protected $composer;

	/**
	 * PHP Parser
	 *
	 * @var Parser
	 */
	protected $phpParser;

	/**
	 * Create a new command instance.
	 *
	 * @param Composer $composer
	 */
	public function __construct(Composer $composer)
	{
		parent::__construct();

		$this->composer = $composer;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$this->info('LaravelApiBoilerplate Helpers : Make Api Model Resource (For DEV purpose only !)');
		$this->info('(Ask to ryan@e-monsite.com for more information)');
		$this->warn('');
		$this->warn('This command will create a new Api model resource, ' . "\n" .
					'with classes : model, migration, seeder, controller, route, etc.' . "\n");

		// Check configuration

		$modelsNamespace = 'App\\Models';
		$modelsBasePath = base_path('app' . DIRECTORY_SEPARATOR . 'Models');
		$controllersNamespace = 'App\\Http\\Controllers\\Api';
		$apiRoutesFilePath = base_path('routes' . DIRECTORY_SEPARATOR . 'api.php');

		if (!file_exists($modelsBasePath)) {
			$this->error('Models base path directory (' . $modelsBasePath . ') does not exists !');
			return;
		}

		if (!file_exists($modelsBasePath . DIRECTORY_SEPARATOR . 'ApiModel.php')) {
			$this->error('ApiModel.php file not found in models base path directory (' . $modelsBasePath . ') !');
			return;
		}

		$this->loadTemplates();

		$capitalizedCamelCaseModelName = null;
		while(is_null($capitalizedCamelCaseModelName)) {
			$capitalizedCamelCaseModelName = $this->ask('Enter the model name (in CamelCase)');
			if ($capitalizedCamelCaseModelName != ucfirst(camel_case($capitalizedCamelCaseModelName))) {
				$this->warn('This is not a CamelCase value ! Try again...');
				$capitalizedCamelCaseModelName = null;
			}
		}

		// Check if already exists
		if (file_exists($this->getModelClassFilePath($modelsBasePath, $capitalizedCamelCaseModelName))) {
			$this->error('The file "' . $this->getModelClassFilePath($modelsBasePath, $capitalizedCamelCaseModelName) . '" already exists ! Aborting');
			return;
		}

		$snakeCaseModelName = snake_case($capitalizedCamelCaseModelName);
		$camelCaseModelName = camel_case($snakeCaseModelName);

		$makePrimaryId = $this->confirm('Use primary key "id" field ?', true);

		$usePrimaryKey = false;
		$primaryKeyType = null;
		$primaryKeyStringLength = null;

		if ($makePrimaryId) {
			$usePrimaryKey = true;
			$primaryKeyType = $this->choice('Which "id" type ?', ['uuid', 'string', 'autoincrement'], 0);
			if ($primaryKeyType == 'string') {
				$primaryKeyStringLength = null;
				while(is_null($primaryKeyStringLength)) {
					$primaryKeyStringLength = $this->ask('Enter the string length of your "id" field', 30);
					if (!is_integer($primaryKeyStringLength)) {
						$this->warn('This is not an integer value ! Try again...');
						$primaryKeyStringLength = null;
					}
				}
			}
		}

		$timestamps = $this->confirm('Use timestamps fields ? (created_at, updated_at)', true);

		$makeMigration = $this->confirm('Do you want to generate a migration file for this model ?', true);

		if ($makeMigration) {
			if (file_exists($this->getMigrationClassFilePath($snakeCaseModelName))) {
				$this->warn('The file "' . $this->getMigrationClassFilePath($snakeCaseModelName) . '" already exists !');
				$makeMigration = $this->confirm('Do you want to replace it ?', true);
			}
		}

		$makeInitSeeder = $this->confirm('Do you want to generate a init seeder for this model ?', true);

		if ($makeInitSeeder) {
			if (!file_exists($this->getInitSeederClassFilePath())) {
				$this->error('Can not find the file "' . $this->getInitSeederClassFilePath() . '" ! Aborting.');
				return;
			}

			if (file_exists($this->getModelInitSeederClassFilePath($capitalizedCamelCaseModelName))) {
				$this->warn('The file "' . $this->getModelInitSeederClassFilePath($capitalizedCamelCaseModelName) . '" already exists !');
				$makeInitSeeder = $this->confirm('Do you want to replace it ?', true);
			}
		}

		$makeSamplesSeeder = $this->confirm('Do you want to generate a samples seeder for this model ?', true);

		if ($makeSamplesSeeder) {
			if (!file_exists($this->getSamplesSeederClassFilePath())) {
				$this->error('Can not find the file "' . $this->getSamplesSeederClassFilePath() . '" ! Aborting');
				return;
			}

			if (file_exists($this->getModelSamplesSeederClassFilePath($capitalizedCamelCaseModelName))) {
				$this->warn('The file "' . $this->getModelSamplesSeederClassFilePath($capitalizedCamelCaseModelName) . '" already exists !');
				$makeSamplesSeeder = $this->confirm('Do you want to replace it ?', true);
			}
		}

		$makeController = $this->confirm('Do you want to generate a controller for this model ?', true);

		$makeControllerIndexMethod = false;
		$makeControllerShowMethod = false;
		$makeTransformer = false;
		$updateApiRoutesFile = false;
		$makeStoreRequest = false;
		$makeUpdateRequest = false;

		if ($makeController) {
			if (!file_exists($this->getModelControllersClassesFilesPath() . DIRECTORY_SEPARATOR . 'ApiController.php')) {
				$this->error('ApiController.php file not found in Api controllers base path directory (' . $this->getModelControllersClassesFilesPath() . ') !');
				return;
			}

			if (file_exists($this->getModelControllerClassFilePath($capitalizedCamelCaseModelName))) {
				$this->warn('The file "' . $this->getModelControllerClassFilePath($capitalizedCamelCaseModelName) . '" already exists !');
				$makeController = $this->confirm('Do you want to replace it ?', true);
			}

			$makeControllerIndexMethod = $this->confirm('Do you want to generate a "index" method for the controller ?', true);

			if ($makeControllerIndexMethod) {
				$makeTransformer = true;
				$updateApiRoutesFile = true;
			}

			$makeControllerShowMethod = $this->confirm('Do you want to generate a "show" method for the controller ?', true);

			if ($makeControllerShowMethod) {
				$makeTransformer = true;
				$updateApiRoutesFile = true;
			}

			$makeControllerStoreMethod = $this->confirm('Do you want to generate a "store" method for the controller ?', true);

			if ($makeControllerStoreMethod) {
				$makeTransformer = true;
				$updateApiRoutesFile = true;
				$makeStoreRequest = true;
			}

			$makeControllerUpdateMethod = $this->confirm('Do you want to generate a "update" method for the controller ?', true);

			if ($makeControllerUpdateMethod) {
				$makeTransformer = true;
				$updateApiRoutesFile = true;
				$makeUpdateRequest = true;
			}

			$makeControllerDestroyMethod = $this->confirm('Do you want to generate a "destroy" method for the controller ?', true);

			if ($makeControllerDestroyMethod) {
				$updateApiRoutesFile = true;
			}
		}

		if ($updateApiRoutesFile) {
			if (!file_exists($apiRoutesFilePath)) {
				$this->error($apiRoutesFilePath . ' file not found !');
				return;
			}
		}

		if ($makeTransformer) {
			if (!file_exists($this->getModelTransformersClassesFilesPath() . DIRECTORY_SEPARATOR . 'ApiTransformer.php')) {
				$this->error('ApiTransformer.php file not found in Api transformers base path directory (' . $this->getModelTransformersClassesFilesPath() . ') !');
				return;
			}

			if (file_exists($this->getModelTransformerClassFilePath($capitalizedCamelCaseModelName))) {
				$this->warn('The file "' . $this->getModelTransformerClassFilePath($capitalizedCamelCaseModelName) . '" already exists !');
				$makeTransformer = $this->confirm('Do you want to replace it ?', true);
			}
		}

		if ($makeStoreRequest) {
			if (!file_exists($this->getRequestsClassesFilesPath() . DIRECTORY_SEPARATOR . 'ApiRequest.php')) {
				$this->error('ApiRequest.php file not found in Api transformers base path directory (' . $this->getRequestsClassesFilesPath() . ') !');
				return;
			}

			if (file_exists($this->getRequestClassFilePath($capitalizedCamelCaseModelName, 'Store'))) {
				$this->warn('The file "' . $this->getRequestClassFilePath($capitalizedCamelCaseModelName, 'Store') . '" already exists !');
				$makeStoreRequest = $this->confirm('Do you want to replace it ?', true);
			}
		}

		if ($makeUpdateRequest) {
			if (!file_exists($this->getRequestsClassesFilesPath() . DIRECTORY_SEPARATOR . 'ApiRequest.php')) {
				$this->error('ApiRequest.php file not found in Api transformers base path directory (' . $this->getRequestsClassesFilesPath() . ') !');
				return;
			}

			if (file_exists($this->getRequestClassFilePath($capitalizedCamelCaseModelName, 'Update'))) {
				$this->warn('The file "' . $this->getRequestClassFilePath($capitalizedCamelCaseModelName, 'Update') . '" already exists !');
				$makeUpdateRequest = $this->confirm('Do you want to replace it ?', true);
			}
		}

		// Turn down the app (to prevent cron/jobs execution)
		Artisan::call('down', [], $this->getOutput());

		$this->phpParser = (new ParserFactory)->create(ParserFactory::PREFER_PHP5);

		// Write model class template

		$modelClassTemplateData = [
			'modelsNamespace' => $modelsNamespace,
			'modelClassName' => $capitalizedCamelCaseModelName,
			'tableName' => $snakeCaseModelName,
			'defaultFillableFields' => [],
			'timestamps' => $timestamps,
			'useUuid' => ($makePrimaryId && ($primaryKeyType == 'uuid')),
			'useAutoincrement' => ($usePrimaryKey && ($primaryKeyType == 'autoincrement'))
		];

		// Configurable ?

		$modelClassTemplateData['perPage'] = 20;
		$modelClassTemplateData['perPageMin'] = 5;
		$modelClassTemplateData['perPageMax'] = 50;

		$modelClassTemplateData['storeFillableFields'] = [];
		$modelClassTemplateData['patchFillableFields'] = [];
		$modelClassTemplateData['putFillableFields'] = [];

		$modelClassTemplateData['storeFieldsRules'] = [];
		$modelClassTemplateData['patchFieldsRules'] = [];
		$modelClassTemplateData['putFieldsRules'] = [];

		$modelClassFilePath = $modelsBasePath . DIRECTORY_SEPARATOR . $capitalizedCamelCaseModelName . '.php';
		$this->writeModelClass($modelClassFilePath, $modelClassTemplateData);

		// Write migration class template

		if ($makeMigration) {
			$migrationClassTemplateData = [
				'modelsNamespace' => $modelsNamespace,
				'modelClassName' => $capitalizedCamelCaseModelName,
				'tableName' => $snakeCaseModelName,
				'defaultFillableFields' => [],
				'timestamps' => $timestamps,
				'usePrimaryKey' => $usePrimaryKey,
				'useUuidPrimaryKey' => ($usePrimaryKey && ($primaryKeyType == 'uuid')),
				'useStringPrimaryKey' => ($usePrimaryKey && ($primaryKeyType == 'string')),
				'primaryKeyStringLength' => $primaryKeyStringLength,
				'useAutoincrementPrimaryKey' => ($usePrimaryKey && ($primaryKeyType == 'autoincrement')),
			];

			$this->writeMigrationClass($this->getMigrationClassFilePath($snakeCaseModelName), $migrationClassTemplateData);
		}

		// Create new model init seeder class and update database/InitSeeder.php file

		if ($makeInitSeeder) {
			// Write model init seeder class template
			$modelInitSeederClassTemplateData = [
				'modelsNamespace' => $modelsNamespace,
				'modelClassName' => $capitalizedCamelCaseModelName
			];

			$this->writeModelInitSeederClass($this->getModelInitSeederClassFilePath($capitalizedCamelCaseModelName), $modelInitSeederClassTemplateData);

			// Update InitSeeder.php
			if (!$this->updateInitSeederClassFile($capitalizedCamelCaseModelName)) {
				$this->error('Can not update the InitSeeder.php file');
			}
		}

		// Create new model samples seeder class and Update database/Samples/SamplesSeeder.php file

		if ($makeSamplesSeeder) {
			// Write model samples seeder class template
			$modelSamplesSeederClassTemplateData = [
				'modelsNamespace' => $modelsNamespace,
				'modelClassName' => $capitalizedCamelCaseModelName
			];

			$this->writeModelSamplesSeederClass($this->getModelSamplesSeederClassFilePath($capitalizedCamelCaseModelName), $modelSamplesSeederClassTemplateData);

			// Update SamplesSeeder.php file
			if (!$this->updateSamplesSeederClassFile($capitalizedCamelCaseModelName)) {
				$this->error('Can not update the SamplesSeeder.php file');
			}
		}

		// Create new model controller class

		if ($makeController) {
			// Write model controller class template

			$uses = [$modelsNamespace . '\\' . $capitalizedCamelCaseModelName];

			if ($makeTransformer) {
				$uses[] = 'App\\Http\\Transformers\\Api\\' . $capitalizedCamelCaseModelName . 'Transformer';
			}

			if ($makeStoreRequest) {
				$uses[] = 'App\\Http\\Requests\\Store' . $capitalizedCamelCaseModelName . 'Request';
			}

			if ($makeUpdateRequest) {
				$uses[] = 'App\\Http\\Requests\\Update' . $capitalizedCamelCaseModelName . 'Request';
			}

			$modelControllerClassTemplateData = [
				'uses' => $uses,
				'controllersNamespace' => $controllersNamespace,
				'modelClassName' => $capitalizedCamelCaseModelName,
				'modelSentenceClassName' => str_replace('_', ' ', $snakeCaseModelName),
				'modelTitleCaseClassName' => title_case(str_replace('_', ' ', $snakeCaseModelName)),
				'camelCaseModelClassName' => $camelCaseModelName,
				'useUuidPrimaryKey' => ($makePrimaryId && ($primaryKeyType == 'uuid')),
				'makeIndexMethod' => $makeControllerIndexMethod,
				'makeShowMethod' => $makeControllerShowMethod,
				'makeStoreMethod' => $makeControllerStoreMethod,
				'makeUpdateMethod' => $makeControllerUpdateMethod,
				'makeDestroyMethod' => $makeControllerDestroyMethod,
			];

			$this->writeModelControllerClass($this->getModelControllerClassFilePath($capitalizedCamelCaseModelName), $modelControllerClassTemplateData);
		}

		// Update api routes

		if ($updateApiRoutesFile) {
			// Update routes/api.php
			if (!$this->updateRoutesApiFile(
					$capitalizedCamelCaseModelName, $camelCaseModelName, $apiRoutesFilePath,
					$makeControllerIndexMethod,
					$makeControllerShowMethod,
					$makeControllerStoreMethod,
					$makeControllerUpdateMethod,
					$makeControllerDestroyMethod)) {
				$this->error('Can not update the routes api.php file');
			}
		}

		// Create new model transformer class

		if ($makeTransformer) {
			// Write model transformer class template
			$modelTransformerClassTemplateData = [
				'usePrimaryId' => $makePrimaryId,
				'modelClassName' => $capitalizedCamelCaseModelName,
				'camelCaseModelClassName' => $camelCaseModelName,
				'modelHasTimestamps' => $timestamps
			];

			$this->writeModelTransformerClass($this->getModelTransformerClassFilePath($capitalizedCamelCaseModelName), $modelTransformerClassTemplateData);
		}

		// Create new model Store request class

		if ($makeStoreRequest) {
			// Write model store request class template
			$modelStoreRequestClassTemplateData = [
				'modelClassName' => $capitalizedCamelCaseModelName,
			];

			$this->writeModelStoreRequestClass($this->getRequestClassFilePath($capitalizedCamelCaseModelName, 'Store'), $modelStoreRequestClassTemplateData);
		}

		// Create new model Update request class

		if ($makeUpdateRequest) {
			// Write model update request class template
			$modelUpdateRequestClassTemplateData = [
				'modelClassName' => $capitalizedCamelCaseModelName,
			];

			$this->writeModelUpdateRequestClass($this->getRequestClassFilePath($capitalizedCamelCaseModelName, 'Update'), $modelUpdateRequestClassTemplateData);
		}

		// Turn up the app
		Artisan::call('up', [], $this->getOutput());

		$this->info('Composer dump autoloads');
		$this->composer->dumpAutoloads();

		return;
	}

	/**
	 * Update the database/seeds/InitSeeder.php file, adding the new model class seeder
	 *
	 * @param string $capitalizedCamelCaseModelName
	 * @return boolean Return false if file not found or not editable
	 */
	protected function updateInitSeederClassFile($capitalizedCamelCaseModelName)
	{
		$this->info('Update the InitSeeder.php file');

		$initSeederFileLines = file($this->getInitSeederClassFilePath());

		$fileContent = file_get_contents($this->getInitSeederClassFilePath());
		$initSeederFileStmts = $this->phpParser->parse($fileContent);

		// Check if already in place

		if (strstr($fileContent, '$this->call(' . $capitalizedCamelCaseModelName . 'TableSeeder::class);')) {
			$this->info('Code already in place, nothing to do.');
			return true;
		}

		// Locate the closure in PHP file insert the code line in file

		// Search for class
		foreach ($initSeederFileStmts as $stmts) {
			if (($stmts->getType() == 'Stmt_Class') && ($stmts->name == 'InitSeeder')) {
				$initSeederClassStmts = $stmts->stmts;
				// Search for "run" method
				foreach ($initSeederClassStmts as $subStmts) {
					if (($subStmts->getType() == "Stmt_ClassMethod") && ($subStmts->name == 'run')) {
						// Append new line at the end of the "run" method
						$endLine = $subStmts->getAttribute('endLine');
						array_splice($initSeederFileLines, $endLine - 1, 0, ["\t\t" . '$this->call(' . $capitalizedCamelCaseModelName . 'TableSeeder::class);' . "\n"]);

						$newFileContent = implode('', $initSeederFileLines);

						if ($this->option('testdump')) {
							dump($newFileContent);
						} else {
							file_put_contents($this->getInitSeederClassFilePath(), $newFileContent);
						}

						return true;
					}
				}
			}
		}

		return false;
	}

	/**
	 * Update the database/seeds/Samples/SamplesSeeder.php file, adding the new model class samples seeder
	 *
	 * @param string $capitalizedCamelCaseModelName
	 * @return boolean Return false if file not found or not editable
	 */
	protected function updateSamplesSeederClassFile($capitalizedCamelCaseModelName)
	{
		$this->info('Update the SamplesSeeder.php file');

		$samplesSeederFileLines = file($this->getSamplesSeederClassFilePath());

		$fileContent = file_get_contents($this->getSamplesSeederClassFilePath());
		$samplesSeederFileStmts = $this->phpParser->parse($fileContent);

		// Check if already in place

		if (strstr($fileContent, '$this->call(' . $capitalizedCamelCaseModelName . 'TableSeeder::class);')) {
			$this->info('Code already in place, nothing to do.');
			return true;
		}

		// Locate the closure in PHP file insert the code line in file

		// Search for class
		foreach ($samplesSeederFileStmts as $stmts) {
			if (($stmts->getType() == 'Stmt_Class') && ($stmts->name == 'SamplesSeeder')) {
				$samplesSeederClassStmts = $stmts->stmts;
				// Search for "run" method
				foreach ($samplesSeederClassStmts as $subStmts) {
					if (($subStmts->getType() == "Stmt_ClassMethod") && ($subStmts->name == 'run')) {
						// Append new line at the end of the "run" method
						$endLine = $subStmts->getAttribute('endLine');
						array_splice($samplesSeederFileLines, $endLine - 1, 0, ["\t\t" . '$this->call(' . $capitalizedCamelCaseModelName . 'TableSeeder::class);' . "\n"]);

						$newFileContent = implode('', $samplesSeederFileLines);
						if ($this->option('testdump')) {
							dump($newFileContent);
						} else {
							file_put_contents($this->getSamplesSeederClassFilePath(), $newFileContent);
						}

						return true;
					}
				}
			}
		}

		return false;
	}

	/**
	 * Update the routes/api.php file, adding the new model controller routes
	 *
	 * @param string $capitalizedCamelCaseModelName
	 * @param string $camelCaseModelName
	 * @param string $apiRoutesFilePath
	 * @param boolean $makeIndexRoute
	 * @param boolean $makeShowRoute
	 * @param boolean $makeStoreRoute
	 * @param boolean $makeUpdateRoutes
	 * @param boolean $makeDestroyRoute
	 * @return boolean Return false if file not found or not editable
	 */
	protected function updateRoutesApiFile($capitalizedCamelCaseModelName, $camelCaseModelName, $apiRoutesFilePath,
										   $makeIndexRoute, $makeShowRoute, $makeStoreRoute, $makeUpdateRoutes, $makeDestroyRoute)
	{
		$this->info('Update the routes api.php file');

		$fileLines = file($apiRoutesFilePath);

		$fileContent = file_get_contents($apiRoutesFilePath);
		$fileStmts = $this->phpParser->parse($fileContent);
		$fileLineOffset = 0;
		$headCommentAdded = false;

		if ($makeIndexRoute) {
			// Check if already in place
			if (strstr($fileContent, '->name(\'' . $camelCaseModelName . '.index\')')) {
				$this->info('Skip index route, already in place.');
			} else {
				$linesToInsert = [];
				$linesToInsert[] = "\t\n";

				if (!$headCommentAdded) {
					$linesToInsert[] = "\t" . '// ' . $capitalizedCamelCaseModelName . "\n";
					$linesToInsert[] = "\t\n";
					$headCommentAdded = true;
				}

				$linesToInsert[] = "\t" . '$api->get(' . "\n";
				$linesToInsert[] ="\t\t" . '\'' . $camelCaseModelName . '\',' . "\n";
				$linesToInsert[] = "\t\t" . '\'App\Http\Controllers\Api\\' . $capitalizedCamelCaseModelName . 'Controller@index\'' . "\n";
				$linesToInsert[] = "\t" . ')->name(\'' . $camelCaseModelName . '.index\');' . "\n";
				
				// Locate the closure in PHP file insert the code line in file
				
				// Search $api->version method call
				$endLine = null;
				/** @var Node\Stmt\Expression $stmts */
				foreach ($fileStmts as $stmts) {
					if ($stmts->getType() == 'Stmt_Expression') {
						if (isset($stmts->expr)) {
							if (($stmts->expr->getType() == "Expr_MethodCall") && ($stmts->expr->name->name == 'version')) {
								/** @var Node\Expr\MethodCall $methodCall */
								$methodCall = $stmts->expr;
								if ($methodCall->var->name == 'api') {
									$endLine = $methodCall->getAttribute('endLine');
								}
							}
						}
					}
				}
				
				if (is_null($endLine)) {
					$this->error('Can not find the $api->version method call in api routes files !');
					return false;
				}

				array_splice($fileLines, $fileLineOffset + $endLine - 1, 0, $linesToInsert);

				$fileLineOffset += count($linesToInsert);
			}
		}

		if ($makeShowRoute) {
			// Check if already in place
			if (strstr($fileContent, '->name(\'' . $camelCaseModelName . '.show\')')) {
				$this->info('Skip show route, already in place.');
			} else {
				$linesToInsert = [];
				$linesToInsert[] = "\t\n";

				if (!$headCommentAdded) {
					$linesToInsert[] = "\t" . '// ' . $capitalizedCamelCaseModelName . "\n";
					$linesToInsert[] = "\t\n";
					$headCommentAdded = true;
				}

				$linesToInsert[] = "\t" . '$api->get(' . "\n";
				$linesToInsert[] ="\t\t" . '\'' . $camelCaseModelName . '/{' . $camelCaseModelName . 'Id}\',' . "\n";
				$linesToInsert[] = "\t\t" . '\'App\Http\Controllers\Api\\' . $capitalizedCamelCaseModelName . 'Controller@show\'' . "\n";
				$linesToInsert[] = "\t" . ')->name(\'' . $camelCaseModelName . '.show\');' . "\n";
				
				// Locate the closure in PHP file insert the code line in file
				
				// Search $api->version method call
				$endLine = null;
				/** @var Node\Stmt\Expression $stmts */
				foreach ($fileStmts as $stmts) {
					if ($stmts->getType() == 'Stmt_Expression') {
						if (isset($stmts->expr)) {
							if (($stmts->expr->getType() == "Expr_MethodCall") && ($stmts->expr->name->name == 'version')) {
								/** @var Node\Expr\MethodCall $methodCall */
								$methodCall = $stmts->expr;
								if ($methodCall->var->name == 'api') {
									$endLine = $methodCall->getAttribute('endLine');
								}
							}
						}
					}
				}
				
				if (is_null($endLine)) {
					$this->error('Can not find the $api->version method call in api routes files !');
					return false;
				}

				array_splice($fileLines, $fileLineOffset + $endLine - 1, 0, $linesToInsert);

				$fileLineOffset += count($linesToInsert);
			}
		}

		if ($makeStoreRoute) {
			// Check if already in place
			if (strstr($fileContent, '->name(\'' . $camelCaseModelName . '.store\')')) {
				$this->info('Skip store route, already in place.');
			} else {
				$linesToInsert = [];
				$linesToInsert[] = "\t\n";

				if (!$headCommentAdded) {
					$linesToInsert[] = "\t" . '// ' . $capitalizedCamelCaseModelName . "\n";
					$linesToInsert[] = "\t\n";
					$headCommentAdded = true;
				}

				$linesToInsert[] = "\t" . '$api->post(' . "\n";
				$linesToInsert[] ="\t\t" . '\'' . $camelCaseModelName . '\',' . "\n";
				$linesToInsert[] = "\t\t" . '\'App\Http\Controllers\Api\\' . $capitalizedCamelCaseModelName . 'Controller@store\'' . "\n";
				$linesToInsert[] = "\t" . ')->name(\'' . $camelCaseModelName . '.store\');' . "\n";
				
				// Locate the closure in PHP file insert the code line in file
				
				// Search $api->version method call
				$endLine = null;
				/** @var Node\Stmt\Expression $stmts */
				foreach ($fileStmts as $stmts) {
					if ($stmts->getType() == 'Stmt_Expression') {
						if (isset($stmts->expr)) {
							if (($stmts->expr->getType() == "Expr_MethodCall") && ($stmts->expr->name->name == 'version')) {
								/** @var Node\Expr\MethodCall $methodCall */
								$methodCall = $stmts->expr;
								if ($methodCall->var->name == 'api') {
									$endLine = $methodCall->getAttribute('endLine');
								}
							}
						}
					}
				}
				
				if (is_null($endLine)) {
					$this->error('Can not find the $api->version method call in api routes files !');
					return false;
				}

				array_splice($fileLines, $fileLineOffset + $endLine - 1, 0, $linesToInsert);

				$fileLineOffset += count($linesToInsert);
			}
		}

		if ($makeUpdateRoutes) {
			// Check if already in place
			if (strstr($fileContent, '->name(\'' . $camelCaseModelName . '.update\')')) {
				$this->info('Skip update route, already in place.');
			} else {
				$linesToInsert = [];
				$linesToInsert[] = "\t\n";

				if (!$headCommentAdded) {
					$linesToInsert[] = "\t" . '// ' . $capitalizedCamelCaseModelName . "\n";
					$linesToInsert[] = "\t\n";
					$headCommentAdded = true;
				}

				$linesToInsert[] = "\t" . '$api->match(' . "\n";
				$linesToInsert[] ="\t\t" . '[\'put\', \'patch\'],' . "\n";
				$linesToInsert[] ="\t\t" . '\'' . $camelCaseModelName . '/{' . $camelCaseModelName . 'Id}\',' . "\n";
				$linesToInsert[] = "\t\t" . '\'App\Http\Controllers\Api\\' . $capitalizedCamelCaseModelName . 'Controller@update\'' . "\n";
				$linesToInsert[] = "\t" . ')->name(\'' . $camelCaseModelName . '.update\');' . "\n";
				
				// Locate the closure in PHP file insert the code line in file
				
				// Search $api->version method call
				$endLine = null;
				/** @var Node\Stmt\Expression $stmts */
				foreach ($fileStmts as $stmts) {
					if ($stmts->getType() == 'Stmt_Expression') {
						if (isset($stmts->expr)) {
							if (($stmts->expr->getType() == "Expr_MethodCall") && ($stmts->expr->name->name == 'version')) {
								/** @var Node\Expr\MethodCall $methodCall */
								$methodCall = $stmts->expr;
								if ($methodCall->var->name == 'api') {
									$endLine = $methodCall->getAttribute('endLine');
								}
							}
						}
					}
				}
				
				if (is_null($endLine)) {
					$this->error('Can not find the $api->version method call in api routes files !');
					return false;
				}

				array_splice($fileLines, $fileLineOffset + $endLine - 1, 0, $linesToInsert);

				$fileLineOffset += count($linesToInsert);
			}
		}

		if ($makeDestroyRoute) {
			// Check if already in place
			if (strstr($fileContent, '->name(\'' . $camelCaseModelName . '.destroy\')')) {
				$this->info('Skip show route, already in place.');
			} else {
				$linesToInsert = [];
				$linesToInsert[] = "\t\n";

				if (!$headCommentAdded) {
					$linesToInsert[] = "\t" . '// ' . $capitalizedCamelCaseModelName . "\n";
					$linesToInsert[] = "\t\n";
					$headCommentAdded = true;
				}

				$linesToInsert[] = "\t" . '$api->delete(' . "\n";
				$linesToInsert[] ="\t\t" . '\'' . $camelCaseModelName . '/{' . $camelCaseModelName . 'Id}\',' . "\n";
				$linesToInsert[] = "\t\t" . '\'App\Http\Controllers\Api\\' . $capitalizedCamelCaseModelName . 'Controller@destroy\'' . "\n";
				$linesToInsert[] = "\t" . ')->name(\'' . $camelCaseModelName . '.destroy\');' . "\n";
				
				// Locate the closure in PHP file insert the code line in file
				
				// Search $api->version method call
				$endLine = null;
				/** @var Node\Stmt\Expression $stmts */
				foreach ($fileStmts as $stmts) {
					if ($stmts->getType() == 'Stmt_Expression') {
						if (isset($stmts->expr)) {
							if (($stmts->expr->getType() == "Expr_MethodCall") && ($stmts->expr->name->name == 'version')) {
								/** @var Node\Expr\MethodCall $methodCall */
								$methodCall = $stmts->expr;
								if ($methodCall->var->name == 'api') {
									$endLine = $methodCall->getAttribute('endLine');
								}
							}
						}
					}
				}
				
				if (is_null($endLine)) {
					$this->error('Can not find the $api->version method call in api routes files !');
					return false;
				}

				array_splice($fileLines, $fileLineOffset + $endLine - 1, 0, $linesToInsert);

				$fileLineOffset += count($linesToInsert);
			}
		}

		$fileContent = implode('', $fileLines);

		if ($this->option('testdump')) {
			dump($fileContent);
		} else {
			file_put_contents($apiRoutesFilePath, $fileContent);
		}

		return true;
	}

	/**
	 * Get the path to the model class file
	 *
	 * @param string $modelsBasePath
	 * @param string $capitalizedCamelCaseModelName
	 * @return string
	 */
	protected function getModelClassFilePath($modelsBasePath, $capitalizedCamelCaseModelName)
	{
		return $modelsBasePath . DIRECTORY_SEPARATOR . $capitalizedCamelCaseModelName . '.php';
	}

	/**
	 * Get the path to the migration directory
	 *
	 * @param string $snakeCaseModelName
	 * @return string
	 */
	protected function getMigrationClassFilePath($snakeCaseModelName)
	{
		$filepath =  $this->laravel->databasePath() . DIRECTORY_SEPARATOR . 'migrations';
		$filepath .= DIRECTORY_SEPARATOR . date('Y_m_d_His') . '_create_' .$snakeCaseModelName . '_table.php';
		return $filepath;
	}

	/**
	 * Get the path to the InitSeeder.php file
	 *
	 * @return string
	 */
	protected function getInitSeederClassFilePath()
	{
		$filepath =  $this->laravel->databasePath() . DIRECTORY_SEPARATOR . 'seeds';
		$filepath .= DIRECTORY_SEPARATOR . 'InitSeeder.php';
		return $filepath;
	}

	/**
	 * Get the path to the SamplesSeeder.php file
	 *
	 * @return string
	 */
	protected function getSamplesSeederClassFilePath()
	{
		$filepath =  $this->laravel->databasePath() . DIRECTORY_SEPARATOR . 'seeds' . DIRECTORY_SEPARATOR . 'Samples';
		$filepath .= DIRECTORY_SEPARATOR . 'SamplesSeeder.php';
		return $filepath;
	}

	/**
	 * Get the path to the model init seeder file
	 *
	 * @param string $capitalizedCamelCaseModelName
	 * @return string
	 */
	protected function getModelInitSeederClassFilePath($capitalizedCamelCaseModelName)
	{
		$filepath =  $this->laravel->databasePath() . DIRECTORY_SEPARATOR . 'seeds';
		$filepath .= DIRECTORY_SEPARATOR . $capitalizedCamelCaseModelName . 'TableSeeder.php';
		return $filepath;
	}

	/**
	 * Get the path to the model samples seeder file
	 *
	 * @param string $capitalizedCamelCaseModelName
	 * @return string
	 */
	protected function getModelSamplesSeederClassFilePath($capitalizedCamelCaseModelName)
	{
		$filepath =  $this->laravel->databasePath() . DIRECTORY_SEPARATOR . 'seeds' . DIRECTORY_SEPARATOR . 'Samples';
		$filepath .= DIRECTORY_SEPARATOR . $capitalizedCamelCaseModelName . 'TableSeeder.php';
		return $filepath;
	}

	/**
	 * Get the path to the model controllers files
	 *
	 * @return string
	 */
	protected function getModelControllersClassesFilesPath()
	{
		return $this->laravel->path() . DIRECTORY_SEPARATOR . 'Http' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . 'Api';
	}

	/**
	 * Get the path to the model controller file
	 *
	 * @param string $capitalizedCamelCaseModelName
	 * @return string
	 */
	protected function getModelControllerClassFilePath($capitalizedCamelCaseModelName)
	{
		$filepath =  $this->getModelControllersClassesFilesPath();
		$filepath .= DIRECTORY_SEPARATOR . $capitalizedCamelCaseModelName . 'Controller.php';
		return $filepath;
	}

	/**
	 * Get the path to the model transformers files
	 *
	 * @return string
	 */
	protected function getModelTransformersClassesFilesPath()
	{
		return $this->laravel->path() . DIRECTORY_SEPARATOR . 'Http' . DIRECTORY_SEPARATOR . 'Transformers' . DIRECTORY_SEPARATOR . 'Api';
	}

	/**
	 * Get the path to the model transformer file
	 *
	 * @param $capitalizedCamelCaseModelName
	 * @return string
	 */
	protected function getModelTransformerClassFilePath($capitalizedCamelCaseModelName)
	{
		$filepath =  $this->getModelTransformersClassesFilesPath();
		$filepath .= DIRECTORY_SEPARATOR . $capitalizedCamelCaseModelName . 'Transformer.php';
		return $filepath;
	}

	/**
	 * Get the path to the request classes files
	 *
	 * @return string
	 */
	protected function getRequestsClassesFilesPath()
	{
		return $this->laravel->path() . DIRECTORY_SEPARATOR . 'Http' . DIRECTORY_SEPARATOR . 'Requests';
	}

	/**
	 * Get the path to the request class file
	 *
	 * @param $capitalizedCamelCaseModelName
	 * @param $method
	 * @return string
	 */
	protected function getRequestClassFilePath($capitalizedCamelCaseModelName, $camelCaseMethod)
	{
		$filepath =  $this->getRequestsClassesFilesPath();
		$filepath .= DIRECTORY_SEPARATOR . $camelCaseMethod . $capitalizedCamelCaseModelName . 'Request.php';
		return $filepath;
	}

	/**
	 * Load Twig templates filesystem and custom filters
	 */
	protected function loadTemplates()
	{
		$loader = new \Twig_Loader_Filesystem(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'templates');
		$this->twigEnv = new Twig_Environment($loader, ['cache' => false, 'debug' => true]);
		$this->twigEnv->addExtension(new Twig_Extension_Debug());

		$this->modelClassTemplate = $this->twigEnv->load('modelClass.php.twig');
		$this->migrationClassTemplate = $this->twigEnv->load('migrationClass.php.twig');
		$this->modelInitSeederClassTemplate = $this->twigEnv->load('modelInitSeederClass.php.twig');
		$this->modelSamplesSeederClassTemplate = $this->twigEnv->load('modelSamplesSeederClass.php.twig');
		$this->modelControllerClassTemplate = $this->twigEnv->load('modelControllerClass.php.twig');
		$this->modelTransformerClassTemplate = $this->twigEnv->load('modelTransformerClass.php.twig');
		$this->modelStoreRequestClassTemplate = $this->twigEnv->load('modelStoreRequestClass.php.twig');
		$this->modelUpdateRequestClassTemplate = $this->twigEnv->load('modelUpdateRequestClass.php.twig');
	}

	/**
	 * Write the model class file
	 *
	 * @param string $filePath Model class file path
	 * @param mixed[] Template data
	 */
	protected function writeModelClass($filePath, $data)
	{
		$this->info('Writing ' . $filePath);
		if ($this->option('testdump')) {
			dump($this->modelClassTemplate->render($data));
		} else {
			file_put_contents($filePath, $this->modelClassTemplate->render($data));
		}
	}

	/**
	 * Write the migration class file
	 *
	 * @param string $filePath Migration class file path
	 * @param mixed[] Template data
	 */
	protected function writeMigrationClass($filePath, $data)
	{
		$this->info('Writing ' . $filePath);
		if ($this->option('testdump')) {
			dump($this->migrationClassTemplate->render($data));
		} else {
			file_put_contents($filePath, $this->migrationClassTemplate->render($data));
		}
	}

	/**
	 * Write the model init seeder class file
	 *
	 * @param string $filePath Model init seeder class file path
	 * @param mixed[] Template data
	 */
	protected function writeModelInitSeederClass($filePath, $data)
	{
		$this->info('Writing ' . $filePath);
		if ($this->option('testdump')) {
			dump($this->modelInitSeederClassTemplate->render($data));
		} else {
			file_put_contents($filePath, $this->modelInitSeederClassTemplate->render($data));
		}
	}

	/**
	 * Write the model samples seeder class file
	 *
	 * @param string $filePath Model samples seeder class file path
	 * @param mixed[] Template data
	 */
	protected function writeModelSamplesSeederClass($filePath, $data)
	{
		$this->info('Writing ' . $filePath);
		if ($this->option('testdump')) {
			dump($this->modelSamplesSeederClassTemplate->render($data));
		} else {
			file_put_contents($filePath, $this->modelSamplesSeederClassTemplate->render($data));
		}
	}

	/**
	 * Write the model controller class file
	 *
	 * @param string $filePath Model samples seeder class file path
	 * @param mixed[] Template data
	 */
	protected function writeModelControllerClass($filePath, $data)
	{
		$this->info('Writing ' . $filePath);
		if ($this->option('testdump')) {
			dump($this->modelControllerClassTemplate->render($data));
		} else {
			file_put_contents($filePath, $this->modelControllerClassTemplate->render($data));
		}
	}

	/**
	 * Write the model transformer class file
	 *
	 * @param $filePath
	 * @param $data
	 */
	protected function writeModelTransformerClass($filePath, $data)
	{
		$this->info('Writing ' . $filePath);
		if ($this->option('testdump')) {
			dump($this->modelTransformerClassTemplate->render($data));
		} else {
			file_put_contents($filePath, $this->modelTransformerClassTemplate->render($data));
		}
	}

	/**
	 * Write the model store request class
	 *
	 * @param $filePath
	 * @param $data
	 */
	protected function writeModelStoreRequestClass($filePath, $data)
	{
		$this->info('Writing ' . $filePath);
		if ($this->option('testdump')) {
			dump($this->modelStoreRequestClassTemplate->render($data));
		} else {
			file_put_contents($filePath, $this->modelStoreRequestClassTemplate->render($data));
		}
	}

	/**
	 * Write the model update request class
	 *
	 * @param $filePath
	 * @param $data
	 */
	protected function writeModelUpdateRequestClass($filePath, $data)
	{
		$this->info('Writing ' . $filePath);
		if ($this->option('testdump')) {
			dump($this->modelUpdateRequestClassTemplate->render($data));
		} else {
			file_put_contents($filePath, $this->modelUpdateRequestClassTemplate->render($data));
		}
	}
}
