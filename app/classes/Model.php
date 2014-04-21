<?php

namespace App;

use \IdiormParis;

class Model extends IdiormParis\Model {

	/**
	 * Set a prefix for model names. This can be a namespace or any other
	 * abitrary prefix such as the PEAR naming convention.
	 * @example Model::$auto_prefix_models = 'MyProject_MyModels_'; //PEAR
	 * @example Model::$auto_prefix_models = '\MyProject\MyModels\'; //Namespaces
	 * @var string
	 */
	public static $auto_prefix_models = '\App\Model\\';

	/**
	 * Table name
	 * @var string
	 */
	public static $_table;

	/**
	 * Factory method used to acquire instances of the given class.
	 * The class name should be supplied as a string, and the class
	 * should already have been loaded by PHP (or a suitable autoloader
	 * should exist). This method actually returns a wrapped ORM object
	 * which allows a database query to be built. The wrapped ORM object is
	 * responsible for returning instances of the correct class when
	 * its find_one or find_many methods are called.
	 */
	public static function factory($class_name, $connection_name = 'default')
	{
		$config = static::getConfig($connection_name);
		if ( ! isset($config[$connection_name])) {
			throw new \Exception('Not set '.$connection_name.' connection in file APPPATH/config/database.php');
		}
		static::setConfig($config[$connection_name]);
		return parent::factory($class_name, $connection_name);
	}

	/**
	 * Load config from file APPPATH/config/database.php
	 *
	 * @param string $connection_name
	 * @return array|false
	 */
	public static function getConfig($connection_name = null)
	{
		$config = APPPATH.'config/database.php';
		if (file_exists($config)) {
			return include $config;
		}
		return false;
	}

	/**
	 * Configure IdiormParis\ORM
	 *
	 * @param array $data
	 * @param string $connection_name
	 * @return void
	 */
	public static function setConfig(array $data, $connection_name = 'default')
	{
		IdiormParis\ORM::configure($data, null, $connection_name);
	}
}
