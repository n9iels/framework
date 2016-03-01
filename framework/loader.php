<?php
class Loader {
	/**
	* @var  array  Array of all classes
	*/
	public static $class = array();

	/**
	* Register a class to load it manualy
	*
	* @param   string  $class  Name of the class
	*
	* @return  void
	*/
	public static function register($class, $path) {
		self::$class[$class] = $path;
	}

	/**
	* Search for the class file and register it for the loader
	*
	* @param   string  $class  Name of the class
	*
	* @return  void
	*/
	public static function discover($class) {
		$dir  = preg_split('/(?=[A-Z])/', $class, 0, PREG_SPLIT_NO_EMPTY);
		$file = array_pop($dir);

		// Try to find a file via the default convention
		$path = FRAMEWORK_BASE . strtolower(implode(DIRECTORY_SEPARATOR, $dir). DIRECTORY_SEPARATOR . $file) . '.php';

		if (file_exists($path)) {
			self::register($class, $path);

			return true;
		}

		// Try to find a file with the same folder and file name
		$path = FRAMEWORK_BASE . strtolower($file . DIRECTORY_SEPARATOR . $file) . '.php';

		if (file_exists($path)) {
			self::register($class, $path);

			return true;
		}

		return false;
	}

	/**
	* Load all class file
	*
	* @return  void
	*/
	public static function load($class) {
		$discover = self::discover($class);

		if ($discover === true) {
			require_once self::$class[$class];
		}
	}
}
