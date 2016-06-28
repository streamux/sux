<?php

class BaseController extends Object {

	var $name = "base_controller";
	var $model = NULL;
	
	function BaseController($m=NULL) {
		
		$this->model = $m;
	}
}
?>