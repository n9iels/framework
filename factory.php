<?php
abstract class Factory {
	/**
	* Get database connection
	*
	* @return  JDatabaseDriver
	*/
	public static function getDbo() {
		$host     = 'localhost';
		$user     = 'root';
		$password = 'root';
		$database = 'sandbox';
		$prefix   = 'sand_';
		$driver   = 'mysqli';
		$port     = '';

		$options = array('driver' => $driver, 'host' => $host, 'user' => $user, 'password' => $password, 'database' => $database, 'prefix' => $prefix, 'port' => $port);

		try
		{
			$db = DatabaseDriver::getInstance($options);
		}
		catch (RuntimeException $e)
		{
			if (!headers_sent())
			{
				header('HTTP/1.1 500 Internal Server Error');
			}

			exit('Database Error: ' . $e->getMessage());
		}

		return $db;
	}
}
