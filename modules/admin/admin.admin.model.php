<?php

class AdminAdminModel extends Model
{
	
	function selectFromConnecterday( $field='*', $where=null) {

		$context = Context::getInstance();
		$table_name = $context->getTable('connecter_day');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField($field);
		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		$result = parent::select($query);
		return $result;
	}

	function selectFromConnecter($field='*', $where=null) {

		$context = Context::getInstance();
		$table_name = $context->getTable('connecter');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField($field);
		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		$result = parent::select($query);
		return $result;
	}

	function deleteFromConnecter($where=null) {

		$context = Context::getInstance();
		$table_name = $context->getTable('connecter');

		$query = new Query();
		$query->setTable($table_name);
		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		$result = parent::delete($query);
		return $result;
	}

	function selectFromConnecterreal($field='*', $where=null) {

		$context = Context::getInstance();
		$table_name = $context->getTable('connecter_real');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField($field);
		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		$result = parent::select($query);
		return $result;
	}

	function deleteFromConnecterreal($where) {

		$context = Context::getInstance();
		$table_name = $context->getTable('connecter_real');

		$query = new Query();
		$query->setTable($table_name);
		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		$result = parent::delete($query);
		return $result;
	}

	function selectFromPageview($field='*', $where=null, $orderby=null, $passover=null, $limit=null) {

		$context = Context::getInstance();
		$table_name = $context->getTable('pageview');

		$query = new Query();
		$query->setTable($table_name);
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

		$result = parent::select($query);
		return $result;
	}

	function selectFromConnectsite($field='*', $where=null, $orderby=null, $passover=null, $limit=null) {

		$context = Context::getInstance();
		$table_name = $context->getTable('connect_site');

		$query = new Query();
		$query->setTable($table_name);
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

		$result = parent::select($query);
		return $result;
	}

	function selectFromPopup($field='*', $where=null) {

		$context = Context::getInstance();
		$table_name = $context->getTable('popup');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField($field);

		if (isset($where) && $where) {
			$query->setWhere($where); 
		}

		$result = parent::select($query);
		return $result;
	}

	function selectFromBoardgroup($field='*', $where=null) {

		$context = Context::getInstance();
		$table_name = $context->getTable('board_group');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField($field);

		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		$result = parent::select($query);
		return $result;
	}

	function selectFromMembergroup($field='*', $where=null) {

		$context = Context::getInstance();
		$table_name = $context->getTable('member_group');

		$query = new Query();
		$query->setTable($table_name);
		$query->setField($field);

		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		$result = parent::select($query);
		return $result;
	}
}