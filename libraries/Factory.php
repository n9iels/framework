<?php
namespace Libraries
{
	class Factory
	{
		public static function getDbo()
		{
			$options = array (
			    "driver" => "mysqli",
			    "host" => "localhost",
			    "user" => "root",
			    "password" => "root",
			    "database" => "joomla-cms"
			);

			// Get database and driver
			$db = new \Libraries\Database\Database();

			return $db->getDriverInstance($options);
		}
	}
}
