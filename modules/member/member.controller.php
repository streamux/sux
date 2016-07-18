<?php

class MemberController extends BaseController {

	var $class_name = 'member_conntroller';

	function MemberController($m=NULL) {
		
		$this->model = $m;
	}

	function select($handler, $values=NULL) {

		$result = $this->model->{$handler}($values);		
		return $result;
	}

	function insert($handler, $values=NULL) {

		$result = $this->model->{$handler}($values);
		return $result;
	}

	function update($handler, $values=NULL) {

		$result = $this->model->{$handler}($values);
		return $result;
	}

	function delete($handler, $values=NULL) {

		$result = $this->model->{$handler}($values);
		return $result;
	}
}
?>