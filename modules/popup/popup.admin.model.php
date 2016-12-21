<?php
class PopupAdminModel extends Model
{

	function selectFromPopup($field='*', $where=null, $orderby=null, $passover=0, $limit=null) {

		$context = Context::getInstance();
		$tableName = $context->getTable('popup');

		$query = new Query();
		$query->setField('*');
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

	function insertIntoPopup($column) {

		$context = Context::getInstance();
		$tableName = $context->getTable('popup');

		$query = new Query();
		$query->setTable($tableName);
		$query->setColumn($column);

		$result = parent::insert($query);
		return $result;
	}

	function updatePopup($column, $where) {

		$context = Context::getInstance();
		$tableName = $context->getTable('popup');			

		$query = new Query();
		$query->setTable($tableName);
		$query->setColumn($column);
		$query->setWhere($where);

		$result = parent::update($query);
		return $result;
	}

	function deleteFromPopup($where) {

		$context = Context::getInstance();
		$tableName = $context->getTable('popup');

		$query = new Query();
		$query->setTable($tableName);

		if (isset($where) && $where) {
			$query->setWhere($where);
		}

		$result = parent::delete($query);
		return $result;
	}
}
