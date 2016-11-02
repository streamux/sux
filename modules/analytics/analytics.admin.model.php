<?php

class AnalyticsAdminModel extends BaseModel {

	var $class_name = 'analytics_admin_model';

	function __construct() {

		 parent::__construct();
	}

	function init() {}
	
	function selectFromConnecterSiteWhere($name) {

		$context = Context::getInstance();
		$table_name = $context->get('db_connecter_site');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField('id');
		$query->setWhere(array('name'=>$name));

		$result = parent::select($query);
		return $result;
	}

	function selectFromConnecterSiteOrderby($orderby) {

		$context = Context::getInstance();
		$table_name = $context->get('db_connecter_site');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField('*');
		$query->setOrderBy($orderby);

		$result = parent::select($query);
		return $result;
	}

	function insertIntoConnecterSite() {

		$context = Context::getInstance();

		$table_name = $context->get('db_connecter_site');
		$keyword = $context->getPost('keyword');

		$query = new Query();
		$query->setTable($table_name);
		$query->setColumn(array(
			'',
			$keyword,
			'now()',
			0
		));

		$result = parent::insert($query);
		return $result;
	}

	function deleteFromConnecterSiteWhere($id) {

		$context = Context::getInstance();
		$table_name = $context->get('db_connecter_site');
		$id = $context->getPost('id');

		$query = new Query();
		$query->setTable($table_name);
		$query->setWhere(array('id'=>$id));

		$result = parent::delete($query);
		return $result;
	}

	function updateFromConnecterSiteWhere() {

		$context = Context::getInstance();
		$table_name = $context->get('db_connecter_site');
		$id = $context->getPost('id');

		$query = new Query();
		$query->setTable($table_name);
		$query->setColumn(array('hit'=>0));
		$query->setWhere(array('id'=>$id));

		$result = parent::update($query);
		return $result;
	}

	function selectFromPageviewWhere($name) {

		$context = Context::getInstance();
		$table_name = $context->get('db_pageview');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField('id');
		$query->setWhere(array('name'=>$name));

		$result = parent::select($query);
		return $result;
	}

	function selectFromPageviewOrderby($orderby) {

		$context = Context::getInstance();
		$table_name = $context->get('db_pageview');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField('*');
		$query->setOrderBy($orderby);

		$result = parent::select($query);
		return $result;
	}

	function insertIntoPageview() {

		$context = Context::getInstance();

		$table_name = $context->get('db_pageview');
		$keyword = $context->getPost('keyword');

		$query = new Query();
		$query->setTable($table_name);
		$query->setColumn(array(
			'',
			$keyword,
			'now()',
			0
		));

		$result = parent::insert($query);
		return $result;
	}

	function deleteFromPageviewWhere() {

		$context = Context::getInstance();
		$table_name = $context->get('db_pageview');
		$id = $context->getPost('id');

		$query = new Query();
		$query->setTable($table_name);
		$query->setWhere(array('id'=>$id));

		$result = parent::delete($query);
		return $result;
	}

	function updateFromPageviewWhere() {

		$context = Context::getInstance();
		$table_name = $context->get('db_pageview');
		$id = $context->getPost('id');

		$query = new Query();
		$query->setTable($table_name);
		$query->setColumn(array('hit'=>0));
		$query->setWhere(array('id'=>$id));

		$result = parent::update($query);
		return $result;
	}
}
?>