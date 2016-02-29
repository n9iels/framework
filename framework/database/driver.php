<?php
abstract class DatabaseDriver {
	/**
	* Name of the choosen database driver
	*
	* @var  string
	*/
	protected $name;

	/**
	* SQL query
	*
	* @var  string
	*/
	protected $sql = null;

	/**
	* Database options
	*
	* @var  array
	*/
	protected $options = array();

	/**
	*
	* @var connection  Connection of the choosen database driver
	*/
	protected $connection;

	/**
	* Get instance of the choosen databaser driver
	*
	* @param   array  $options  Parameters to be passed to the database driver.
	*
	* @return  JDatabaseDriver  A database object.
	*/
	public static function getInstance($options) {
		$class = 'DatabaseDriver' . ucfirst(strtolower($options['driver']));

		if (!class_exists($class)) {
			throw new RuntimeException(sprintf('Unable to load Database Driver: %s', $options['driver']));
		}

		// When instance the driver, the database connection is directly made
		try
		{
			$instance = new $class($options);
		}
		catch (RuntimeException $e)
		{
			throw new RuntimeException(sprintf('Unable to instance Database Driver %s', $e->getMessage()), $e->getCode(), $e);
		}

		return $instance;
	}

	/**
	* Get instance of the query class of the choosen driver
	*
	* @return DatabaseQuery<driver>   DatabaseQuery object
	*/
	public function getQuery() {
		$class = 'DatabaseQuery' . ucfirst(strtolower($this->name));

		if (!class_exists($class)) {
			throw new RuntimeException(sprintf('Unable to load DatabaseQuery: %s', $this->name));
		}

		// When instance the driver, the database connection is directly made
		try
		{
			$instance = new $class;
		}
		catch (RuntimeException $e)
		{
			throw new RuntimeException(sprintf('Unable to instance DatabaseQuery %s', $e->getMessage()), $e->getCode(), $e);
		}

		return $instance;
	}

	/**
	* Set query to execute
	*/
	public function setQuery($query) {
		$this->sql = $query;
	}
}
