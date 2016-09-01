<?php

class QuerySchema extends Object {
	
	var $class_name = 'query_schema';
	var $_schemas;
	var $_schema;
	var $_name = '';
	var $_type = '';
	var $_length = 0;
	var $_notnull = NULL;
	var $_autoincrement = NULL;
	var $_primarykey = NULL;
	var $_counter = 0;

	function __construct() {

		$this->_schemas = array();
	}

	function reset() {

		$this->_schemas = array();
	}

	function get() {

		return $this->_schemas;
	}

	function add($name, $type, $length=0, $notnull=NULL, $autoincrement=NULL, $primarykey) {

		$str = '';
		$str .= $name . ' ' . $type;

		if ($length > 0) {
			$str .=  '(' . $length . ')';
		}

		if (isset($notnull) || $notnull != '') {
			$str .=  ' not null';
		}

		if (isset($autoincrement) || $autoincrement != '') {
			$str .=  ' auto_increment';
		}

		if (isset($primarykey) || $primarykey != '') {
			$str .= ' primary key(' . $name . ')';
		}

		$this->_schemas[] = $str;
	}

	function setName($name) {

		$this->_schema = &$this->_schemas[$this->_counter];
		$this->_schema = $name;
		$this->_counter++;
		//return self;
	}

	function setType($type) {
		
		$this->_schema .= ' ' . $type;		
		//return self;
	}

	function setLength($length) {
		
		$this->_schema .= '(' . $length . ')';
		//return self;
	}

	function setNotnull() {

		$this->_schema .= ' not not';
		//return self;
	}

	function setAutoincrement() {

		$this->_schema .= ' auto_increment';
		//return self;
	}

	function setPrimarykey( $key ) {

		$this->_schemas[] = 'primary key(' . $key . ')';
		//return self;
	}
}
?>