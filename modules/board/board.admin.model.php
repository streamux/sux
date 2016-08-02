<?php

class BoardAdminModel extends BaseModel {

	var $class_name = 'board_admin_model';

	function  __construct() {

		parent::__construct();
	}

	function init() {
		
	}

	function showTables() {

		$context = Context::getInstance();
		$db = $context->getDB();

		$query = new Query();
		$query->setDB($db);
		$result = parent::showTables($query);
		
		return $result;
	}

	function searchTables($table) {

		$result = $this->showTables();
		$numrow = $this->getNumRows();

		for ($i=0; $i<$numrow; $i++) {			
			if (mysql_tablename($result, $i) == $table) {
				return true;
			}
		}

		return false;
	}

	function selectFromBoardGroup() {

		$context = Context::getInstance();
		$group = $context->get('db_board_group');

		$query = new Query();
		$field = 'id';
		$query->setField($field);
		$query->setTable($group);

		$result = parent::select($query);
		return $result;
	}

	function selectFromBoardGroupLimit() {

		$context = Context::getInstance();
		$group = $context->get('db_board_group');
		$passover = $context->get('passover');
		$limit = $context->get('limit');

		$query = new Query();
		$query->setField('*');
		$query->setTable($group);
		$query->setOrderBy('id desc');
		$query->setLimit($passover, $limit);

		$result = parent::select($query);
		return $result;
	}
}
?>