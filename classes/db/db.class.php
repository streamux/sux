<?php

class DB {

	private static $aInstance = NULL;

	var $is_connected = FALSE;
	var $master_db = NULL;

	function DB() {
		
		$context = Context::getInstance();
		$db_info = $context->getDBInfo();
		$db_connect = $this->_connect($db_info);
		$this->_select_db($db_info, $db_connect);
	}

	public static function getInstance() {

		if (empty(self::$aInstance)) {
			self::$aInstance = new self;
		}
		return self::$aInstance;
	}

	function _connect($db_info) {

		$db_connect = @mysql_connect($db_info['db_hostname'], $db_info['db_userid'], $db_info['db_password']);
		if (!$db_connect) {
			 die('서버 연결에 실패 했습니다. 계정 또는 패스워드를 확인하세요.');
		}		
		$master_db = 'MYSQL';		

		return $db_connect;
	}

	function _select_db($db_info, $db_connect) {

		$select = @mysql_select_db($db_info['db_database'], $db_connect);
		if (!$select) {
			die('데이터베이스 연결에 실패 했습니다. 데이터베이스명을 확인하세요.');
		}
		mysql_set_charset("utf8");

		return $select;
	}

	function isConnected() {

		return $this->master_db ? TRUE : FALSE;
	}

	function close($connection) {

		@mysql_close();
	}
}
?>