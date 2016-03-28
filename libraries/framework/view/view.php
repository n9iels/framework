<?php
class View {
	/**
	* @var  string  Prefix of the view, which is the name of the application
	*/
	protected $prefix;

	/**
	* @var  string   Name of the view
	*/
	protected $name;

	/**
	* Constructor
	*/
	public function __construct() {
		$class = strtolower(get_class($this));

		$this->prefix = substr($class, 0, strpos($class, "view"));
		$this->name   = substr($class, strpos($class, "view") + 4);
	}
}
