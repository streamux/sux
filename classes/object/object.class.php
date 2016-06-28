<?php

class Object {

	var $name = 'object';

	function __construct($name=NULL) {

		$this->name = $name;
	}

	function toString() {

		return $this->name;
	}
}
?>