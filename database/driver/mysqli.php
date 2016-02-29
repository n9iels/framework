<?php
class DatabaseDriverMysqli extends DatabaseDriver {
	/**
	* Name of the choosen database driver
	*
	* @var  string
	*/
	protected $name = 'myqli';

	/**
	*
	* @var connection  Connection of the choosen database driver
	*/
	protected $connection;

	/**
	* Constructor to connect to the database
	*
	* @param  $options  The database options
	**/
	public function __construct($options) {
		// Don't connect if we have allready a connection
		if ($this->connection) {
			return;
		}

		isset($options['host'] ? $options['host'] : 'localhost';
		isset($options['user'] ? $options['user'] : 'root';
		isset($options['password'] ? $options['password'] : 'root';
		isset($options['port']) ? $options['port'] : '3306';

		$this->connection = mysqli_connect(
			$options['host'], $options['users'], $options['password'], $options['database'], $options['port']
		);

		if (!$this->connection) {
			throw new RuntimeException("Could not connect to mysql");
		}
	}
}
