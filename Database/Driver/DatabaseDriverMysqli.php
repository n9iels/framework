<?php
namespace Database\Driver
{
    class DatabaseDriverMysqli extends DatabaseDriver
    {
        /**
         * Connect to the database
         *
         * @param  array  $options  Connection options
         *
         * @return void
         *
         * @throws \Exception
         */
        public function connect(array $options)
        {
            $this->connection = mysqli_connect($options['host'], $options['user'], $options['password'], $options['database']);

            if (!$this->connection)
            {
                throw new \Exception("Could not connect to mysqli");
            }
        }

        /**
         * Execute the query and set the result property
         *
         * @return void
         */
        public function execute()
        {
            $this->result = mysqli_query($this->connection, $this->query);

            if (!$this->result)
            {
                printf("Error: %s\n", $this->connection->error);
            }
        }

        /**
         * Fetch a single object of the result
         *
         * @return  mixed  Result object
         */
        public function fetchObject()
        {
            return mysqli_fetch_object($this->result);
        }

        /**
         * Fetch a single result as array
         *
         * @return  array  Result as array
         */
        public function fetchAssoc()
        {
            return mysqli_fetch_assoc($this->result);
        }
    }
}