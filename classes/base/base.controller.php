<?php

class BaseController extends Object {

	var $name = "base_controller";
	var $model = NULL;
	
	function BaseController($m=NULL) {
		
		$result = $this->model = $m;
		return $result;
	}

	function select($query=NULL) {

		$result = $this->model->select($query);
		return $result;
	}

	function insert($query=NULL) {

		$result = $this->model->insert($query);
		return $result;
	}

	function update($query=NULL) {

		$result = $this->model->update($query);
		return $result;
	}

	function delete($query=NULL) {

		$result = $this->model->delete($query);
		return $result;
	}
}
?>