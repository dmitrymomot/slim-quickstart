<?php

namespace App\Model;

use \Slim\MVC;

class Post extends MVC\Model {

	public static $_table = 'posts';

	public function getUrl()
	{
		return '/blog/'.$this->url;
	}
}
