<?php

class DocumentAdminModel extends Model
{

	function selectFromDocument($field='*', $where=null, $orderby=null, $passover=0, $limit=null) {

		$context = Context::getInstance();
		$tableName = $context->getTable('document');

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

	function insertIntoDocument($column) {

		$context = Context::getInstance();
		$tableName = $context->getTable('document');

		$query = new Query();
		$query->setTable($tableName);
		$query->setColumn($column);

		$result = parent::insert($query);
		return $result;
	}

	function updateDocument($column, $where=null) {

		$context = Context::getInstance();
		$tableName = $context->getTable('document');
		
		$query = new Query();
		$query->setTable($tableName);
		$query->setColumn($column);

		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		$result = parent::update($query);
		return $result;
	}

	function deleteFromDocument($where) {

		$context = Context::getInstance();
		$tableName = $context->getTable('document');

		$query = new Query();
		$query->setTable($tableName);
		
		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		$result = parent::delete($query);
		return $result;
	}

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
			$query->setOrderBy($orderby);
		}

		if (isset($limit) && $limit) {
			$query->setLimit($passover, $limit);
		}

		$result = parent::select($query);
		return $result;
	}
}