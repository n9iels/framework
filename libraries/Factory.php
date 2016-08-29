<?php
namespace Libraries
{
    class Factory
    {
        public static function getDbo()
        {
            $options = array (
                "driver" => "mysqli",
                "host" => "...",
                "user" => "...",
                "password" => "...",
                "database" => "..."
            );

            // Get database and driver
            $db = new \Libraries\Database\Database();

            return $db->getDriverInstance($options);
        }
    }
}
