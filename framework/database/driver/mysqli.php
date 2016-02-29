<?php
class DatabaseDriverMysqli extends DatabaseDriver {
	/**
	* Name of the choosen database driver
	*
	* @var  string
	*/
	protected $name = 'mysqli';

	/**
	* SQL query
	*
	* @var  string
	*/
	protected $sql = null;

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

		isset($options['host']) ? $options['host'] : 'localhost';
		isset($options['user']) ? $options['user'] : 'root';
		isset($options['password']) ? $options['password'] : 'root';

		$this->connection = mysqli_connect(
			$options['host'], $options['user'], $options['password'], $options['database']
		);

		if (!$this->connection) {
			throw new RuntimeException("Could not connect to mysql");
		}
	}

	/**
	* Execute the SQL query
	*/
	public function execute() {
		$result = $this->connection->query($this->sql);

		if (!$result) {
			printf("Error when executing query: %s\n", $this->connection->error);
		}
	}
}
