<?php

class AdminAdminController extends BaseController {

	var $class_name = 'admin_admin_controller';

	function init() {

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