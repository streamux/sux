<?php

class BoardController extends BaseController {

	var $class_name = 'board_controller';

	function __construct($m=NULL) {
		
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