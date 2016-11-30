<?php

class AdminAdminModel extends BaseModel {

	var $class_name = 'admin_admin_model';

	function  __construct() {

		parent::__construct();
	}

	function init() {}

	function selectFromConnecterall() {

		$context = Context::getInstance();
		$table_name = $context->getTable('connecter_all');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField('*');

		$result = parent::select($query);
		return $result;
	}

	function selectIdFromConnecterWhereNow() {

		$context = Context::getInstance();
		$table_name = $context->getTable('connecter');
		$del_date = date('Y-m-d', time()-86400);

		$query = new Query();
		$query->setTable($table_name);
		$query->setField('id');
		$query->setWhere(array('date'=>'now()'), '=');

		$result = parent::select($query);
		return $result;
	}

	function selectIdFromConnecterWhereYesterday() {

		$context = Context::getInstance();
		$table_name = $context->getTable('connecter');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField('id');
		$query->setWhere(array('date'=>'now()'), '<');

		$result = parent::select($query);
		return $result;
	}

	function deleteFromConnecterWhereDelday() {

		$context = Context::getInstance();
		$table_name = $context->getTable('connecter');
		$del_date = date('Y-m-d', time()-86400);

		$query = new Query();
		$query->setTable($table_name);
		$query->setWhere(array('date'=>$del_date), '<');

		$result = parent::delete($query);
		return $result;
	}

	function selectFromConnecterrealall() {

		$context = Context::getInstance();
		$table_name = $context->getTable('connecter_real_all');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField('*');

		$result = parent::select($query);
		return $result;
	}

	function selectIdFromConnecterrealWhereNow() {

		$context = Context::getInstance();
		$table_name = $context->getTable('connecter_real');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField('id');
		$query->setWhere(array('date'=>'now()'), '=');

		$result = parent::select($query);
		return $result;
	}

	function selectIdFromConnecterrealWhereYesterday() {

		$context = Context::getInstance();
		$table_name = $context->getTable('connecter_real');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField('id');
		$query->setWhere(array('date'=>'now()'), '<');

		$result = parent::select($query);
		return $result;
	}

	function deleteFromConnecterrealWhereDelday() {

		$context = Context::getInstance();
		$table_name = $context->getTable('connecter_real');
		$del_date = date('Y-m-d', time()-86400);

		$query = new Query();
		$query->setTable($table_name);
		$query->setWhere(array('date'=>$del_date), '<');

		$result = parent::delete($query);
		return $result;
	}

	function selectFromPageview() {

		$context = Context::getInstance();
		$table_name = $context->getTable('pageview');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField('*');
		$query->setOrderBy('id asc');

		$result = parent::select($query);
		return $result;
	}

	function selectFromPageviewLimit() {

		$context = Context::getInstance();
		$table_name = $context->getTable('pageview');
		$passover = $context->get('passover');
		$limit = $context->get('limit');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField('*');
		$query->setOrderBy('id desc');
		$query->setLimit($passover, $limit);

		$result = parent::select($query);
		return $result;
	}

	function selectFromConnectersite() {

		$context = Context::getInstance();
		$table_name = $context->getTable('connecter_site');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField('*');
		$query->setOrderBy('id asc');

		$result = parent::select($query);
		return $result;
	}


	function selectFromConnectersiteLimit() {

		$context = Context::getInstance();
		$table_name = $context->getTable('connecter_site');
		$passover = $context->get('passover');
		$limit = $context->get('limit');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField('*');
		$query->setOrderBy('id desc');
		$query->setLimit($passover, $limit);

		$result = parent::select($query);
		return $result;
	}

	function selectIdFromPopupWhere() {

		$context = Context::getInstance();
		$table_name = $context->getTable('popup');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField('id');
		$query->setWhere(array('choice'=>'y'));

		$result = parent::select($query);
		return $result;
	}

	function selectIdFromBoardgroup() {

		$context = Context::getInstance();
		$table_name = $context->getTable('board_group');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField('id');

		$result = parent::select($query);
		return $result;
	}

	function selectIdFromMembergroup() {

		$context = Context::getInstance();
		$table_name = $context->getTable('member_group');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField('id');

		$result = parent::select($query);
		return $result;
	}

	function selectIdFromPageview() {

		$context = Context::getInstance();
		$table_name = $context->getTable('pageview');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField('id');

		$result = parent::select($query);
		return $result;
	}

	function selectIdFromConnectersite() {

		$context = Context::getInstance();
		$table_name = $context->getTable('connecter_site');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField('id');

		$result = parent::select($query);
		return $result;
	}
}
?>