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
		$dir  = preg_split('/(?=[A-Z])/', $class, 0, PREG_SPLIT_NO_EMPTY);
		$file = array_pop($dir);

		// Try to find a file via the default convention
		$path = strtolower(implode(DIRECTORY_SEPARATOR, $dir). DIRECTORY_SEPARATOR . $file) . '.php';

		if (file_exists($path)) {
			$this->register($class, $path);
		}

		// Try to find a file with the same folder and file name
		$path = strtolower($file . DIRECTORY_SEPARATOR . $file) . '.php';

		if (file_exists($path)) {
			$this->register($class, $path);
		}
	}
}
