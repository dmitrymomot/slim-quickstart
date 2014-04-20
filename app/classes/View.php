<?php

namespace App;

use \Slim;
use \League\Plates;

class View extends Slim\View {

	/**
	 * @var instance of class \League\Plates\Engine
	 */
	public $engine;

	/**
	 * @var instance of class \League\Plates\Engine
	 */
	public $view;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
		parent::__construct();

        $this->engine 	= new Plates\Engine();
        $this->view 	= $this->engine->makeTemplate();

        $this->engine->loadExtension(new \App\Plates\Extension\Widget('\App\Widget'));
    }

    /**
     * Return view data value with key
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->data->get($key);
	}

    /**
     * Set view data value with key
     * @param string $key
     * @param mixed $value
     */
    public function __set($key, $value)
    {
        $this->data->set($key, $value);
	}

    /**
     * Set the base directory that contains view templates
     *
     * @param string $directory
     * @return void
     */
    public function setTemplatesDirectory($directory)
    {
        $this->templatesDirectory = rtrim($directory, DIRECTORY_SEPARATOR);
		$this->engine->setDirectory($this->getTemplatesDirectory());
    }

    /**
     * Render a template file
     *
     * NOTE: This method should be overridden by custom view subclasses
     *
     * @param  string $template     The template pathname, relative to the template base directory
     * @param  array  $data         Any additonal data to be passed to the template.
     * @return string               The rendered template
     * @throws \RuntimeException    If resolved template pathname is not a valid file
     */
    protected function render($template, $data = null)
    {
        $templatePathname = $this->getTemplatePathname($template);
        if (!is_file($templatePathname)) {
            throw new \RuntimeException("View cannot render `$template` because the template does not exist");
        }

        $template 	= rtrim($template, '.php');
        $data 		= array_merge($this->data->all(), (array) $data);

        return $this->view->render($template, $data);
    }
}
