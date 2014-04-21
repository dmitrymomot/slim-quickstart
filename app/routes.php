<?php


/**
 * Example route
 */
$app->get('/', function () use ($app) {
	$app->response->body('Hello World');
})->name('homepage');

$app->any('/hello(/:name)', function ($name = null) use ($app) {
	$name = ($name) ? ucfirst($name) : 'Guest';
	$app->response->body('Hello '.$name.'! ;)');
})->conditions(array('name' => '[a-zA-Z-]++'))->name('hello');
