<?php

class PromotionModel extends BaseModel {

	var $class_name = 'Promotion_model';

	function __construct() {

		 parent::__construct();
	}

	function init() {}

	/**
	 * pageview
	 */
	function selectFieldFromPageview($field) {

		$context = Context::getInstance();

		$query = new Query();
		$query->setField($field);
		$query->setTable($context->get('db_pageview'));
		$query->setWhere(array(
			'name'=>$context->getRequest('keyword')
		));

		$result = parent::select($query);
		return $result;
	}

	function updatePageviewSetValue($column) {

		$context = Context::getInstance();

		$query = new Query();
		$query->setTable($context->get('db_pageview'));
		$query->setColumn($column);
		$query->setWhere(array(
			'name'=>$context->getRequest('keyword')
		));

		$result = parent::update($query);
		return $result;
	}

	function insertIntoPageview() {

		$context = Context::getInstance();

		$query = new Query();
		$query->setTable($context->get('db_pageview'));
		$query->setColumn(array(
			'',
			$context->getRequest('keyword'),
			'now()',
			1
		));

		$result = parent::insert($query);
		return $result;
	}

	/**
	 * connecter all
	 */
	function selectFieldFromConnecterAll($field) {

		$context = Context::getInstance();

		$query = new Query();
		$query->setField($field);
		$query->setTable($context->get('db_connecter_all'));

		$result = parent::select($query);
		return $result;
	}

	function updateConnecterAllSetValues($column) {

		$context = Context::getInstance();

		$query = new Query();
		$query->setTable($context->get('db_connecter_all'));
		$query->setColumn($column);

		$result = parent::update($query);
		return $result;
	}

	/**
	 * connecter
	 */
	function selectFieldFromConnecter($query) {

		$field = $query['field'];
		$where = $query['where'];

		$context = Context::getInstance();

		$query = new Query();
		$query->setField($field);
		$query->setTable($context->get('db_connecter'));

		if ($where != '') {
			$query->setWhere($where);		
		}	

		$result = parent::select($query);
		return $result;
	}

	function insertIntoConnecter() {

		$context = Context::getInstance();
		$ip = $context->getServer('REMOTE_ADDR');

		$query = new Query();
		$query->setTable($context->get('db_connecter'));
		$query->setColumn(array(
			'',
			$ip,
			'now()'
		));

		$result = parent::insert($query);
		return $result;
	}

	function deleteFromConnecter() {

		$context = Context::getInstance();
		$del_date = date("Y-m-d", time() - 86400); 

		$query = new Query();
		$query->setTable($context->get('db_connecter'));		
		$query->setWhere(array(
			'date'=>$del_date
		), '<');

		$result = parent::delete($query);
		return $result;
	}

	/**
	 * connecter real
	 */
	function selectFieldFromConnecterReal($query) {

		$context = Context::getInstance();	
		$field = $query['field'];
		$where = $query['where'];

		$query = new Query();
		$query->setField($field);
		$query->setTable($context->get('db_connecter_real'));
		if ($where != '') {
			$query->setWhere($where);		
		}

		$result = parent::select($query);
		return $result;
	}

	function deleteFromConnecterReal() {

		$context = Context::getInstance();
		$del_date = date("Y-m-d", time() - 86400); 

		$query = new Query();
		$query->setTable($context->get('db_connecter_real'));		
		$query->setWhere(array(
			'date'=>$del_date
		), '<');

		$result = parent::delete($query);
		return $result;
	}

	function insertIntoConnecterReal() {

		$context = Context::getInstance();
		$ip = $context->getServer('REMOTE_ADDR');

		$query = new Query();
		$query->setTable($context->get('db_connecter_real'));
		$query->setColumn(array(
			'',
			$ip,
			'now()'
		));

		$result = parent::insert($query);
		return $result;
	}

	/**
	 * connecter real all
	 */
	function selectFieldFromConnecterRealAll($field) {

		$context = Context::getInstance();

		$query = new Query();
		$query->setField($field);
		$query->setTable($context->get('db_connecter_real_all'));

		$result = parent::select($query);
		return $result;
	}

	function updateConnecterRealAllSetValues($column) {

		$context = Context::getInstance();

		$query = new Query();
		$query->setTable($context->get('db_connecter_real_all'));
		$query->setColumn($column);

		$result = parent::update($query);
		return $result;
	}
}
?>