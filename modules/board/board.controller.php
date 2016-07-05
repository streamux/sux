<?php

class BoardController extends BaseController {

	var $name = 'board_controller';

	function BoardController($m=NULL) {
		
		$this->model = $m;
	}

	function select($handler, $values=NULL) {

		$result = $this->model->{$handler}('select', $values);		
		return $result;
	}

	function insert($handler, $values=NULL) {

		$result = $this->model->{$handler}('insert', $values);
		return $result;
	}

	function update($handler, $values=NULL) {

		$result = $this->model->{$handler}('update', $values);
		return $result;
	}

	function delete($handler, $values=NULL) {

		$result = $this->model->{$handler}('delete', $values);
		return $result;
	}
}
?>