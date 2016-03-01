<?php
class Loader {
	/**
	* @var  array  Array of all classes
	*/
	protected $classes = array();

	/**
	* Register a class to load it manualy
	*
	* @param   string  $class  Name of the class
	*
	* @return  void
	*/
	public static function register($class, $path) {
		$this->classes[$class] = $path;
	}

	/**
	* Search for the class file and register it for the loader
	*
	* @param   string  $class  Name of the class
	*
	* @return  void
	*/
	public function discover($class) {
		$dir_path = strtolower(implode(DIRECTORY_SEPARATOR, preg_split('/(?=[A-Z])/', $class, 0, PREG_SPLIT_NO_EMPTY)));
		$file     = strtolower(implode(DIRECTORY_SEPARATOR, array_pop($dir_path)));
	}
}
