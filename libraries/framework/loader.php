<?php
class Loader {
	/**
	* @var  array  Array of all classes
	*/
	public static $path = array();

	/**
	* Register a class to load it manualy
	*
	* @param   string  $class  Name of the class
	*
	* @return  void
	*/
	public static function register($path) {
		self::$path = $path;
	}

	/**
	* Search for the class file and register it for the loader
	*
	* @param   string  $class  Name of the class
	*
	* @return  void
	*/
	public static function discover($class) {
		$class = preg_split('/(?=[A-Z])/', $class, 0, PREG_SPLIT_NO_EMPTY);
		$file  = end($class);

		// Try to find a file via the default convention
		$path = FRAMEWORK_BASE . DIRECTORY_SEPARATOR . strtolower(implode(DIRECTORY_SEPARATOR, $class)) . '.php';

		if (file_exists($path)) {
			self::register($path);

			return true;
		}

		// Try to find a file with the same folder and file name
		$path = FRAMEWORK_BASE . DIRECTORY_SEPARATOR . strtolower($file . DIRECTORY_SEPARATOR . $file) . '.php';

		if (file_exists($path)) {
			self::register($path);

			return true;
		}

		// None of the framework paths was correct, we now search for a application
		$path = APPLICATION_BASE . DIRECTORY_SEPARATOR . strtolower($class[0] . DIRECTORY_SEPARATOR . $class[1] . 's' . DIRECTORY_SEPARATOR . $class[2]) . '.php';
		
		if (count($class) == 3 && file_exists($path)) {
			self::register($path);

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
			require_once self::$path;
		}
	}
}
