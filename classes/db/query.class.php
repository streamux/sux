<?php

class Query extends Object {

	private static $aInstance = NULL;

	var $class_name = 'query_class';
	var $tableId;
	var $priority;
	var $fields;
	var $column_list;
	var $column_keys;
	var $column_values;
	var $where;
	var $like_list;
	var $index_hint;
	var $groupBy;
	var $orderBy;
	var $limit;

	function __construct() {
			
	}

	public static function &getInstance() {

		if (empty(self::$aInstance)) {
			self::$aInstance = new self;
		}
		return self::$aInstance;
	}

	function setSQL($obj=NULL) {

		$table =$obj['table'];
		if ($table != '') {
			$this->setTable($table);
		}
		$priority =$obj['priority'];
		if ($priority != '') {
			$this->setPriority($table);
		}
		$column =$obj['column'];
		if ($priority != '') {
			$this->setColumn($table);
		}
		$index_hint = $obj['indexhint'];
		if ($index_hint != '') {
			$this->setIndexHintList($index_hint);
		}

		$where =$obj['where'];
		if ($priority != '') {
			$this->setWhere($table);
		}
		$groupBy =$obj['groupBy'];
		if ($priority != '') {
			$this->setGroupBy($table);
		}
		$orderBy =$obj['orderBy'];
		if ($priority != '') {
			$this->setOrderBy($table);
		}
		$limit =$obj['limit'];
		if ($priority != '') {
			$this->setLimit($table);
		}
	}

	function setTable($id) {

		$this->tableId = $id;
	}

	function getTable() {

		return $this->tableId;
	}

	function setPriority($values) {

		$this->priority = $values;
	}

	function getPriority() {

		return $this->priority;
	}

	function setField($values) {

		$this->fields = $values;
	}

	function getField() {

		return $this->fields;
	}

	function setColumn($values) {

		if (is_object($values)) {			
			$this->column_keys = $this->getColumnKeys($values, ',');
			$this->column_values = $this->getColumnValues($values, ',');
			$values = $this->addQuotationToArray($values);
		}

		$this->column_list = $this->convertToString($values, ',');
	}

	function getColumn($type) {

		$result = '';

		if ($type == 'key') {
			$result = $this->column_list;
		} else if ($type == 'value') {
			$result = $this->column_keys;
		} else {
			$result = $this->column_values;
		}
		return $result;	
	}

	function setWhere($values, $glue=" and ") {

		$result = '';
		if (is_object($values)) {
			$arr = $this->addQuotationToArray($values);
			$result = $this->convertToString($arr, $glue);
		} else if (is_array($values))  {
			$result = $this->convertToString($values, $glue);
		} else {
			$result = $values;
		}
		
		$this->where = $result;
	}

	function getWhere() {

		return $this->column_list;
	}

	function setLike($arr) {

		$like_str = '';

		if (is_array($arr)) {

			for($i=0; $i<count($arr); $i++) {		
				$like_str .= ' \'%' . $values . '%\' ';
				if ($i < count($arr)-1) {
					$like_str .= 'and';
				}
			}
		} else {
			$like_str .= ' \'%' . $values . '%\' ';
		}

		$like_list = $like_str;
	}

	function getLike() {

		return $this->like_list;
	}

	function setIndexHintList($value) {

		$this->index_hint = $this->convertToString($value, ',');
	}

	function getIndexHintList() {

		return $this->index_hint;
	}

	function setGroupBy($values) {

		$this->groupBy = $values;
	}

	function getGroupBy() {

		return $this->groupBy;
	}

	function setOrderBy($values) {

		$result = '';
		if (is_array($value)) {
			$result = $this->convertToString($value, ',');
		} else {
			$result = $values;
		}
		$this->orderBy = $result;
	}

	function getOrderBy() {

		return $this->orderBy;
	}

	function setLimit($values) {

		$this->limit = $values;
	}

	function getLimit() {

		return $this->limit;
	}

	function convertToString($arr, $glue=',') {

		$tempArr = NULL;
		if (is_array($arr)) {
			$tempArr = implode($glue, $arr);
		} else {
			$tempArr = $arr;
		}

		return $tempArr;
	}

	function getColumnKeys($obj) {

		$temp_arr = array();
		foreach ($obj as $key => $value) {
			$temp_arr[] = $key;
		}

		return $temp_arr;
	}

	function getColumnValues($obj) {

		$temp_arr = array();
		foreach ($obj as $key => $value) {
			$temp_arr[] = $this->addQuotation($value);
		}

		return $temp_arr;
	}

	function addQuotationToArray($obj) {

		$temp_arr = array();
		foreach ($obj as $key => $value) {
			$temp_arr[] = $key . ' = ' . $this->addQuotation($value);
		}

		return $temp_arr;
	}

	function addQuotation($value) {

		$temp_value = '';
		if ((is_string($value) && strpos($value, '()') === FALSE) || !isset($value)) {
			$temp_value = '\'' . $value. '\'';
		} else {
			$temp_value = $value;
		}

		return $temp_value;
	}
}
?>