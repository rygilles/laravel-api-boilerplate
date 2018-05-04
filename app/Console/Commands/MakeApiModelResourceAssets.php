<?php

namespace App\Console\Commands;

use App\Models\ApiModel;
use DOMAttr;
use DOMNode;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

use Peast\Syntax\Node\ArrayExpression;
use Peast\Syntax\Node\Declaration;
use Peast\Syntax\Node\ExportDefaultDeclaration;
use Peast\Syntax\Node\Expression;
use Peast\Syntax\Node\Identifier;
use Peast\Syntax\Node\NewExpression;
use Peast\Syntax\Node\ObjectExpression;
use Peast\Syntax\Node\Property;
use Peast\Syntax\Node\VariableDeclaration;
use Peast\Syntax\Node\VariableDeclarator;
use Peast\Syntax\SourceLocation;
use Symfony\Component\DomCrawler\Crawler;
use Twig_Environment;
use Twig_Extension_Debug;
use Twig_TemplateWrapper;
use PhpParser\ParserFactory;
use PhpParser\Parser;
use PhpParser\Node;
use PhpParser\PrettyPrinter;
use Peast\Peast;
use Peast\Traverser;

class MakeApiModelResourceAssets extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'app:makeApiModelResourceAssets
							{--testdump : Dump the files insteed of really creating/modifying them}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'This command create new Api model resource assets, ' .
							  'Using model, migration, controller, routes, etc. as sources.';

	/**
	 * Twig templates environment
	 *
	 * @var Twig_Environment
	 */
	protected $twigEnv;
	
	/**
	 * Twig model list vue component template
	 *
	 * @var Twig_TemplateWrapper
	 */
	protected $modelListComponentTemplate;
	
	/**
	 * Twig model item vue component template
	 *
	 * @var Twig_TemplateWrapper
	 */
	protected $modelItemComponentTemplate;
	
	/**
	 * Twig model locales js template
	 *
	 * @var Twig_TemplateWrapper
	 */
	protected $modelLocalesTemplate;
	
	/**
	 * PHP Parser
	 *
	 * @var Parser
	 */
	protected $phpParser;
	
	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$this->info('LaravelApiBoilerplate Helpers : Make Api Model Resource Assets (For DEV purpose only !)');
		$this->info('(Ask to ryan@e-monsite.com for more information)');
		$this->warn('');
		$this->warn('This command will create new Api model resource assets, ' . "\n" .
					'Using model, migration, controller, routes, etc. as sources.' . "\n");

		// Check configuration
	
		$dashboardComponentsBasePath = resource_path('assets' .
			DIRECTORY_SEPARATOR . 'js' .
			DIRECTORY_SEPARATOR . 'components' .
			DIRECTORY_SEPARATOR . 'dashboard'
		);
		$localesBasePath = resource_path('assets' .
			DIRECTORY_SEPARATOR . 'js' .
			DIRECTORY_SEPARATOR . 'locales'
		);
		$appModelsBasePath = app_path('Models');
	
		$sideBarMenuVueFilePath = resource_path('assets' .
			DIRECTORY_SEPARATOR . 'js' .
			DIRECTORY_SEPARATOR . 'components' .
			DIRECTORY_SEPARATOR . 'includes' .
			DIRECTORY_SEPARATOR . 'sidebar-menu.vue'
		);

		$localesJsFilePath = resource_path('assets' .
			DIRECTORY_SEPARATOR . 'js' .
			DIRECTORY_SEPARATOR . 'locales.js'
		);
	
		$routesJsFilePath = resource_path('assets' .
			DIRECTORY_SEPARATOR . 'js' .
			DIRECTORY_SEPARATOR . 'routes.js'
		);
	
		$storeJsFilePath = resource_path('assets' .
			DIRECTORY_SEPARATOR . 'js' .
			DIRECTORY_SEPARATOR . 'store.js'
		);
	
		// Check if files already exists

		if (!file_exists($dashboardComponentsBasePath)) {
			$this->error('Dashboard components base path directory (' . $dashboardComponentsBasePath . ') does not exists !');
			return;
		}
	
		if (!file_exists($localesBasePath)) {
			$this->error('Locales base path directory (' . $localesBasePath . ') does not exists !');
			return;
		}
	
		if (!file_exists($routesJsFilePath)) {
			$this->error('The file "' . $routesJsFilePath . '" does not exists ! Aborting');
			return;
		}
	
		if (!file_exists($storeJsFilePath)) {
			$this->error('The file "' . $storeJsFilePath . '" does not exists ! Aborting');
			return;
		}
	
		if (!file_exists($localesJsFilePath)) {
			$this->error('The file "' . $localesJsFilePath . '" does not exists ! Aborting');
			return;
		}
	
		if (!file_exists($sideBarMenuVueFilePath)) {
			$this->error('The file "' . $sideBarMenuVueFilePath . '" does not exists ! Aborting');
			return;
		}

		$this->loadTemplates();
		
		// List available models classes
		$modelsClasses = $this->getAndLoadAppModelsClasses($appModelsBasePath);

		while(1) {
			$modelClassName = $this->askWithCompletion('Select which model resource to use (' . implode(', ', $modelsClasses) . ')', $modelsClasses);

			if (in_array($modelClassName, $modelsClasses)) {
				break;
			};

			$this->warn('This model does not exists !');
		}

		$modelClassNamePlural = str_plural($modelClassName);

		$snakeCaseModelClassName = snake_case($modelClassName);
		$snakeCaseModelClassNamePlural = snake_case($modelClassNamePlural);

		$camelCaseModelClassName = camel_case($modelClassName);
		$camelCaseModelClassNamePlural = camel_case($modelClassNamePlural);

		$kebabCaseModelClassName = kebab_case($modelClassName);
		$kebabCaseModelClassNamePlural = kebab_case($modelClassNamePlural);

		// Files
	
		$modelListComponentFilePath = $this->getModelListComponentFilePath($dashboardComponentsBasePath, $kebabCaseModelClassNamePlural);
		$modelItemComponentFilePath = $this->getModelItemComponentFilePath($dashboardComponentsBasePath, $kebabCaseModelClassName);
	
		$langs = $this->getAvailableLocalesLangs($localesBasePath);
	
		$langModelLocalesFilePaths = [];
		$langRoutesLocalesFilePaths = [];
		foreach ($langs as $lang) {
			$langModelLocalesFilePaths[$lang] = $this->getLangModelLocalesFilePath($lang, $localesBasePath, $snakeCaseModelClassNamePlural);
			$langRoutesLocalesFilePaths[$lang] = $this->getLangRoutesLocalesFilePath($lang, $localesBasePath);
		}

		// Check if files already exists

		if (file_exists($modelListComponentFilePath)) {
			$this->error('The file "' . $modelListComponentFilePath . '" already exists ! Aborting');
			return;
		}
	
		if (file_exists($modelItemComponentFilePath)) {
			$this->error('The file "' . $modelItemComponentFilePath . '" already exists ! Aborting');
			return;
		}
	
		foreach ($langModelLocalesFilePaths as $langModelLocalesFilePath) {
			if (file_exists($langModelLocalesFilePath)) {
				$this->error('The file "' . $langModelLocalesFilePath . '" already exists ! Aborting');
				return;
			}
		}

		// Turn down the app (to prevent cron/jobs execution)
		Artisan::call('down', [], $this->getOutput());

		$this->phpParser = (new ParserFactory)->create(ParserFactory::PREFER_PHP5);
	
		$templateBaseData = compact(
			'modelClassName',
			'modelClassNamePlural',
			'snakeCaseModelClassName',
			'snakeCaseModelClassNamePlural',
			'camelCaseModelClassName',
			'camelCaseModelClassNamePlural',
			'kebabCaseModelClassName',
			'kebabCaseModelClassNamePlural'
		);

		$this->writeTemplateFile($this->modelListComponentTemplate, $modelListComponentFilePath, $templateBaseData);
		$this->writeTemplateFile($this->modelItemComponentTemplate, $modelItemComponentFilePath, $templateBaseData);

		foreach ($langModelLocalesFilePaths as $lang => $langModelLocalesFilePath) {
			$templateData = $templateBaseData;
			$templateData['lang'] = $lang;
			$this->writeTemplateFile($this->modelLocalesTemplate, $langModelLocalesFilePath, $templateData);
		}

		foreach ($langRoutesLocalesFilePaths as $lang => $langRoutesLocalesFilePath) {
			$templateData = $templateBaseData;
			$templateData['lang'] = $lang;
			$this->alterLangRoutesLocalesJsFile($langRoutesLocalesFilePath, $templateData);
		}
	
		$this->alterLocalesJsFile($localesJsFilePath, $templateBaseData);

		$this->alterStoreJsFileStateSection($storeJsFilePath, $templateBaseData);
		$this->alterStoreJsFileGettersSection($storeJsFilePath, $templateBaseData);
		$this->alterStoreJsFileMutationsSection($storeJsFilePath, $templateBaseData);
		$this->alterStoreJsFileActionsSection($storeJsFilePath, $templateBaseData);

		$this->alterRoutesJsFile($routesJsFilePath, $templateBaseData);

		$this->alterSideBarMenuVueFile($sideBarMenuVueFilePath, $templateBaseData);

		// Turn up the app
		Artisan::call('up', [], $this->getOutput());

		return;
	}
	
	/**
	 * Get all ApiModel extended classes
	 *
	 * @param string $appModelsBasePath
	 * @return string[]
	 */
	protected function getAndLoadAppModelsClasses($appModelsBasePath)
	{
		$classes = [];
		$results = scandir($appModelsBasePath);
		
		foreach ($results as $result) {
			if ($result === '.' or $result === '..') {
				continue;
			}

			$filename = $appModelsBasePath . DIRECTORY_SEPARATOR . $result;
			if (!is_dir($filename)) {
				$pathInfo = pathinfo($filename);
				if (($pathInfo['extension'] == 'php')) {
					$classes[$filename] = $pathInfo['filename'];
				}
			}
		}
		
		$this->loadAppModelsClasses($classes);
		
		// Check if classes are extended from ApiModel
	
		$modelsClasses = [];
		foreach ($classes as $class) {
			if (is_subclass_of('\\App\\Models\\' . $class, '\\App\\Models\\ApiModel')) {
				$modelsClasses[] = $class;
			}
		}
		
		return $modelsClasses;
	}
	
	/**
	 * Load all classes files
	 *
	 * @param string[] $modelsClasses
	 */
	protected function loadAppModelsClasses($modelsClasses)
	{
		foreach ($modelsClasses as $modelClassFilePath => $modelClass) {
			include_once($modelClassFilePath);
		}
	}

	/**
	 * Get the path to the dashboard model list component vue file
	 *
	 * @param string $dashboardComponentsBasePath
	 * @param string $kebabCaseModelClassNamePlural
	 * @return string
	 */
	protected function getModelListComponentFilePath($dashboardComponentsBasePath, $kebabCaseModelClassNamePlural)
	{
		return $dashboardComponentsBasePath . DIRECTORY_SEPARATOR . $kebabCaseModelClassNamePlural . '.vue';
	}
	
	/**
	 * Get the path to dashboard model item component vue file
	 *
	 * @param string $dashboardComponentsBasePath
	 * @param string $kebabCaseModelClassName
	 * @return string
	 */
	protected function getModelItemComponentFilePath($dashboardComponentsBasePath, $kebabCaseModelClassName)
	{
		return $dashboardComponentsBasePath . DIRECTORY_SEPARATOR . $kebabCaseModelClassName . '.vue';
	}

	/**
	 * Get the path to the lang routes.js locales js file
	 *
	 * @param string $lang
	 * @param string $localesBasePath
	 * @return string
	 */
	protected function getLangRoutesLocalesFilePath($lang, $localesBasePath)
	{
		return $localesBasePath . DIRECTORY_SEPARATOR . $lang . DIRECTORY_SEPARATOR . 'routes.js';
	}
	
	/**
	 * Get the path to the lang model locales js file
	 *
	 * @param string $lang
	 * @param string $localesBasePath
	 * @param string $snakeCaseModelClassNamePlural
	 * @return string
	 */
	protected function getLangModelLocalesFilePath($lang, $localesBasePath, $snakeCaseModelClassNamePlural)
	{
		return $localesBasePath . DIRECTORY_SEPARATOR . $lang . DIRECTORY_SEPARATOR .$snakeCaseModelClassNamePlural . '.js';
	}
	
	/**
	 * Return an array of available locales lang directories
	 *
	 * @param string $localesBasePath
	 * @return string[]
	 */
	protected function getAvailableLocalesLangs($localesBasePath)
	{
		$langs = [];
		$results = scandir($localesBasePath);
		
		foreach ($results as $result) {
			if ($result === '.' or $result === '..') {
				continue;
			}
			
			$filename = $localesBasePath . DIRECTORY_SEPARATOR . $result;
			if (is_dir($filename)) {
				if (strlen($result) == 2) {
					$langs[] = $result;
				}
			}
		}
		
		return $langs;
	}
	
	/**
	 * Load Twig templates filesystem and custom filters
	 */
	protected function loadTemplates()
	{
		$loader = new \Twig_Loader_Filesystem(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'templates');
		$this->twigEnv = new Twig_Environment($loader, ['cache' => false, 'debug' => true]);
		$this->twigEnv->addExtension(new Twig_Extension_Debug());

		$this->modelListComponentTemplate = $this->twigEnv->load('assets/modelListComponent.vue.twig');
		$this->modelItemComponentTemplate = $this->twigEnv->load('assets/modelItemComponent.vue.twig');
		$this->modelLocalesTemplate = $this->twigEnv->load('assets/modelLocales.js.twig');
	}

	/**
	 * Write the template file
	 *
	 * @param Twig_TemplateWrapper $template
	 * @param string $filePath file path
	 * @param mixed[] Template data
	 */
	protected function writeTemplateFile(Twig_TemplateWrapper $template, $filePath, $data)
	{
		$this->info('Writing ' . $filePath);
		if ($this->option('testdump')) {
			dump($template->render($data));
		} else {
			file_put_contents($filePath, $template->render($data));
		}
	}

	/**
	 * Alter lang routes.js locales file
	 *
	 * @param $langRoutesLocalesFilePath
	 * @param $data
	 * @return boolean Return false value already in file
	 */
	protected function alterLangRoutesLocalesJsFile($langRoutesLocalesFilePath, $data)
	{
		$this->info('Altering ' . $langRoutesLocalesFilePath);

		$matches = null;
		$fileContent = file_get_contents($langRoutesLocalesFilePath);
		$newFileContentLines = file($langRoutesLocalesFilePath);

		/** @var \Peast\Syntax\Node\Program $ast */
		$ast = Peast::latest($fileContent, [
			'sourceType' => Peast::SOURCE_TYPE_MODULE
		])->parse();

		$programBody = $ast->getBody();

		/** @var \Peast\Syntax\Node\Node $node */
		foreach ($programBody as $node) {
			if ($node->getType() == 'ExportDefaultDeclaration') {
				/** @var VariableDeclaration $variableDeclaration */
				$exportDefaultDeclaration = $node;
				/** @var ObjectExpression $declaration */
				$declaration = $exportDefaultDeclaration->getDeclaration();

				/** @var Property $property */
				foreach ($declaration->getProperties() as $property) {
					/** @var Identifier $key */
					$key = $property->getKey();
					if ($key->getValue() == $data['kebabCaseModelClassNamePlural']) {
						$this->warn('"' . $data['kebabCaseModelClassNamePlural'] . '" found in AST, ignore');
						return false;
					}
					if ($key->getValue() == $data['kebabCaseModelClassName']) {
						$this->warn('"' . $data['kebabCaseModelClassName'] . '" found in AST, ignore');
						return false;
					}
				}

				/** @var SourceLocation $elementLocation */
				$location = $declaration->getLocation();

				// Append new line at the end
				$endLine = $location->getEnd()->getLine() - 1;

				// Check for missing coma

				$lastProperty = $property;

				/** @var SourceLocation $lastPropertyLocation */
				$lastPropertyLocation = $lastProperty->getLocation();

				$lastEndLine = $lastPropertyLocation->getEnd()->getLine() - 1;
				if (substr(rtrim($newFileContentLines[$lastEndLine]), -1, 1) != ',') {
					$newFileContentLines[$lastEndLine] = rtrim($newFileContentLines[$lastEndLine]) . ',' . "\n";
				}

				$newLines = [
					"\t" . '\'' . $data['kebabCaseModelClassNamePlural'] . '\': {' . "\n",
					"\t\t" . '\'title\': \'routes.' . $data['kebabCaseModelClassNamePlural'] . '.title\',' . "\n",
					"\t\t" . '\'description\': \'routes.' . $data['kebabCaseModelClassNamePlural'] . '.description\',' . "\n",
					"\t},\n",
					"\t" . '\'' . $data['kebabCaseModelClassName'] . '\': {' . "\n",
					"\t\t" . '\'title\': \'routes.' . $data['kebabCaseModelClassName'] . '.title\',' . "\n",
					"\t\t" . '\'title_template\': \'routes.' . $data['kebabCaseModelClassName'] . '.title "<%- data.id %>"\',' . "\n",
					"\t\t" . '\'description\': \'routes.' . $data['kebabCaseModelClassName'] . '.description\',' . "\n",
					"\t},\n",
				];

				array_splice($newFileContentLines, $endLine, 0, $newLines);
			}
		}

		$newFileContent = implode('', $newFileContentLines);

		if ($this->option('testdump')) {
			dump($newFileContent);
		} else {
			file_put_contents($langRoutesLocalesFilePath, $newFileContent);
		}
		return true;
	}
	
	/**
	 * Alter locales.js file
	 *
	 * @param string $filePath file path
	 * @param string[] $data
	 * @return boolean Return false if regex failed or already value already in file
	 */
	protected function alterLocalesJsFile($filePath, $data)
	{
		$this->info('Altering ' . $filePath);
		
		// To find "var files = [...];" content
		$pattern = "/(var\s*files\s*=\s*\[\s*([\s*\'\w + \',?\s*]*))\s*\];/";
		
		$matches = null;
		$newFileContent = file_get_contents($filePath);
		
		if (preg_match($pattern, $newFileContent, $matches) === false) {
			$this->error('Matching code not found ! Check your file content.');
			return false;
		}
		
		if (!is_array($matches)) {
			$this->error('Matching code not found ! Check your file content.');
			return false;
		}

		if (!isset($matches[2])) {
			$this->error('Matching code not found ! Check your file content.');
			return false;
		}

		$matchedPattern = $matches[2];
		
		$list = explode(',', $matchedPattern);
		foreach ($list as $key => $item) {
			$list[$key] = trim(str_replace(['\'', '"'], '', $item));
			if ($list[$key] == '') {
				unset($list[$key]);
			}
		}
		
		// Check if already exists
		
		if (in_array($data['snakeCaseModelClassNamePlural'], $list)) {
			$this->warn('"' . $data['snakeCaseModelClassNamePlural'] . '" value already defined, ignore');
			return false;
		}
		
		// Create $replacement
		
		$replacement = rtrim($matches[1], "\n\, ") . ',' . "\n";
		$replacement .= "\t" . '\'' . $data['snakeCaseModelClassNamePlural'] . '\',' . "\n];";
		
		// Replace
		
		$newFileContent = preg_replace($pattern, $replacement, $newFileContent);
		
		if ($this->option('testdump')) {
			dump($newFileContent);
		} else {
			file_put_contents($filePath, $newFileContent);
		}
		
		return true;
	}

	/**
	 * Alter store.js file for "state" section
	 *
	 * @param string $filePath file path
	 * @param string[] $data
	 * @return boolean Return false if value already in file
	 */
	protected function alterStoreJsFileStateSection($filePath, $data)
	{
		$this->info('Altering ' . $filePath);

		$matches = null;
		$fileContent = file_get_contents($filePath);
		$newFileContentLines = file($filePath);

		/** @var \Peast\Syntax\Node\Program $ast */
		$ast = Peast::latest($fileContent, [
			'sourceType' => Peast::SOURCE_TYPE_MODULE
		])->parse();

		$programBody = $ast->getBody();

		/** @var \Peast\Syntax\Node\Node $node */
		foreach ($programBody as $node) {
			if ($node->getType() == 'VariableDeclaration') {
				/** @var VariableDeclaration $variableDeclaration */
				$variableDeclaration = $node;
				foreach ($variableDeclaration->getDeclarations() as $variableDeclarator) {
					/** @var Identifier $identifier */
					$identifier = $variableDeclarator->getId();
					if ($identifier->getName() == 'store') {
						/** @var NewExpression $storeInit */
						$storeInit = $variableDeclarator->getInit();
						/** @var ObjectExpression $storeInitArgument */
						foreach ($storeInit->getArguments() as $storeInitArgument) {
							/** @var Property $storeInitArgumentProperty */
							foreach ($storeInitArgument->getProperties() as $storeInitArgumentProperty) {
								/** @var Identifier $storeInitArgumentPropertyKey */
								$storeInitArgumentPropertyKey = $storeInitArgumentProperty->getKey();
								if ($storeInitArgumentPropertyKey->getName() == 'state') {
									$storeInitArgumentStateProperty = $storeInitArgumentProperty;
									/** @var ObjectExpression $storeInitArgumentStatePropertyValue */
									$storeInitArgumentStatePropertyValue = $storeInitArgumentStateProperty->getValue();
									/** @var Property $storeInitArgumentStatePropertyValueProperty */
									foreach ($storeInitArgumentStatePropertyValue->getProperties() as $storeInitArgumentStatePropertyValueProperty) {
										/** @var Identifier $storeInitArgumentStatePropertyValuePropertyKey */
										$storeInitArgumentStatePropertyValuePropertyKey = $storeInitArgumentStatePropertyValueProperty->getKey();
										if ($storeInitArgumentStatePropertyValuePropertyKey->getName() == $data['camelCaseModelClassNamePlural']) {
											$this->warn('"' . $data['camelCaseModelClassNamePlural'] . '" found in AST, ignore');
											return false;
										}
									}

									/** @var SourceLocation $storeInitArgumentStatePropertyLocation */
									$storeInitArgumentStatePropertyLocation = $storeInitArgumentStateProperty->getLocation();

									// Append new line at the end
									$endLine = $storeInitArgumentStatePropertyLocation->getEnd()->getLine();

									// Check for missing coma

									$lastStoreInitArgumentStatePropertyValueProperty = $storeInitArgumentStatePropertyValueProperty;

									/** @var SourceLocation $lastStoreInitArgumentStatePropertyLocation */
									$lastStoreInitArgumentStatePropertyLocation = $lastStoreInitArgumentStatePropertyValueProperty->getLocation();

									$lastEndLine = $lastStoreInitArgumentStatePropertyLocation->getEnd()->getLine() - 1;
									if (substr(rtrim($newFileContentLines[$lastEndLine]), -1, 1) != ',') {
										$newFileContentLines[$lastEndLine] = rtrim($newFileContentLines[$lastEndLine]) . ',' . "\n";
									}

									$newLines = [
										"\t\t\n",
										"\t\t" . $data['camelCaseModelClassNamePlural'] . ': {' . "\n",
										"\t\t\tdata: [],\n",
										"\t\t\tmeta: {}\n",
										"\t\t},\n",
										"\t\t" . $data['camelCaseModelClassNamePlural'] . 'Loading: true,' . "\n",
									];

									array_splice($newFileContentLines, $endLine - 1, 0, $newLines);
								}
							}
						}
					}
				}
			}
		}

		$newFileContent = implode('', $newFileContentLines);

		if ($this->option('testdump')) {
			dump($newFileContent);
		} else {
			file_put_contents($filePath, $newFileContent);
		}
		return true;
	}

	/**
	 * Alter store.js file for "getters" section
	 *
	 * @param string $filePath file path
	 * @param string[] $data
	 * @return boolean Return false if value already in file
	 */
	protected function alterStoreJsFileGettersSection($filePath, $data)
	{
		$this->info('Altering ' . $filePath);

		$matches = null;
		$fileContent = file_get_contents($filePath);
		$newFileContentLines = file($filePath);

		/** @var \Peast\Syntax\Node\Program $ast */
		$ast = Peast::latest($fileContent, [
			'sourceType' => Peast::SOURCE_TYPE_MODULE
		])->parse();

		$programBody = $ast->getBody();

		/** @var \Peast\Syntax\Node\Node $node */
		foreach ($programBody as $node) {
			if ($node->getType() == 'VariableDeclaration') {
				/** @var VariableDeclaration $variableDeclaration */
				$variableDeclaration = $node;
				foreach ($variableDeclaration->getDeclarations() as $variableDeclarator) {
					/** @var Identifier $identifier */
					$identifier = $variableDeclarator->getId();
					if ($identifier->getName() == 'store') {
						/** @var NewExpression $storeInit */
						$storeInit = $variableDeclarator->getInit();
						/** @var ObjectExpression $storeInitArgument */
						foreach ($storeInit->getArguments() as $storeInitArgument) {
							/** @var Property $storeInitArgumentProperty */
							foreach ($storeInitArgument->getProperties() as $storeInitArgumentProperty) {
								/** @var Identifier $storeInitArgumentPropertyKey */
								$storeInitArgumentPropertyKey = $storeInitArgumentProperty->getKey();
								if ($storeInitArgumentPropertyKey->getName() == 'getters') {
									$storeInitArgumentGettersProperty = $storeInitArgumentProperty;
									/** @var ObjectExpression $storeInitArgumentGettersPropertyValue */
									$storeInitArgumentGettersPropertyValue = $storeInitArgumentGettersProperty->getValue();
									/** @var Property $storeInitArgumentGettersPropertyValueProperty */
									foreach ($storeInitArgumentGettersPropertyValue->getProperties() as $storeInitArgumentGettersPropertyValueProperty) {
										/** @var Identifier $storeInitArgumentGettersPropertyValuePropertyKey */
										$storeInitArgumentGettersPropertyValuePropertyKey = $storeInitArgumentGettersPropertyValueProperty->getKey();
										if ($storeInitArgumentGettersPropertyValuePropertyKey->getName() == $data['camelCaseModelClassNamePlural']) {
											$this->warn('"' . $data['camelCaseModelClassNamePlural'] . '" found in AST, ignore');
											return false;
										}
									}

									/** @var SourceLocation $storeInitArgumentGettersPropertyLocation */
									$storeInitArgumentGettersPropertyLocation = $storeInitArgumentGettersProperty->getLocation();

									// Append new line at the end
									$endLine = $storeInitArgumentGettersPropertyLocation->getEnd()->getLine();

									// Check for missing coma

									$lastStoreInitArgumentGettersPropertyValueProperty = $storeInitArgumentGettersPropertyValueProperty;

									/** @var SourceLocation $lastStoreInitArgumentGettersPropertyLocation */
									$lastStoreInitArgumentGettersPropertyLocation = $lastStoreInitArgumentGettersPropertyValueProperty->getLocation();

									$lastEndLine = $lastStoreInitArgumentGettersPropertyLocation->getEnd()->getLine() - 1;
									if (substr(rtrim($newFileContentLines[$lastEndLine]), -1, 1) != ',') {
										$newFileContentLines[$lastEndLine] = rtrim($newFileContentLines[$lastEndLine]) . ',' . "\n";
									}

									$newLines = [
										"\t\t\n",
										"\t\t" . $data['camelCaseModelClassNamePlural'] . '(state) {' . "\n",
										"\t\t\t" . 'return state.' . $data['camelCaseModelClassNamePlural'] . ';' . "\n",
										"\t\t},\n",
										"\t\t" . $data['camelCaseModelClassNamePlural'] . 'Loading(state) {' . "\n",
										"\t\t\t" . 'return state.' . $data['camelCaseModelClassNamePlural'] . 'Loading;' . "\n",
										"\t\t},\n",
									];

									array_splice($newFileContentLines, $endLine - 1, 0, $newLines);
								}
							}
						}
					}
				}
			}
		}

		$newFileContent = implode('', $newFileContentLines);

		if ($this->option('testdump')) {
			dump($newFileContent);
		} else {
			file_put_contents($filePath, $newFileContent);
		}

		return true;
	}

	/**
	 * Alter store.js file for "mutations" section
	 *
	 * @param string $filePath file path
	 * @param string[] $data
	 * @return boolean Return false if value already in file
	 */
	protected function alterStoreJsFileMutationsSection($filePath, $data)
	{
		$this->info('Altering ' . $filePath);

		$matches = null;
		$fileContent = file_get_contents($filePath);
		$newFileContentLines = file($filePath);

		/** @var \Peast\Syntax\Node\Program $ast */
		$ast = Peast::latest($fileContent, [
			'sourceType' => Peast::SOURCE_TYPE_MODULE
		])->parse();

		$programBody = $ast->getBody();

		/** @var \Peast\Syntax\Node\Node $node */
		foreach ($programBody as $node) {
			if ($node->getType() == 'VariableDeclaration') {
				/** @var VariableDeclaration $variableDeclaration */
				$variableDeclaration = $node;
				foreach ($variableDeclaration->getDeclarations() as $variableDeclarator) {
					/** @var Identifier $identifier */
					$identifier = $variableDeclarator->getId();
					if ($identifier->getName() == 'store') {
						/** @var NewExpression $storeInit */
						$storeInit = $variableDeclarator->getInit();
						/** @var ObjectExpression $storeInitArgument */
						foreach ($storeInit->getArguments() as $storeInitArgument) {
							/** @var Property $storeInitArgumentProperty */
							foreach ($storeInitArgument->getProperties() as $storeInitArgumentProperty) {
								/** @var Identifier $storeInitArgumentPropertyKey */
								$storeInitArgumentPropertyKey = $storeInitArgumentProperty->getKey();
								if ($storeInitArgumentPropertyKey->getName() == 'mutations') {
									$storeInitArgumentMutationsProperty = $storeInitArgumentProperty;
									/** @var ObjectExpression $storeInitArgumentMutationsPropertyValue */
									$storeInitArgumentMutationsPropertyValue = $storeInitArgumentMutationsProperty->getValue();
									/** @var Property $storeInitArgumentMutationsPropertyValueProperty */
									foreach ($storeInitArgumentMutationsPropertyValue->getProperties() as $storeInitArgumentMutationsPropertyValueProperty) {
										/** @var Identifier $storeInitArgumentMutationsPropertyValuePropertyKey */
										$storeInitArgumentMutationsPropertyValuePropertyKey = $storeInitArgumentMutationsPropertyValueProperty->getKey();
										if ($storeInitArgumentMutationsPropertyValuePropertyKey->getName() == 'set' . $data['camelCaseModelClassNamePlural']) {
											$this->warn('"set' . $data['camelCaseModelClassNamePlural'] . '" found in AST, ignore');
											return false;
										}
									}

									/** @var SourceLocation $storeInitArgumentMutationsPropertyLocation */
									$storeInitArgumentMutationsPropertyLocation = $storeInitArgumentMutationsProperty->getLocation();

									// Append new line at the end
									$endLine = $storeInitArgumentMutationsPropertyLocation->getEnd()->getLine();

									// Check for missing coma

									$lastStoreInitArgumentMutationsPropertyValueProperty = $storeInitArgumentMutationsPropertyValueProperty;

									/** @var SourceLocation $lastStoreInitArgumentMutationsPropertyLocation */
									$lastStoreInitArgumentMutationsPropertyLocation = $lastStoreInitArgumentMutationsPropertyValueProperty->getLocation();

									$lastEndLine = $lastStoreInitArgumentMutationsPropertyLocation->getEnd()->getLine() - 1;
									if (substr(rtrim($newFileContentLines[$lastEndLine]), -1, 1) != ',') {
										$newFileContentLines[$lastEndLine] = rtrim($newFileContentLines[$lastEndLine]) . ',' . "\n";
									}

									$newLines = [
										"\t\t\n",
										"\t\t" . 'set' . $data['modelClassNamePlural'] . '(state, ' . $data['camelCaseModelClassNamePlural'] . ') {' . "\n",
										"\t\t\t" . 'state.' . $data['camelCaseModelClassNamePlural'] . ' = ' .$data['camelCaseModelClassNamePlural']. ';' . "\n",
										"\t\t},\n",
										"\t\t" . 'set' . $data['modelClassNamePlural'] . 'Loading(state, loading) {' . "\n",
										"\t\t\t" . 'state.' . $data['camelCaseModelClassNamePlural'] . 'Loading = loading;' . "\n",
										"\t\t},\n",
									];

									array_splice($newFileContentLines, $endLine - 1, 0, $newLines);
								}
							}
						}
					}
				}
			}
		}

		$newFileContent = implode('', $newFileContentLines);

		if ($this->option('testdump')) {
			dump($newFileContent);
		} else {
			file_put_contents($filePath, $newFileContent);
		}

		return true;
	}

	/**
	 * Alter store.js file for "actions" section
	 *
	 * @param string $filePath file path
	 * @param string[] $data
	 * @return boolean Return false if value already in file
	 */
	protected function alterStoreJsFileActionsSection($filePath, $data)
	{
		$this->info('Altering ' . $filePath);

		$matches = null;
		$fileContent = file_get_contents($filePath);
		$newFileContentLines = file($filePath);

		/** @var \Peast\Syntax\Node\Program $ast */
		$ast = Peast::latest($fileContent, [
			'sourceType' => Peast::SOURCE_TYPE_MODULE
		])->parse();

		$programBody = $ast->getBody();

		/** @var \Peast\Syntax\Node\Node $node */
		foreach ($programBody as $node) {
			if ($node->getType() == 'VariableDeclaration') {
				/** @var VariableDeclaration $variableDeclaration */
				$variableDeclaration = $node;
				foreach ($variableDeclaration->getDeclarations() as $variableDeclarator) {
					/** @var Identifier $identifier */
					$identifier = $variableDeclarator->getId();
					if ($identifier->getName() == 'store') {
						/** @var NewExpression $storeInit */
						$storeInit = $variableDeclarator->getInit();
						/** @var ObjectExpression $storeInitArgument */
						foreach ($storeInit->getArguments() as $storeInitArgument) {
							/** @var Property $storeInitArgumentProperty */
							foreach ($storeInitArgument->getProperties() as $storeInitArgumentProperty) {
								/** @var Identifier $storeInitArgumentPropertyKey */
								$storeInitArgumentPropertyKey = $storeInitArgumentProperty->getKey();
								if ($storeInitArgumentPropertyKey->getName() == 'actions') {
									$storeInitArgumentActionsProperty = $storeInitArgumentProperty;
									/** @var ObjectExpression $storeInitArgumentActionsPropertyValue */
									$storeInitArgumentActionsPropertyValue = $storeInitArgumentActionsProperty->getValue();
									/** @var Property $storeInitArgumentActionsPropertyValueProperty */
									foreach ($storeInitArgumentActionsPropertyValue->getProperties() as $storeInitArgumentActionsPropertyValueProperty) {
										/** @var Identifier $storeInitArgumentActionsPropertyValuePropertyKey */
										$storeInitArgumentActionsPropertyValuePropertyKey = $storeInitArgumentActionsPropertyValueProperty->getKey();
										if ($storeInitArgumentActionsPropertyValuePropertyKey->getName() == 'get' . $data['camelCaseModelClassNamePlural']) {
											$this->warn('"get' . $data['camelCaseModelClassNamePlural'] . '" found in AST, ignore');
											return false;
										}
									}

									/** @var SourceLocation $storeInitArgumentActionsPropertyLocation */
									$storeInitArgumentActionsPropertyLocation = $storeInitArgumentActionsProperty->getLocation();

									// Append new line at the end
									$endLine = $storeInitArgumentActionsPropertyLocation->getEnd()->getLine();

									// Check for missing coma

									$lastStoreInitArgumentActionsPropertyValueProperty = $storeInitArgumentActionsPropertyValueProperty;

									/** @var SourceLocation $lastStoreInitArgumentActionsPropertyLocation */
									$lastStoreInitArgumentActionsPropertyLocation = $lastStoreInitArgumentActionsPropertyValueProperty->getLocation();

									$lastEndLine = $lastStoreInitArgumentActionsPropertyLocation->getEnd()->getLine() - 1;
									if (substr(rtrim($newFileContentLines[$lastEndLine]), -1, 1) != ',') {
										$newFileContentLines[$lastEndLine] = rtrim($newFileContentLines[$lastEndLine]) . ',' . "\n";
									}

									$newLines = [
										"\t\t\n",
										"\t\t" . 'get' . $data['modelClassNamePlural'] . '(state, options) {' . "\n",
										"\t\t\t" . 'resourceLoad(state, \'/' . $data['camelCaseModelClassName'] . '\', options, \'' .$data['camelCaseModelClassNamePlural']. '\');' . "\n",
										"\t\t},\n",
									];

									array_splice($newFileContentLines, $endLine - 1, 0, $newLines);
								}
							}
						}
					}
				}
			}
		}

		$newFileContent = implode('', $newFileContentLines);

		if ($this->option('testdump')) {
			dump($newFileContent);
		} else {
			file_put_contents($filePath, $newFileContent);
		}

		return true;
	}

	/**
	 * Alter routes.js file
	 *
	 * @param string $filePath file path
	 * @param string[] $data
	 * @return boolean Return false if value already in file
	 */
	protected function alterRoutesJsFile($filePath, $data)
	{
		$this->info('Altering ' . $filePath);

		$matches = null;
		$fileContent = file_get_contents($filePath);
		$newFileContentLines = file($filePath);

		/** @var \Peast\Syntax\Node\Program $ast */
		$ast = Peast::latest($fileContent, [
			'sourceType' => Peast::SOURCE_TYPE_MODULE
		])->parse();

		$programBody = $ast->getBody();

		/** @var \Peast\Syntax\Node\Node $node */
		foreach ($programBody as $node) {
			if ($node->getType() == 'ExportDefaultDeclaration') {
				/** @var ArrayExpression $declaration */
				$declaration = $node->getDeclaration();
				if ($declaration->getType() == 'ArrayExpression') {
					foreach ($declaration->getElements() as $element) {
						if ($element->getType() == 'ObjectExpression') {
							/** @var Property $property */
							foreach ($element->getProperties() as $property) {
								/** @var Identifier $key */
								$key = $property->getKey();
								if ($key->getName() == $data['kebabCaseModelClassNamePlural']) {
									$this->warn('route path "' . $data['kebabCaseModelClassNamePlural'] . '" found in AST, ignore');
									return false;
								}
								if ($key->getName() == $data['kebabCaseModelClassName']) {
									$this->warn('route path "' . $data['kebabCaseModelClassName'] . '" found in AST, ignore');
									return false;
								}
							}
						}
					}

					/** @var SourceLocation $elementLocation */
					$elementLocation = $element->getLocation();

					// Append new line at the end
					$endLine = $elementLocation->getEnd()->getLine();

					// Check for missing coma

					$lastProperty = $property;

					/** @var SourceLocation $lastPropertyLocation */
					$lastPropertyLocation = $lastProperty->getLocation();

					$lastEndLine = $lastPropertyLocation->getEnd()->getLine() - 1;
					if (substr(rtrim($newFileContentLines[$lastEndLine]), -1, 1) != ',') {
						$newFileContentLines[$lastEndLine] = rtrim($newFileContentLines[$lastEndLine]) . ',' . "\n";
					}

					$newLines = [
						"\t{\n",
						"\t\t" . 'path: \'/' . $data['kebabCaseModelClassNamePlural'] . '\',' . "\n",
						"\t\t" . 'name: \'' . $data['kebabCaseModelClassNamePlural'] . '\',' . "\n",
						"\t\t" . 'component: require(\'./components/dashboard/' . $data['kebabCaseModelClassNamePlural'] . '.vue\'),' . "\n",
						"\t\t" . 'meta: {' . "\n",
						"\t\t\t" . 'breadcrumbIconClass: \'fa fa-sticky-note\',' . "\n",
						"\t\t\t" . 'parentRouteName: \'home\',' . "\n",
						"\t\t" . '}' . "\n",
						"\t},\n",
						"\t{\n",
						"\t\t" . 'path: \'/' . $data['kebabCaseModelClassName'] . '/:' . $data['camelCaseModelClassName'] . 'Id\',' . "\n",
						"\t\t" . 'name: \'' . $data['kebabCaseModelClassName'] . '\',' . "\n",
						"\t\t" . 'component: require(\'./components/dashboard/' . $data['kebabCaseModelClassName'] . '.vue\'),' . "\n",
						"\t\t" . 'props: true,' . "\n",
						"\t\t" . 'meta: {' . "\n",
						"\t\t\t" . 'breadcrumbIconClass: \'fa fa-sticky-note\',' . "\n",
						"\t\t\t" . 'parentRouteName: \'' . $data['kebabCaseModelClassNamePlural'] . '\',' . "\n",
						"\t\t" . '}' . "\n",
						"\t},\n",
					];

					array_splice($newFileContentLines, $endLine, 0, $newLines);
				}
			}
		}

		$newFileContent = implode('', $newFileContentLines);

		if ($this->option('testdump')) {
			dump($newFileContent);
		} else {
			file_put_contents($filePath, $newFileContent);
		}

		return true;
	}

	/**
	 * Alter sidebar-menu.vu file
	 *
	 * @param string $filePath file path
	 * @param string[] $data
	 * @return boolean Return false if value already in file
	 */
	protected function alterSideBarMenuVueFile($filePath, $data)
	{
		$this->info('Altering ' . $filePath);

		$matches = null;
		$fileContent = file_get_contents($filePath);
		$newFileContentLines = file($filePath);

		$crawler = new Crawler($fileContent);
		$uls = $crawler->filter('template > div > ul');

		/** @var integer $fileLineInc Increment lines array of this amount */
		$fileLineInc = 0;

		foreach ($uls as $ul) {
			$askTag = '<ul';
			/** @var DOMAttr $attribute */
			foreach ($ul->attributes as $attribute) {
				$askTag .= ' ' . $attribute->name . '=';
				$askTag .= '"' . $attribute->value . '"';
			}
			$askTag .= '>...</ul>';

			$confirm = $this->confirm('Do you want to add "' . $data['kebabCaseModelClassNamePlural'] . '" route link inside of this html <fg=cyan>ul</> tag ?' . "\n" . '<fg=black;bg=cyan>' . $askTag . '</>');

			if (!$confirm) {
				continue;
			}

			$menuContainerFAIcon = $this->ask('Enter the Font-Awesome icon class name to use for the menu container', 'fa-folder');
			$menuLinkFAIcon = $this->ask('Enter the Font-Awesome icon class name to use for the menu link', 'fa-sticky-note');

			$endLine = $ul->lastChild->getLineNo(); // text after last </li> closing tag

			$newLines = [
				"\t\t\t" . '<li class="treeview">' . "\n",
				"\t\t\t\t" . '<a href="javascript:;">' . "\n",
				"\t\t\t\t\t" . '<i class="fa ' . $menuContainerFAIcon . ' fa-fw"></i>' . "\n",
				"\t\t\t\t\t" . '<span>{{ $t(\'routes.' . $data['kebabCaseModelClassNamePlural'] . '.title\') }}</span> <i class="fa fa-angle-left pull-right"></i>' . "\n",
				"\t\t\t\t" . '</a>' . "\n",
				"\t\t\t\t" . '<ul class="treeview-menu">' . "\n",
				"\t\t\t\t\t" . '<li v-on:click="toggleMenu">' . "\n",
				"\t\t\t\t\t\t" . '<router-link :to="{ name: \'' . $data['kebabCaseModelClassNamePlural'] . '\' }"><i class="fa ' . $menuLinkFAIcon . ' fa-fw"></i>' . "\n",
				"\t\t\t\t\t\t\t" . '<span class="page">{{ $t(\'routes.' . $data['kebabCaseModelClassNamePlural'] . '.title\') }}</span>' . "\n",
				"\t\t\t\t\t\t" . '</router-link>' . "\n",
				"\t\t\t\t\t" . '</li>' . "\n",
				"\t\t\t\t" . '</ul>' . "\n",
				"\t\t\t" . '</li>' . "\n",
			];

			array_splice($newFileContentLines, $endLine + $fileLineInc - 1, 0, $newLines);

			$fileLineInc += count($newLines);
		}

		$newFileContent = implode('', $newFileContentLines);

		if ($this->option('testdump')) {
			dump($newFileContent);
		} else {
			file_put_contents($filePath, $newFileContent);
		}

		return true;
	}
}
