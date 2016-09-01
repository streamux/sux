<?php

class PopupModel extends BaseModel {

	var $class_name = 'popup_model';

	function init() {
		
	}

	function selectFieldFromPopup($field) {

		$context = Context::getInstance();
		$id = $context->getRequest('id');
		if (isset($id) && $id != '') {
			$where = array('id'=>$id);
		}		

		$query = new Query();
		$query->setField($field);
		$query->setTable($context->get('db_popup'));		
		if (isset($id) && $where != '') {
			$query->setWhere( $where );
		}

		$result = parent::select($query);
		return $result;
	}

	function selectFieldFromPopupWhere() {

		$context = Context::getInstance();
		$id = $context->getRequest('id');

		$query = new Query();
		$query->setField('*');
		$query->setTable($context->get('db_popup'));
		$query->setWhere(array(
			'id'=>$id
		));

		$result = parent::select($query);
		return $result;
	}
}
?>