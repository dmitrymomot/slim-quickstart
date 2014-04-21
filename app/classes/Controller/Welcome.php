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

	public function actionBlog()
	{
		// var_dump(property_exists('\App\Model\Post', '_table'));
		$model = Model::factory('Post')
			->where('id', 1)
			->find_array();

		var_dump($model);
		// $this->response->body($response);
	}

	public function actionHello()
	{
		$model = new Model\Welcome;
		$response = $model->sayHelloUser($this->param('name', 'guest'));

		$view = $this->app->view();
		$view->title = $response;
		$view->content = 'Content: '.$response;
		$this->app->render('hello.php');

		// $this->response->body($view);
	}

	public function actionExternal()
	{
		$url = $this->param('url', 'none');
		$model = new Model\Welcome;
		$response = $model->getExternal($url);
		$this->response->body($response);
	}

	public function after()
	{
		// ...do something after execute the action

		parent::after();
	}
}
