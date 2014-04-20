<?php

namespace App;

class View extends \Slim\View {

	/**
	 * @param string $path
	 * @param array $data
	 * @return string
	 */
	public function layout($path, array $data = NULL)
	{
		$file = $this->getTemplatePathname($path);
	}

	/**
	 * @param string $path
	 * @param array $data
	 * @return string
	 */
	public function widget($widgetName, array $data = NULL)
	{

	}
}
