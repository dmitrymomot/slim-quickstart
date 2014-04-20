<?php

namespace App;

abstract class Widget {

	public $data;
	public $templatePath;

	public function __construct($data = null)
	{
		$this->data = $data;
	}

	public function render($view, array $data = null)
	{
		$engine = new \League\Plates\Engine($this->templatePath);
		$template = new \League\Plates\Template($engine);
		return $template->render($view, $data);
	}
}
