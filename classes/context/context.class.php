<?php

class Context {

	private static $aInstance = NULL;
	private $hashmap_params = array();

	function Context() {

	}

	public static function getInstance() {

		if (empty(self::$aInstance)) {
			self::$aInstance = new self;
		}

		return self::$aInstance;
	}

	function setParam($key, $val) {

		$this->hashmap_params[$key] = $val;
	}

	function getParam($key) {

		return $this->hashmap_params[$key];
	}
}
?>