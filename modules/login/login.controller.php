<?php

class LoginController extends BaseController {

	var $name = 'login_controlelr';

	function setQuery($key) {

		$this->{$key}();
	}

	function memberGroup() {
		
		$this->model->memberGroup();
	}

	function logon() {}
	function loginfo() {}
	function logpass() {}
	function logout() {

		
	}
	function fail() {}
	function leave() {}
	
	function searchid() {

		$this->model->searchid();
	}

	function searchpwd() {

		$this->model->searchpwd();
	}
}
?>