<?php

class DB {

	private static $aInstance = NULL;

	public static function getInstance() {

		if (empty(self::$aInstance)) {
			self::$aInstance = new self;
		}
		return self::$aInstance;
	}
}
?>