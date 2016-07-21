<?php

class PopupModel extends BaseModel {

	var $class_name = 'popup_model';

	function init() {
		
	}

	function selectFieldFromPopup($field) {

		$context = Context::getInstance();

		$query = new Query();
		$query->setField($field);
		$query->setTable($context->get('db_popup'));

		$result = parent::select($query);
		return $result;
	}
}
?>