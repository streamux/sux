<?php

class PopupAdminModel extends BaseModel {

	var $class_name = 'popup_model';

	function init() {
		
	}

	function selectFromPopup() {

		$context = Context::getInstance();
		$popup = $context->get('db_popup');

		$query = new Query();
		$query->setField('*');
		$query->setTable($popup);

		$result = parent::select($query);
		return $result;
	}

	function selectFromPopupWhere() {

		$context = Context::getInstance();
		$popup = $context->get('db_popup');
		$id = $context->getPost('id');

		$query = new Query();
		$query->setField('*');
		$query->setTable($popup);
			$query->setWhere(array(
			'id'=>$id
		));

		$result = parent::select($query);
		return $result;
	}

	function selectNameFromPopupWhere() {

		$context = Context::getInstance();
		$popup = $context->get('db_popup');
		$name = $context->getPost('name');

		$query = new Query();
		$query->setField('name');
		$query->setTable($popup);
			$query->setWhere(array(
			'name'=>$name
		));

		$result = parent::select($query);
		return $result;
	}

	function insertIntoPopup() {

		$context = Context::getInstance();
		$popup = $context->get('db_popup');
		$posts = $context->getPostAll();

		$column = array('');
		$column[] = $posts['popup_name'];
		$column[] = $posts['choice'];
		$column[] = $posts['time1'];
		$column[] = $posts['time2'];
		$column[] = $posts['time3'];
		$column[] = $posts['time4'];
		$column[] = $posts['time5'];
		$column[] = $posts['time6'];
		$column[] = $posts['popup_title'];
		$column[] = $posts['popup_width'];
		$column[] = $posts['popup_height'];
		$column[] = $posts['popup_top'];
		$column[] = $posts['popup_left'];
		$column[] = $posts['skin'];
		$column[] = $posts['skin_top'];
		$column[] = $posts['skin_left'];
		$column[] = $posts['skin_right'];
		$column[] = $posts['comment'];

		$query = new Query();
		$query->setTable($popup);
		$query->setColumn($column);

		$result = parent::insert($query);
		return $result;
	}

	function updateFromPopupWhere() {

		$context = Context::getInstance();
		$popup = $context->get('db_popup');		
		$posts = $context->getPostAll();
		$id = $posts['id'];

		$column = array();
		$column['popup_name'] = $posts['popup_name'];
		$column['choice'] = $posts['choice'];
		$column['time1'] = $posts['time1'];
		$column['time2'] = $posts['time2'];
		$column['time3'] = $posts['time3'];
		$column['time4'] = $posts['time4'];
		$column['time5'] = $posts['time5'];
		$column['time6'] = $posts['time6'];
		$column['popup_title'] = $posts['popup_title'];
		$column['popup_width'] = $posts['popup_width'];
		$column['popup_height'] = $posts['popup_height'];
		$column['popup_top'] = $posts['popup_top'];
		$column['popup_left'] = $posts['popup_left'];
		$column['skin'] = $posts['skin'];
		$column['skin_top'] = $posts['skin_top'];
		$column['skin_left'] = $posts['skin_left'];
		$column['skin_right'] = $posts['skin_right'];
		$column['comment'] = $posts['comment'];

		$query = new Query();
		$query->setTable($popup);
		$query->setColumn($column);
		$query->setWhere(array(
			'id'=>$id
		));

		$result = parent::update($query);
		return $result;
	}

	function deleteFromPopup() {

		$context = Context::getInstance();
		$popup = $context->get('db_popup');
		$id = $context->getRequest('id');

		$query = new Query();
		$query->setTable($popup);
		$query->setWhere(array(
			'id'=>$id
		));

		$result = parent::delete($query);
		return $result;
	}
}
?>