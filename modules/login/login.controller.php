<?php

class LoginController extends BaseController {

	var $class_name = 'login_controlelr';

	function LoginController($m=NULL) {
		
		$this->model = $m;
	}

	function select($handler, $values=NULL) {

		$this->model->{$handler}($values, 'select');
	}

	function insert($handler, $values=NULL) {

		$this->model->{$handler}($values, 'insert');
	}

	function update($handler, $values=NULL) {

		$this->model->{$handler}($values, 'update');
	}

	function delete($handler, $values=NULL) {

		$this->model->{$handler}($values, 'delete');
	}
}
?>