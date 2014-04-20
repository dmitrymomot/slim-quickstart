<?php

namespace App;

abstract class Controller {

	public $app;
	public $request;
	public $response;

	public function __construct(\Slim\Slim $app = NULL)
	{
		$this->app 		= $app;
		$this->request 	= $app->request;
		$this->response = $app->response;
	}

	public function execute($action = NULL)
	{
		$action = ($action == NULL)
			? strtolower($this->request->getMethod())
			: $action;

		$this->before();
		$this->{$action}();
		$this->after();
	}

	public function before()
	{
		// ...
	}

	public function after()
	{
		// ...
	}

	public function param($key = NULL, $default = NULL)
	{
		$params = $this->app->router->getCurrentRoute()->getParams();

		return (array_key_exists($key, $params))
			? $params[$key]
			: $default;
	}
}
