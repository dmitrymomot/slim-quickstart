<?php

$app->get('/', function () use ($app) {
	$controller = new \App\Controller\Welcome($app);
	$controller->execute('actionIndex');
});

$app->get('/hello(/:name)', function ($name = null) use ($app) {
	$controller = new \App\Controller\Welcome($app);
	$controller->execute('actionHello');
});