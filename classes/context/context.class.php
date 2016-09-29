<?php

class Context {

	private static $aInstance = NULL;
	private $hashmap_params = array();
	private $table_list;
	public $db_info = NULL;
	var $class_name = 'context';

	function __contruct() {}

	public static function &getInstance() {

		if (empty(self::$aInstance)) {
			self::$aInstance = new self;
		}

		return self::$aInstance;
	}

	function init() {
	
		$this->startSession();
		$this->loadDBInfo();
		$this->loadAdminInfo();
		$this->setTablesInfo();
	}

	function startSession() {

		session_start();
	}

	function stopSession() {

		session_destroy();
	}

	function loadDBInfo() {

		$config_file = $this->getConfigFile();
		if (is_readable($config_file)) {
			include $config_file;
		}

		$db_info_list = array(	'db_hostname',
								'db_userid',
								'db_password',
								'db_database');

		$db_info = array();
		for($i=0; $i<count($db_info_list); $i++) {
			$db_info[$db_info_list[$i]] = ${$db_info_list[$i]};
			unset(${$db_info_list[$i]});
		}

		$this->setDbInfo($db_info);
	}

	function getConfigFile() {

		return _SUX_PATH_ . 'config/config.db.php';
	}

	function loadAdminInfo() {

		$admin_file = $this->getAdminFile();
		if (is_readable($admin_file)) {
			include $admin_file;
		}

		$admin_list = array(	'admin_id',
								'admin_pwd',
								'admin_email',
								'yourhome');

		$table_key_prefix = 'db_';
		for ($i=0; $i<count($admin_list); $i++) {
			$this->set($table_key_prefix . $admin_list[$i], ${$admin_list[$i]});
			unset(${$admin_list[$i]});
		}
	}

	function getAdminFile() {

		return _SUX_PATH_ . 'config/config.admin.php';
	}

	function setTablesInfo() {

		$this->table_list = array('popup','memo','board_group','member_group','question','questiont','questionc','dayman','post','connecter','connecter_real','connecter_real_all','connecter_all','connecter_site','pageview','calender');

		$table_key_prefix = 'db_';
		for($i=0; $i<count($this->table_list); $i++) {
			$this->set($table_key_prefix . $this->table_list[$i], $this->table_list[$i]);
		}
	}

	function getDB() {

		return $this->db_info['db_database'];
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

	function setPost($key, $value) {

		$_POST[$key] = $value;
	}

	function getPostAll() {

		return $_POST;
	}

	function getRequest($key) {

		return $_REQUEST[$key];
	}

	function setRequest($key, $value) {

		$_REQUEST[$key] = $value;
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

	function getFiles() {

		return $_FILES;
	}

	function getFileAll() {

		return $_FILES;
	}

	function getSession($key) {

		return $_SESSION[$key];
	}

	function setSession($key, $value) {

		$_SESSION[$key] = $value;
	}

	function getSessionAll() {

		return $_SESSION;
	}

	function getServer($key) {

		return $_SERVER[$key];
	}

	function getServers() {

		return $_SERVER;
	}

	function getServerAll() {

		return $_SERVER;
	}

	function set($key, $val) {

		$this->hashmap_params[$key] = $val;
	}

	function get($key) {

		return $this->hashmap_params[$key];
	}

	function getAll() {

		return $this->hashmap_params;
	}

	function getTableList() {

		return $this->table_list;
	}

	function checkAdminPass() {

		$is_logged = FALSE;
		if (md5($this->get('db_admin_id')) == $this->getSession('admin_id')) {
			$is_logged = TRUE;
		}
		return $is_logged;
	}
}
?>