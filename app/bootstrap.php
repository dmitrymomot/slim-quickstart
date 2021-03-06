<?php

/**
 * Set the PHP error reporting level. If you set this in php.ini, you remove this.
 * @link http://www.php.net/manual/errorfunc.configuration#ini.error-reporting
 *
 * When developing your application, it is highly recommended to enable notices
 * and strict warnings. Enable them by using: E_ALL | E_STRICT
 *
 * In a production environment, it is safe to ignore notices and strict warnings.
 * Disable them by using: E_ALL ^ E_NOTICE
 *
 * When using a legacy application with PHP >= 5.3, it is recommended to disable
 * deprecated notices. Disable with: E_ALL & ~E_DEPRECATED
 */
error_reporting(E_ALL | E_STRICT);

/**
 * Set the default time zone.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/timezones
 */
date_default_timezone_set('Europe/London');

/**
 * Set the default locale.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/function.setlocale
 */
setlocale(LC_ALL, 'en_EN.utf-8');

/**
 * Set the mb_substitute_character to "none"
 *
 * @link http://www.php.net/manual/function.mb-substitute-character.php
 */
mb_substitute_character('none');

/**
 * Define the start time of the application, used for profiling.
 */
if ( ! defined('START_TIME')) {
	define('START_TIME', microtime(true));
}

/**
 * Define the memory usage at the start of the application, used for profiling.
 */
if ( ! defined('START_MEMORY')) {
	define('START_MEMORY', memory_get_usage());
}

/**
 * Define path to classes of application
 */
if ( ! defined('APPPATH')) {
	define('APPPATH', DOCROOT.'../app'.DIRECTORY_SEPARATOR);
}

/**
 * Set autoloader of composer
 */
require DOCROOT.'../vendor/autoload.php';

/**
 * Load connfig from file
 * @param string $config
 * @return array
 */
if ( ! function_exists('_loadConfig')) {
	function _loadConfig($config) {
		$file = APPPATH.'config'.DIRECTORY_SEPARATOR.$config.'.php';
		if (file_exists($file)) {
			return include $file;
		}
		return array();
	}
}

/**
 * Prepare app
 */
$app = new \Slim\Slim(_loadConfig('app/general'));
// $app->setName('Slim Framework Quickstart');

/**
 * Only invoked if mode is "production"
 */
$app->configureMode('production', function () use ($app) {
    $app->config(_loadConfig('app/production'));
});

/**
 * Only invoked if mode is "development"
 */
$app->configureMode('development', function () use ($app) {
    $app->config(_loadConfig('app/development'));
});

/**
 * Create monolog logger and store logger in container as singleton
 * (Singleton resources retrieve the same log resource definition each time)
 * @todo set custom error handler
 */
$app->container->singleton('log', function () use ($app) {

	$logpath = APPPATH.'logs/'.date('Y/m');
	$logfile = $logpath.'/'.date('d').'.log';

	$old = umask(0);

	if ( ! is_dir($logpath)) {
		mkdir($logpath, 0777, true);
	}

	if ( ! is_writable($logpath)) {
		chmod($logfile, 0777);
	}

	if ( ! file_exists($logfile)) {
		file_put_contents($logfile, '');
	}

	umask($old);

    $log = new \Monolog\Logger(strtoupper($app->request->getHost()));
    $log->pushHandler(new \Monolog\Handler\StreamHandler($logfile, \Monolog\Logger::DEBUG, true, 0777));

    return $log;
});

/**
 * Register handlers
 */
\Monolog\ErrorHandler::register($app->log);

/**
 * Error handle
 */
$app->error(function (\Exception $e) use ($app) {
	$app->applyHook('log.request.info', $e->getMessage());
	$app->log->error($e);
    $app->render('error.php');
});

$app->notFound(function () use ($app) {
	$app->applyHook('log.request.info', 'Page not found');
    $app->render('404.php');
});

// throw new \Exception('test error');
/**
 * Define hooks
 */
if (file_exists(APPPATH.'hooks.php')) {
	require APPPATH.'hooks.php';
}

/**
 * Define routes
 */
if (file_exists(APPPATH.'routes.php')) {
	require APPPATH.'routes.php';
}

/**
 * Run application
 */
$app->run();
