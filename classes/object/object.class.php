<?php

class Object {

	var $class_name = 'object';

	function Object($name=NULL) {

		$this->class_name = $name;
	}

	function output($str) {

		echo $str . '<br>';
	}

	function toString() {

		return $this->class_name;
	}
}
?>