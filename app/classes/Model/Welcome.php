<?php

namespace App\Model;

use \App\Model;

class Welcome extends Model {

	public function getTestData($someParam = NULL)
	{
		return __CLASS__ .'::'. __FUNCTION__ . '('.$someParam.')';
	}

	public function sayHelloUser($username)
	{
		return 'Hello '.ucfirst($username).'!';
	}

	public function getExternal($url)
	{
		$response = \Httpful\Request::get($url)->send();
		return $response;
	}

	public function testORM()
	{
		// A named connection, where 'remote' is an arbitrary key name
		\IdiormParis\ORM::configure('mysql:host=localhost;dbname=slim_test');
		\IdiormParis\ORM::configure('username', 'slim_test');
		\IdiormParis\ORM::configure('password', 'slim_test');

		$posts = \IdiormParis\ORM::for_table('posts')->find_many();

		foreach ($posts as $post)
		{
			var_dump($post->title);
		}


		// var_dump($posts);
	}
}
