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
}