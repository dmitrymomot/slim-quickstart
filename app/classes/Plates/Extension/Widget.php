<?php

namespace App\Plates\Extension;

use \App\Plates\Extension\WidgetInterface;
use \League\Plates\Extension\ExtensionInterface;

class Widget implements ExtensionInterface {

    /**
     * Instance of the parent engine.
     * @var Engine
     */
    public $engine;

    /**
     * Instance of the current template.
     * @var Template
     */
    public $template;

    /**
     * @var string
     */
    public $widgetsNamespace;

	/**
	 * Constructor
	 * @return void
	 */
    public function __construct($widgetsNamespace = '\App\Widget')
    {
		$this->widgetsNamespace = '\\'.trim($widgetsNamespace, '\\').'\\';
	}

    /**
     * Get the defined extension functions.
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'widget' 			=> 'getWidget',
            'isWidgetEnable' 	=> 'isEnable',
        );
    }

	/**
	 * @param string $widgetName
	 * @param mixed $data
	 * @return string
	 */
    public function getWidget($widgetName, $data = null)
    {
		$widgetClass = $this->widgetsNamespace.ucfirst($widgetName);

		if ( ! class_exists($widgetClass))	{
			return null;
		}

		$widget = new $widgetClass($data);

		if ( ! $widget instanceof WidgetInterface) {
			throw new \LogicException('Class '.$widgetClass.' must imlements interface \App\Plates\Extension\WidgetInterface');
		}

		return $widget->response();
	}

	/**
	 * Check widget status
	 * @return boolean
	 */
	public function isEnable()
	{
		return false;
	}
}
