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

$app->get('/blog', function () use ($app) {
	$controller = new \App\Controller\Welcome($app);
	$controller->execute('actionBlog');
});
