<?php

class BaseView {

	var $class_name = "base_view";
	var $model = NULL;

	function BaseView($m=NULL) {
		
		$this->model = $m;
	}

	function toString() {

		return $this->class_name;
	}
}
?>