<?php

$app->get('/', function () use ($app) {
	$controller = new \App\Controller\Welcome($app);
	$controller->execute('actionIndex');
});

$app->get('/hello(/:name)', function ($name = null) use ($app) {
	$controller = new \App\Controller\Welcome($app);
	$controller->execute('actionHello');
});

$app->get('/get(/:url)', function ($name = null) use ($app) {
	$controller = new \App\Controller\Welcome($app);
	$controller->execute('actionExternal');
})->conditions(array('url' => '.+'));

$app->get('/blog(/(:url))', function ($url = null) use ($app) {
	$controller = new \App\Controller\Welcome($app);
	$action = ($url) ? 'actionPost' : 'actionBlog';
	$controller->execute($action);
})->conditions(array('url' => '[0-9a-zA-Z-]++'));
