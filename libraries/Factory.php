<?php
namespace Libraries
{
    class Factory
    {
        public static function getDbo()
        {
            $options = array (
                "driver" => "mysqli",
                "host" => "eilandn.asuscomm.com",
                "user" => "henk",
                "password" => "dday2009",
                "database" => "project4"
            );

            // Get database and driver
            $db = new \Libraries\Database\Database();

            return $db->getDriverInstance($options);
        }
    }
}
