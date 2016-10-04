<?php
namespace Libraries\Database\Query
{
    class DatabaseQueryElement
    {
        /**
         * @var  string  Name of the element
         */
        private $name;

        /**
         * @var  array  Elements that are selected
         */
        private $elements;

        /**
         * @var  string  Seperator for the element array
         */
        private $glue;
        
        /**
         * DatabaseQueryElement constructor.
         * @param  string  $name      Name of the element
         * @param  array   $elements  List of elements
         * @param  string  $glue      Seperator for the element array
         */
        public function __construct($name, $elements, $glue = ",")
        {
            $this->name     = $name;
            $this->elements = array();
            $this->glue     = $glue;

            $this->append($elements);
        }

        /**
         * __toString() method to convert the element to a piece of a query
         *
         * @return string  query
         */
        public function __toString()
        {
            return PHP_EOL . $this->name . ' ' . implode($this->glue, $this->elements);
        }

        /**
         * @param  array  $elements  List of elements
         */
        public function append($elements)
        {
            if (is_array($elements)) {
                $this->elements = array_merge($elements, $this->elements);
            } else {
                $this->elements = array_merge(array($elements), $this->elements);
            }
        }
    }
}