<?php

class DB {

	private static $aInstance = NULL;

	var $is_connected = FALSE;
	var $master_db = NULL;

	function DB() {

		$this->_connect();
	}

	public static function getInstance() {

		if (empty(self::$aInstance)) {
			self::$aInstance = new self;
		}
		return self::$aInstance;
	}

	function _connect() {

		
	}

	function isConnected() {

		return $this->master_db ? TRUE : FALSE;
	}

}
?>