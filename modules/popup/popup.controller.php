<?php

class PopupController extends Controller {

	var $class_name = 'popup_controller';

	function __construct($m=NULL) {
		
		$this->model = $m;
	}

	function select($handler, $values=NULL) {

		$method = 'select' . ucfirst($handler);
		$result = $this->model->{$method}($values);
		return $result;
	}

	function insert($handler, $values=NULL) {

		$method = 'insert' . ucfirst($handler);
		$result = $this->model->{$method}($values);
		return $result;
	}

	function update($handler, $values=NULL) {

		$method = 'update' . ucfirst($handler);
		$result = $this->model->{$method}($values);
		return $result;
	}

	function delete($handler, $values=NULL) {

		$method = 'delete' . ucfirst($handler);
		$result = $this->model->{$method}($values);
		return $result;
	}
}
?>