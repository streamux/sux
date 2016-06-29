<?php

class LoginController extends BaseController {

	var $name = 'login_controlelr';

	function BaseController($m=NULL) {
		
		$this->model = $m;
	}

	function select($values) {

		$handler = $values['handler'];
		$this->model->{$handler}('select', $values);
	}

	function insert($values) {

		$handler = $values['handler'];
		$this->model->{$handler}('insert', $values);
	}

	function update($values) {

		$handler = $values['handler'];
		$this->model->{$handler}('update', $values);
	}

	function delete($values) {

		$handler = $values['handler'];
		$this->model->{$handler}('delete', $values);
	}
}
?>