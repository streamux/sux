<?php

class BaseController extends Object {

	var $name = "base_controller";
	var $model = NULL;
	
	function __construct($m=NULL) {
		
		$this->model = $m;
	}
}
?>