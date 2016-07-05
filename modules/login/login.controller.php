<?php

class LoginController extends BaseController {

	var $name = 'login_controlelr';

	function LoginController($m=NULL) {
		
		$this->model = $m;
	}

	function select($handler, $values=NULL) {

		$this->model->{$handler}('select', $values);
	}

	function insert($handler, $values=NULL) {

		$this->model->{$handler}('insert', $values);
	}

	function update($handler, $values=NULL) {

		$this->model->{$handler}('update', $values);
	}

	function delete($handler, $values=NULL) {

		$this->model->{$handler}('delete', $values);
	}
}
?>