<?php

namespace App\Controller;

use \App\Controller;
use \App\Model;
use \Slim\MVC;

class Welcome extends MVC\Controller
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
		$model = MVC\Model::factory('Post')->find_many();
		$this->app->render('blog.php', array('posts' => $model, 'title' => 'Blog'));
	}

	public function actionPost()
	{
		$model = MVC\Model::factory('Post')
			->where('url', $this->param('url'))
			->find_one();

		$data = (is_object($model)) ? $model->as_array() : $model;

		$this->app->render('post.php', $data);
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
