<?php

class Object {

	var $name = 'object';

	function Object($name=NULL) {

		$this->name = $name;
	}

	function toString() {

		return $this->name;
	}
}
?>