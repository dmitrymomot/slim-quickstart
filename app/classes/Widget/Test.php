<?php

namespace App\Widget;

class Test extends \App\Widget implements \App\Plates\Extension\WidgetInterface {

	public function response()
	{
		$this->templatePath = APPPATH.'views';

		$response = __CLASS__.'::'.__FUNCTION__;
		return $this->render('widgets/test', array('content' => $response));
	}
}
