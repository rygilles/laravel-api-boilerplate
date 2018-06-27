<?php

return PhpCsFixer\Config::create()
	->setIndent("\t")
	->setRules([
	    'indentation_type' => true,
		'array_indentation' => true,
		'line_ending' => true,
	])
	->setFinder(PhpCsFixer\Finder::create()
		->exclude('vendor')
		->exclude('storage')
		->exclude('bootstrap')
		->exclude('node_modules')
		->in(__DIR__)
	)
;