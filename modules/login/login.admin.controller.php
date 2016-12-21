<?php

class LoginAdminController extends Controller {

	var $class_name = 'login_controlelr';

	function LoginAdminController($m=NULL) {
		
		$this->model = $m;
	}

	function select($handler, $values=NULL) {

		$result = $this->model->{$handler}($values, 'select');
		return $result;
	}

	function insert($handler, $values=NULL) {

		$result = $this->model->{$handler}($values, 'insert');
		return $result;
	}

	function update($handler, $values=NULL) {

		$result = $this->model->{$handler}($values, 'update');
		return $result;
	}

	function delete($handler, $values=NULL) {

		$result = $this->model->{$handler}($values, 'delete');
		return $result;
	}
}
?>