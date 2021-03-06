<?php
namespace Libraries\Database\Driver
{
    use Libraries\Database\Query\DatabaseQuery;

    abstract class DatabaseDriver implements IDatabaseDriver
    {
        /**
         * @var  mixed  Connection object
         */
        protected $connection;

        /**
         * @var  array  Connection options
         */
        protected $options;

        /**
         * @var  string  SQL query
         */
        protected $query;

        /**
         * @var  mixed  Result object
         */
        protected $result;

        /**
         * DatabaseDriver constructor.
         *
         * @param  array  $options  Connection options
         */
        public function __construct($options)
        {
            $this->options = $options;

            $this->connect($options);
        }

        /**
         * Get the the query object of the choosen driver
         *
         * @return  mixed  DatabaseQuery instance, otherwise an exception
         *
         * @throws \Exception
         */
        public function getQuery()
        {
            $class = "Libraries\\Database\\Query\\DatabaseQuery" . ucfirst(strtolower($this->options['driver']));

            if (!class_exists($class)) {
                throw new \Exception(sprintf("DatabaseQuery '%s' was not found", $class));
            }

            try {
                $instance = new $class;
            } catch (\RuntimeException $e) {
                throw new \Exception("DatabaseQuery object was not found");
            }

            return $instance;
        }

        /**
         * Set the query property
         *
         * @param  DatabaseQuery  $query  Database query object
         */
        public function setQuery(DatabaseQuery $query)
        {
            if (!$this->connection) {
                $this->connect($this->options);
            }

            $this->query = $query;
        }

        /**
         * Fetch the result as an object list
         *
         * @return  array  Array of results with objects
         */
        public function fetchObjectList()
        {
            $list = array();

            while ($row = $this->fetchObject()) {
                $list[] = $row;
            }

            return $list;
        }

        /**
         * Fetch the result as an array
         *
         * @return array  Array of results
         */
        public function fetchArray()
        {
            $list = array();

            while ($row = $this->fetchAssoc()) {
                $list[] = $row;
            }

            return $list;
        }

        /**
         * Quote a table name for a save usage
         *
         * @param  string  $name  Table name that should be quoted
         *
         * @return  string
         */
        public function quoteName($name)
        {
            return "`" . $name . "`";
        }

        /**
         * Quote a string for a save usage
         *
         * @param  string  $name  String that should be quote
         *
         * @return  string
         */
        public function quote($name)
        {
            return "'" . $name . "'";
        }

        /**
         * Connect to the database
         *
         * @param  array  $options  Connection options
         *
         * @return void
         */
        abstract public function connect(array $options);

        /**
         * Execute the query and set the result property
         *
         * @return void
         */
        abstract public function execute();

        /**
         * Fetch a single object of the result
         *
         * @return  mixed  Result object
         */
        abstract public function fetchObject();

        /**
         * Fetch a single result as array
         *
         * @return  array  Result as array
         */
        abstract public function fetchAssoc();
    }
}