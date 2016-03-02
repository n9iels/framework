<?php
class DatabaseQueryElement {
	/**
	* @var string  Name of the element
	*/
	protected $name = null;

	/**
	* @var array Array of query elements
	*/
	protected $elements = null;

	/**
	* @var string Glue for concatenate elements
	*/
	protected $glue = null;

	/**
	* Constructor
	*
	* @param  string  $name      Name of the element
	* @param  array   $elements  Array of query elements
	* @param  string  $glue      Glue for join the condition, ',' by default
	*/
	public function __construct($name, $elements, $glue = ',') {
		$this->name     = $name;
		$this->elements = array();
		$this->glue     = $glue;

		$this->append($elements);
	}

	/**
	* Magic method to convert element to string
	*/
	public function __toString() {
		if (substr($this->name, -2) == '()')
		{
			return PHP_EOL . '(' . implode($this->glue, $this->elements) . ')';
		}
		else
		{
			return PHP_EOL . $this->name . ' ' . implode($this->glue, $this->elements);
		}
	}

	/**
	* Append function to add a element to the elements array
	*
	* @param  string  $element  Element for the elements array
	*/
	public function append($element) {
		if (is_array($element)) {
			$this->elements = array_merge($this->elements, $element);
		} else {
			$this->elements = array_merge($this->elements, array($element));
		}
	}
}
