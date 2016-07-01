<?php

class Context {

	private static $aInstance = NULL;
	private $hashmap_params = array();
	public $db_info = NULL;

	function Context() {
				
	}

	public static function getInstance() {

		if (empty(self::$aInstance)) {
			self::$aInstance = new self;
		}

		return self::$aInstance;
	}

	function init() {

		$this->loadDBInfo();
	}

	function loadDBInfo() {

		$config_file = $this->getConfigFile();
		if (is_readable($config_file)) {
			include $config_file;
		}

		if (!isset($db_info)) {
			$db_info = array();
		}

		$db_info['db_hostname'] = $mysql_host;
		unset($mysql_host);
		$db_info['db_userid'] = $mysql_user;
		unset($mysql_user);
		$db_info['db_password'] = $mysql_pwd;
		unset($mysql_pwd);
		$db_info['db_database'] = $mysql_db;
		unset($mysql_db);

		$this->setDbInfo($db_info);
	}

	function getConfigFile() {

		return _SUX_PATH_ . 'config/db.config.php';
	}
	
	function getDBInfo() {

		return $this->db_info;
	}

	function setDbInfo($db_info) {

		$this->db_info = $db_info;
	}

	function getPost($key) {

		return $_POST[$key];
	}

	function getPostAll() {

		return $_POST;
	}

	function getRequest($key) {

		return $_REQUEST[$key];
	}

	function getRequestAll() {

		return $_REQUEST;
	}

	function getGet($key) {

		return $_GET[$key];
	}

	function getGetAll() {

		return $_GET;
	}

	function getSession($key) {

		return $_SESSION[$key];
	}

	function getSessionAll() {

		return $_SESSION;
	}

	function set($key, $val) {

		$this->hashmap_params[$key] = $val;
	}

	function get($key) {

		return $this->hashmap_params[$key];
	}
}
?>