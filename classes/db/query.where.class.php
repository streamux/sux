<?php

class QueryWhere extends Object {
	
	var $class_name = 'query_where';
	var $sql = '';
	var $counter = 0;

	function __construct() {

	}

	function get() {

		return $this->sql;
	}

	function set($field,$value,$glue='=', $cond) {

		if ($cond != '' && $this->counter > 0) {
			$this->sql .= ' ' . $cond . ' ';
		}

		if (preg_match('/like/i', $glue)) {
			$this->sql .= $field . ' LIKE \'%' . $value . '%\'';
		} else {
			$this->sql .= $field . $glue . $value;
		}

		$this->counter++;
	}

	function add($values) {

		$this->sql .= ' ' . $values . ' ';
	}

	function reset() {

		$this->sql = '';
		$this->counter = 0;
	}
}
?>