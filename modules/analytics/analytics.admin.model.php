<?php

class AnalyticsAdminModel extends Model
{

	function selectFromConnectSite($field='*', $where=null, $orderby=null, $passover=0, $limit=null) {

		$context = Context::getInstance();
		$tableName = $context->getTable('connect_site');

		$query = new Query();
		$query->setTable($tableName);
		$query->setField($field);

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

	function insertIntoConnectSite($column) {

		$context = Context::getInstance();
		$tableName = $context->getTable('connect_site');
	
		$query = new Query();
		$query->setTable($tableName);
		$query->setColumn($column);

		$result = parent::insert($query);
		return $result;
	}

	function updateConnectSite($column, $where) {

		$context = Context::getInstance();
		$tableName = $context->getTable('connect_site');
		
		$query = new Query();
		$query->setTable($tableName);
		$query->setColumn($column);

		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		$result = parent::update($query);
		return $result;
	}

	function deleteFromConnectSite($where) {

		$context = Context::getInstance();
		$tableName = $context->getTable('connect_site');

		$query = new Query();
		$query->setTable($tableName);
		
		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		$result = parent::delete($query);
		return $result;
	}

	function selectFromPageview($field='*', $where=null, $orderby=null, $passover=0, $limit=null) {

		$context = Context::getInstance();
		$tableName = $context->getTable('pageview');

		$query = new Query();
		$query->setTable($tableName);
		$query->setField($field);

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

	function insertIntoPageview($column) {

		$context = Context::getInstance();
		$tableName = $context->getTable('pageview');
	
		$query = new Query();
		$query->setTable($tableName);
		$query->setColumn($column);

		$result = parent::insert($query);
		return $result;
	}

	function updatePageview($column, $where) {

		$context = Context::getInstance();
		$tableName = $context->getTable('pageview');
		
		$query = new Query();
		$query->setTable($tableName);
		$query->setColumn($column);

		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		$result = parent::update($query);
		return $result;
	}

	function deleteFromPageview($where) {

		$context = Context::getInstance();
		$tableName = $context->getTable('pageview');

		$query = new Query();
		$query->setTable($tableName);
		
		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		$result = parent::delete($query);
		return $result;
	}	
}
