<?php
class DatabaseQuery {
	/**
	* @var  string  SQL query
	*/
	protected $sql = null;

	/**
	* @var  string  Type of query
	*/
	protected $type = null;

	/**
	* @var  DatabaseQueryElement  Select element
	*/
	protected $select = null;

	/**
	* @var  DatabaseQueryElement  Delete element
	*/
	protected $delete = null;

	/**
	* @var  DatabaseQueryElement  Update element
	*/
	protected $update = null;

	/**
	* @var  DatabaseQueryElement  Where element
	*/
	protected $where = null;

	/**
	* @var  DatabaseQueryElement  Insert element
	*/
	protected $insert = null;

	/**
	* @var  DatabaseQueryElement  Columns for the INSERT clause
	*/
	protected $columns = null;

	/**
	* @var  DatabaseQueryElement  Values element
	*/
	protected $values = null;

	/**
	* @var  DatabaseQueryElement  Set element
	*/
	protected $set = null;

	/**
	* @var  DatabaseQueryElement  From element
	*/
	protected $from = null;

	/**
	* @var  DatabaseQueryElement  orderby element
	*/
	protected $order = null;

	/**
	* Magic method for building the SQL query
	*/
	public function __toString() {
		$query = '';

		if (!is_null($this->sql) {
			return $this->sql;
		}
		else {
			switch($this->type) {
				case 'select':
					$query .= $this->select;
					$query .= $this->from;

					if ($this->where) {
						$query .= $this->where;
					}

					if ($this->order) {
						$query .= $this->order;
					}
					break;
				case 'delete':
					$query .= $this->delete;
					$query .= $this->from;

					if ($this->where) {
						$query .= $this->where;
					}
					break;
				case 'update':
					$query .= $this->update;
					$query .= $this->from;
					$query .= $this->set;

					if ($this->where) {
						$query .= $this->where;
					}
					break;
				case 'insert':
					$query .= $this->insert;

					if ($this->columns) {
						$query .= '(' . $this->columns . ')';
					}

					$query .= '(' . $this->values . ')';
			}

			return $query;
		}
	}

	/**
	* Select data from the database
	*
	* @param   array  $columns  Array of field names
	*
	* @return  DatabaseQuery  Returns this object to allow chaining.
	*/
	public function select($columns) {
		$this->type = 'select';

		if (is_null($this->select)) {
			$this->select = new DatabaseQueryElement('SELECT', $columns);
		} else {
			$this->select->append($columns);
		}

		return $this;
	}

	/**
	* Delete data from the database
	*
	* @param   array  $table  Database table
	*
	* @return  DatabaseQuery  Returns this object to allow chaining.
	*/
	public function delete($table) {
		$this->type   = 'delete';
		$this->delete = new DatabaseQueryElement('DELETE', null);
		$this->from($table);

		return $this;
	}

	/**
	* Update data from the database
	*
	* @param   array  $table  Database table
	*
	* @return  DatabaseQuery  Returns this object to allow chaining.
	*/
	public function update($table) {
		$this->type   = 'update';
		$this->update = new DatabaseQueryElement('UPDATE', null);
		$this->from($table);

		return $this;
	}

	/**
	* The WHERE clause of the query
	*
	* @param   array  $columns  Array of field names
	*
	* @return  DatabaseQuery  Returns this object to allow chaining.
	*/
	public function where($conditions, $glue = 'AND') {
		if (is_null($this->where)) {
			$this->where = new DatabaseQueryElement('WHERE', $conditions, " $glue ");
		} else {
			$this->where->append($conditions);
		}

		return $this;
	}

	/**
	* Add table name to the INSERT cluase of the query
	*
	* @param   array  $table  Array of field names
	*
	* @return  DatabaseQuery  Returns this object to allow chaining.
	*/
	public function insert($table) {
		$this->type = 'insert';
		$this->insert = new DatabaseQueryElement('INSERT INTO', $table);

		return $this;
	}

	/**
	* Add columns to the INSERT INTO clause
	*
	* @param   array  $columns  Array of field names
	*
	* @return  DatabaseQuery  Returns this object to allow chaining.
	*/
	public function columns($columns) {
		if (is_null($this->columns)) {
			$this->columns = new DatabaseQueryElement('()', $columns);
		} else {
			$this->columns->append($columns);
		}

		return $this;
	}

	/**
	* Add values to the VALUES clause
	*
	* @param   array  $values  Array of values for columns
	*
	* @return  DatabaseQuery  Returns this object to allow chaining.
	*/
	public function values($values) {
		if (is_null($this->values)) {
			$this->values = new DatabaseQueryElement('()', $values);
		} else {
			$this->values->append($values);
		}

		return $this;
	}

	/**
	* Update data in the database
	*
	* @param   array   $conditions  Array of conditions
	* @param   string  $glue        Glue for join the condition, ',' by default
	*
	* @return  DatabaseQuery  Returns this object to allow chaining.
	*/
	public function set($conditions, $glue = ',') {
		if (is_null($this->set)) {
			$this->set = new DatabaseQueryElement('SET', $conditions, $glue);
		} else {
			$this->set->append($conditions);
		}

		return $this;
	}

	/**
	* Add table to the FROM clause of the query
	*
	* @param  string  $table  Database table
	*
	* @return  DatabaseQuery  Returns this object to allow chaining.
	*/
	public function from($table) {
		if (is_null($this->from)) {
			$this->from = new DatabaseQueryElement('FROM', $table);
		} else {
			$this->from->append($table);
		}

		return $this;
	}

	/**
	* Set order for the ORDER clause of the query
	*
	* @param   mixed  $columns  String or array of odering columns
	*
	* @return  DatabaseQuery  Returns this object to allow chaining.
	*/
	public function order($columns) {
		if (is_null($this->order)) {
			$this->order = new DatabaseQueryElement('ORDER BY', $columns);
		} else {
			$this->order->append($columns);
		}

		return $this;
	}
}
