<?php

class Query extends Object {

	private static $aInstance = NULL;

	var $class_name = 'query_class';
	var $db;
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
	var $schema;

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

	function setDB($db) {

		$this->db = $db;
	}
	function getDB() {

		return $this->db;
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

		if (is_array($values)) {			
			$this->column_keys = $this->getColumnKeys($values, ',');
			$this->column_values = $this->getColumnValues($values, ',');
			$values = $this->addQuotationToArray($values);
		}

		$this->column_list = $this->convertToString($values, ',');
	}

	function getColumn($type) {

		$result = '';

		if ($type == 'key') {
			$result = $this->column_keys;			
		} else if ($type == 'value') {
			$result = $this->column_values;
		} else {
			$result = $this->column_list;			
		}
		return $result;	
	}

	function setWhere($values, $cond="=", $glue='and') {

		$where = array();
		$tmpArr = array();
		$glue = trim($glue);

		if (is_a($values, 'QueryWhere')) {
			$where = $values->get();
		} else {
			if (is_array($values)) {
				if (preg_match('/like/i', $cond)) {
					for($i=0; $i<count($values); $i++) {
						foreach ($values[$i] as $key => $value) {
							$tmpArr[] = $key . ' LIKE %\'' . $value . '\'';
						}
					}
					$where = $this->convertToString($tmpArr, $glue);
				} else {
					$tmpArr = $this->addQuotationToArray($values, $cond);
					$where = $this->convertToString($tmpArr, $glue);
				}			
			} else {
				$where = $values;
			}
		}
		$this->where = $where;
	}

	function getWhere() {

		return $this->where;
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

	function setLimit($passover, $limit) {

		$this->limit = $passover;

		if (isset($limit) || $limit != '') {
			$this->limit .= ', ' . $limit;
		}
	}

	function getLimit() {

		return $this->limit;
	}

	function resetSchema() {

		$this->schema = '';
	}
	function setSchema($schema) {

		$resultArr = $schema->get();
		$this->schema = implode(',', $resultArr);
	}

	function getSchema() {

		return $this->schema;
	}

	function convertToString($arr, $glue=',') {

		$glue = ' ' . $glue . ' ';
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

			if (is_string($key)) {
				$temp_arr[] = $key;
			}
		}

		return count($temp_arr) > 0 ? $temp_arr : '';
	}

	function getColumnValues($obj) {

		$temp_arr = array();
		foreach ($obj as $key => $value) {
			$temp_arr[] = $this->addQuotation($value);
		}

		return $this->convertToString($temp_arr);
	}

	function addQuotationToArray($obj, $cond='=') {

		$temp_arr = array();
		foreach ($obj as $key => $value) {

			if (is_string($key)) {
				$temp_arr[] = $key . $cond . $this->addQuotation($value);
			} else {
				$temp_arr[] = $this->addQuotation($value);
			}			
		}

		return $temp_arr;
	}

	function addQuotation($value) {

		$temp_value = '';
		if (is_string($value) && (preg_match('/\(\)+$/', $value) == false) && (preg_match('/[+|-|*]+/', $value) == false)) {
			$temp_value = '\'' . $value. '\'';
		} else {		
			$temp_value = $value;
		}

		return $temp_value;
	}
}
?>