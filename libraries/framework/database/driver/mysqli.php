<?php
class DatabaseDriverMysqli extends DatabaseDriver {
	/**
	* @var  string  Name of the choosen database driver
	*/
	protected $name = 'mysqli';

	/**
	* @var  string  SQL query
	*/
	protected $sql = null;

	/**
	* @var  array  Database options
	*/
	protected $options = array();

	/**
	* @var connection  Connection of the choosen database driver
	*/
	protected $connection;

	/**
	* Constructor to connect to the database
	*
	* @param  $options  The database options
	**/
	public function __construct($options) {
		// Set options
		$this->options = $options;

		// Don't connect if we have allready a connection
		if ($this->connection) {
			return;
		}

		isset($this->options['host']) ? $this->options['host'] : 'localhost';
		isset($this->options['user']) ? $this->options['user'] : 'root';
		isset($this->options['password']) ? $this->options['password'] : 'root';

		$this->connection = mysqli_connect(
			$this->options['host'], $this->options['user'], $this->options['password'], $this->options['database']
		);

		if (!$this->connection) {
			throw new RuntimeException("Could not connect to mysql");
		}
	}

	/**
	* Execute the SQL query
	*/
	public function execute() {
		$query = str_replace('#__', $this->options['prefix'], $this->sql);
		$result = $this->connection->query($query);

		if (!$result) {
			printf("Error when executing query: %s\n", $this->connection->error);
		}
	}
}
