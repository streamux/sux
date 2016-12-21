<?php

class MemberAdminModel extends Model
{

	function selectFromMemberGroup($field='*', $where=null) {

		$context = Context::getInstance();
		$tableName = $context->getTable('member_group');

		$query = new Query();
		$query->setField($field);
		$query->setTable($tableName);

		if (isset($where) && $where) {
			$query->setWhere($where);
		}		

		$result = parent::select($query);
		return $result;
	}

	function insertIntoMemberGroup($column=null) {

		$context = Context::getInstance();
		$group = $context->getTable('member_group');

		$query = new Query();
		$query->setTable($group);
		if (isset($column) && $column) {
			$query->setColumn($column);
		}		

		$result = parent::insert($query);
		return $result;
	}

	function deleteMemberGroup($where=null) {

		$context = Context::getInstance();
		$table_name = $context->getTable('member_group');

		$query = new Query();
		$query->setTable($table_name);

		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		$result = parent::delete($query);
		return $result;
	}

	function selectFromMember($field='*', $where=null, $orderby=null, $passover=0, $limit=null) {

		$context = Context::getInstance();
		$tableName = $context->getTable('member');
		
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

	function updateFromMember( $column, $where=null) {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$tableName = $context->getTable('member');

		$query = new Query();
		$query->setTable($tableName);

		if (isset($column) && $column) {
			$query->setColumn( $column );
		}	

		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		$result = parent::update($query);
		return $result;
	}

	function deleteFromMember($where=null) {

		$context = Context::getInstance();
		$tableName = $context->getTable('member');

		$query = new Query();
		$query->setTable($tableName);

		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		$result = parent::delete($query);
		return $result;
	}

	function dropTableMember() {

		$context = Context::getInstance();
		$tableName = $context->getRequest('table_name');

		$query = new Query();
		$query->setTable($tableName);

		$result = parent::dropTable($query);
		return $result;
	}
}
?>