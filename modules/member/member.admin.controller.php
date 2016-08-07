<?php

class MemberAdminController extends BaseController {

	var $class_name = 'member_admin_controller';

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

	function createTable($handler, $values=NULL) {

		$method = 'createTable' . ucfirst($handler);
		$result = $this->model->{$method}($values);
		return $result;
	}

	function dropTable($handler, $values=NULL) {

		$method = 'dropTable' . ucfirst($handler);
		$result = $this->model->{$method}($values);
		return $result;
	}
}
?>