<?php

namespace App\Controller;

use \App\Controller;
use \App\Model;

class Welcome extends Controller
{
	public function before()
	{
		parent::before();

		// ...do something before execute the action
	}

	public function actionIndex()
	{
		$model = new Model\Welcome;
		$response = $model->getTestData('Hello World!');
		$this->response->body($response);
	}

	public function actionHello()
	{
		$model = new Model\Welcome;
		$response = $model->sayHelloUser($this->param('name', 'guest'));

		$engine = new \League\Plates\Engine(APPPATH.'views');

		$view = new \League\Plates\Template($engine);
		$view->title = $response;
		$view->content = 'Content: '.$response;
		$view = $view->render('hello');

		$this->response->body($view);
	}

	public function after()
	{
		// ...do something after execute the action

		parent::after();
	}
}
