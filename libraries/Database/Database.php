<?php
namespace Libraries\Database
{
    class Database
    {
        /**
         * @param  array  $options  Connection options
         *
         * @return  mixed  Instance of the choosen driver, otherwise an exception
         *
         * @throws \Exception
         */
        public function getDriverInstance($options)
        {
            $class = "Libraries\\Database\\Driver\\DatabaseDriver" . ucfirst(strtolower($options['driver']));

            if (!class_exists($class)) {
                throw new \Exception(sprintf("The database driver '%s' does not exist", $class));
            }

            try {
                $instance = new $class($options);
            } catch (\RuntimeException $e) {
                throw new \Exception("Unable to connect to the database");
            }

            return $instance;
        }
    }
}
