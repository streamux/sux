<?php

class Object {

	var $class_name = 'object';

	function output( $msg) {

		echo $msg;
	}	

	function setName($name=NULL) {

		$this->class_name = $name;
	}

	function toString() {

		return $this->class_name;
	}
}
?>