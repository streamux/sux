<?php

class BoardAdminModel extends Model
{

	function selectFromBoardGroup($field='*', $where=null, $orderby=null, $passover=0, $limit=null) {

		$context = Context::getInstance();
		$tableName = $context->getTable('board_group');

		$query = new Query();
		$query->setField($field);
		$query->setTable($tableName);

		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		if (isset($orderby) && $orderby) {
			$query->setOrderBy('id desc');
		}

		if (isset($limit) && $limit) {
			$query->setLimit($passover, $limit);
		}		

		$result = parent::select($query);
		return $result;
	}

	function insertIntoBoardGroup($column) {

		$context = Context::getInstance();
		$tableName = $context->getTable('board_group');
	
		$query = new Query();
		$query->setTable($tableName);
		$query->setColumn($column);

		$result = parent::insert($query);
		return $result;
	}

	function updateBoardGroup($column, $where=null) {

		$context = Context::getInstance();
		$tableName = $context->getTable('board_group');
		
		$query = new Query();
		$query->setTable($tableName);
		$query->setColumn($column);

		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		$result = parent::update($query);
		return $result;
	}

	function deleteFromBoardGroup($where) {

		$context = Context::getInstance();
		$tableName = $context->getTable('board_group');

		$query = new Query();
		$query->setTable($tableName);
		
		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		$result = parent::delete($query);
		return $result;
	}

	function selectFromBoard($field='*', $where=null, $orderby=null, $passover=0, $limit=null) {

		$context = Context::getInstance();
		$tableName = $context->getTable('board');

		$query = new Query();
		$query->setField($field);
		$query->setTable($tableName);

		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		if (isset($orderby) && $orderby) {
			$query->setOrderBy($orderby);
		}

		if (isset($limit) && $limit) {
			$query->setLimit($passover, $limit);
		}

		$result = parent::select($query);
		return $result;
	}

	function insertIntoBoard($column) {

		$context = Context::getInstance();
		$tableName = $context->getTable('board');

		$query = new Query();
		$query->setTable($tableName);
		$query->setColumn($column);

		$result = parent::insert($query);
		return $result;
	}

	function deleteFromBoard($where) {

		$context = Context::getInstance();
		$tableName = $context->getTable('board');

		$query = new Query();
		$query->setTable($tableName);
		
		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		$result = parent::delete($query);
		return $result;
	}

	function insertIntoComment($column) {

		$context = Context::getInstance();
		$tableName = $context->getTable('board_group');

		$posts = $context->getPostAll();
		foreach ($posts as $key => $value) {
			${$key} = $value;
		}

		$query = new Query();
		$query->setTable($tableName);
		$query->setColumn(array(
			'', 
			$board, $width, $include1, $include2, $include3, 'now()',
			$w_admin, $r_admin, $rw_admin, $re_admin,
			$listnum, $tail, $download, $setup,
			$w_grade, $r_grade, $rw_grade, $re_grade,
			$log_key, $limit_choice, $limit_word,
			$board_name, $type, $output
		));

		$result = parent::insert($query);
		return $result;
	}

	function deleteFromComment($where=null) {

		$context = Context::getInstance();
		$tableName = $context->getTable('comment');

		$query = new Query();
		$query->setTable($tableName);
		
		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		$result = parent::delete($query);
		return $result;	
	}
}
