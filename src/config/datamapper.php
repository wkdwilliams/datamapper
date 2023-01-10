<?php

return [
	// The namespace to be used when creating an entity resource
	'namespace' => 'App',

	// The directory to output the created entity resource
	'outDir'    => 'App',

	// Enable/disable the caching of repository results
	'useCache'  => env('DATAMAPPER_USE_CACHE', false)
];
