<?php

// Get the start timers for profiler
define('APP_START_TIME', microtime(true));
define('APP_START_MEM', memory_get_usage());

/**
 * Configure the local of the base files
 */
define('DOCROOT', __DIR__ . DIRECTORY_SEPARATOR);
define('APPPATH', realpath(__DIR__ . '/../') . DIRECTORY_SEPARATOR);
define('APPNAME', pathinfo(APPPATH, PATHINFO_BASENAME));
define('COREPATH', realpath(__DIR__ . '/../../core/') . DIRECTORY_SEPARATOR);
define('PKGPATH', realpath(__DIR__ . '/../../packages/') . DIRECTORY_SEPARATOR);

/**
 * Sets the current environment [development, production, test ]
 */
define('ENVIRONMENT', (isset($_SERVER['ENVIRONMENT']) ? $_SERVER['ENVIRONMENT'] : 'production'));

/**
 * Use the global pre-cache to load all required classes
 * and config files from a single file. Remember to generate
 * the cache using the Coffee GUI Tool
 */
ENVIRONMENT === 'production' and define('USE_PRE_CACHE', true);

// Bootstrap the system
include COREPATH . 'Bootstrap.php';

// Make the request
try
{
	Core\Request::getInstance()->dispatch(Core\Router::resolve())->send();
}
catch (Core\HttpNotFoundException $e)
{
	try
	{
		Core\Request::getInstance()->dispatch(Core\Config::get('routes.error_404'))->send();
	}
	catch (Core\HttpNotFoundException $e)
	{
		echo $e->getMessage();
	}
}