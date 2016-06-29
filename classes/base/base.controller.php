<?php

class BaseController extends Object {

	var $name = "base_controller";
	var $model = NULL;
	
	function BaseController($m=NULL) {
		
		$this->model = $m;
	}

	function select($query=NULL) {

		$this->model->select($query);
	}

	function insert($query=NULL) {

		$this->model->insert($query);
	}

	function update($query=NULL) {

		$this->model->update($query);
	}

	function delete($query=NULL) {

		$this->model->delete($query);
	}
}
?>