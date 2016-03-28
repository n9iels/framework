<?php
class Model {
	/**
	* @var  string  Prefix of the model, which is the name of the application
	*/
	protected $prefix;

	/**
	* @var  string   Name of the model
	*/
	protected $name;

	/**
	* Constructor
	*/
	public function __construct() {
		$class = strtolower(get_class($this));

		$this->prefix = substr($class, 0, strpos($class, "model"));
		$this->name   = substr($class, strpos($class, "model") + 5);
	}
}
