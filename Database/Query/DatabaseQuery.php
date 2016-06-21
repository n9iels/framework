<?php
namespace Database\Query
{

    use Database\Query\DatabaseQueryElement;

    abstract class DatabaseQuery
    {
        /**
         * @var  string  Type of the query
         */
        protected $type;

        /**
         * @var  DatabaseQueryElement  The select element
         */
        protected $select;

        /**
         * @var  DatabaseQueryElement  The from element
         */
        protected $from;

        /**
         * @var  DatabaseQueryElement  The where element
         */
        protected $where;

        /**
         * __toString() method to convert object to query
         */
        public function __toString()
        {
            $query = "";

            switch ($this->type)
            {
                case "select":
                    $query .= (string) $this->select;
                    $query .= (string) $this->from;

                    if (!is_array($this->where))
                    {
                        $query .= (string) $this->where;
                    }
            }
            
            return $query;
        }

        /**
         * Select columns
         *
         * @param  $columns  array  The selected columns
         *
         * @return  DatabaseQuery  Returns this object to allow chaining.
         */
        public function select($columns)
        {
            $this->type = "select";

            if (is_null($this->select)) {
                $this->select = new DatabaseQueryElement("SELECT", $columns);
            } else {
                $this->select->append($columns);
            }

            return $this;
        }

        /**
         * @param  string $table Table name
         *
         * @return  DatabaseQuery  Return this object to allow chaining
         */
        public function from($table)
        {
            if (is_null($this->from)) {
                $this->from = new DatabaseQueryElement("FROM", $table);
            }

            return $this;
        }

        /**
         * @param  mixed  $conditions  Conditions
         *
         * @return  DatabaseQuery  Return this object to allow chaining
         */
        public function where($conditions)
        {
            if (is_null($this->where))
            {
                $this->where = new DatabaseQueryElement("WHERE", $conditions, "AND");
            }
            else
            {
                $this->where->append($conditions);
            }

            return $this;
        }
    }
}