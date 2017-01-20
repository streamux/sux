<?php

class BoardModel extends Model
{
	function select($table_name, $field = '*', $where = null, $orderby = null, $passover = 0, $limit = null) {

		$context = Context::getInstance();
		$tableName = $context->getTable($table_name);

		$query = new Query();		
		$query->setTable($tableName);
		$query->setField($field);

		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		if (isset($orderby) && $orderby) {
			$query->setOrderBy($orderby);
		}

		if (isset($limit) && $limit) {
			$query->setLimit($passover, $limit);
		}

		return parent::select($query);
	}

	function insert($table_name, $columns = null) {

		$context = Context::getInstance();
		$tableName = $context->getTable($table_name);

		$query = new Query();
		$query->setTable($tableName);
		$query->setColumn($columns);

		return parent::insert($query);
	}

	function update($table_name, $columns, $where = null) {
		
		$context = Context::getInstance();
		$tableName = $context->getTable($table_name);

		$query = new Query();
		$query->setTable($tableName);
		$query->setColumn($columns);

		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		return parent::update($query);
	}

	function delete($table_name, $where = null) {

		$context = Context::getInstance();
		$tableName = $context->getTable($table_name);

		$query = new Query();
		$query->setTable($tableName);
		
		if (isset($where) && $where) {
			$query->setWhere($where);
		}
		return parent::delete($query);
	}

	/*function deleteLimitwordFromBoard() {

		$row = $this->getRow();
		$limit_word = $row['limit_word'];
		if (isset($limit_word) && $limit_word != '') {

			$where = new QueryWhere();
			$limit_word_arr = split(',',$limit_word);

			for ($i=0; $i<count($limit_word_arr); $i++) {
				$limit_temp_str = trim($limit_word_arr[$i]);
				$where->set($row['limit_choice'], $limit_temp_str, 'like', 'or');
			}

			$query = new Query();
			$query->setTable($this->board);
			$query->setWhere($where);

			$result = parent::delete($query);
			return $result;			
		}		
	}*/
}