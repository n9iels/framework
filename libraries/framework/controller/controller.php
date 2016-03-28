<?php
class Controller {
	/**
	* @var  string  Prefix of the controller, which is the name of the application
	*/
	protected $prefix;

	/**
	* @var  string   Name of the controller
	*/
	protected $name;

	/**
	* @var  object  Instance of the corresponding model
	*/
	protected $model;

	/**
	* @var  object  Instance of the corresponding view
	*/
	protected $view;

	/**
	* Constructor
	*/
	public function __construct() {
		// Get parent class
		$class = strtolower(get_class($this));

		// Set prefix and name
		$this->prefix = substr($class, 0, strpos($class, "controller"));
		$this->name   = substr($class, strpos($class, "controller") + 10);

		// Instance corresponding model and view
		$this->model = $this->getModel();
		$this->view  = $this->getView();
	}

	/**
	* Get the corresponding model for the controller
	*/
	protected function getModel() {
		$class = ucfirst($this->prefix) . 'Model' . ucfirst($this->name);

		$this->model = new $class;
	}

	/**
	* Get the corresponding view for the controller
	*/
	protected function getView() {
		$class = ucfirst($this->prefix) . 'View' . ucfirst($this->name);

		$this->view = new $class;
	}
}
