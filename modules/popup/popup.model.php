<?php

class PopupModel extends Model {

	var $class_name = 'popup_model';

	function init() {
		
	}

	function selectFieldFromPopup($field) {

		$context = Context::getInstance();
		$id = $context->getRequest('id');
		$where = '';
		if (isset($id) && $id != '') {
			$where = array('id'=>$id);
		}		

		$query = new Query();
		$query->setField($field);
		$query->setTable($context->get('db_popup'));		
		if ($where != '') {
			$query->setWhere( array('id'=>$id) );
		}

		$result = parent::select($query);
		return $result;
	}

	function selectFieldFromPopupWhere($field) {

		$context = Context::getInstance();
		$id = $context->getRequest('id');

		$query = new Query();
		$query->setField($field);
		$query->setTable($context->get('db_popup'));
		$query->setWhere(array(
			'id'=>$id
		));

		$result = parent::select($query);
		return $result;
	}
}
?>