<?php

class Context { 

	private static $aInstance = NULL;
	private $hashmap_params = array();
	private $table_list = array();
	private $module_list = array();
	private $parameter_list = array();
	public $db_info = NULL;
	private $admin_info = Null;

	public static function &getInstance() {

		if (empty(self::$aInstance)) {
			self::$aInstance = new self;
		}

		return self::$aInstance;
	}

	function init() {

		$this->startSession();
		$this->makeFilesDir();
		$this->makeRouteCaches();
		$this->loadDBInfo();
		$this->loadAdminInfo();
		$this->loadTableInfo();
	}

	function startSession() {

		session_start();
	}

	function stopSession() {

		session_destroy();
	}

	function makeFilesDir() {

		$dirList = array(
			'./files',
			'./files/config',
			'./files/caches',
			'./files/caches/queries',
			'./files/caches/routes',
			'./files/board',
			'./files/document'
		);

		foreach ($dirList as $key => $dir) {
			FileHandler::makeDir($dir, false);
		}
	}

	function makeRouteCaches() {

		$moduleList = FileHandler::readDir('./modules');
		foreach ($moduleList as $key => $value) {
			$module = $value['file_name'];

			$classList = array();
			$classList[] = array(
				'class'=>ucfirst($module) . 'Admin',
				'class_path'=>'./modules/' . $module . '/' . $module . '.admin.class.php',
				'route_path'=>'./files/caches/routes/' . $module . '.admin.cache.php'
				);
			$classList[] = array(
				'class'=>ucfirst($module),
				'class_path'=>'./modules/' . $module . '/' . $module . '.class.php',
				'route_path'=>'./files/caches/routes/' . $module . '.cache.php'
				);

			foreach ($classList as $key => $value) {
				$classPath = $value['class_path'];
				$routePath = $value['route_path'];

				if (file_exists($routePath)) {
					continue;
				}

				if (file_exists($classPath)) {
					$Class = $value['class'];
					$routes = array();
					if (isset($Class::$categories) && $Class::$categories) {
						$routes['categories'] = $Class::$categories;
					}
					if (isset($Class::$action) && $Class::$action) {
						$routes['action'] = $Class::$action;
					} 
					CacheFile::writeFile( $routePath, $routes);
				}
			}
		}
	}

	function loadDBInfo() {

		$filename = $this->getConfigFile();
		if (is_readable($filename)) {
			$result = include $filename;			
			$this->db_info = $result['db_info'];
			unset($result);
		}		
	}

	function getConfigFile() {		

		return _SUX_PATH_ . 'files/config/config.db.php';
	}

	function loadAdminInfo() {

		$admin_file = $this->getAdminFile();
		if (is_readable($admin_file)) {
			$result = include $admin_file;
			$this->admin_info = $result['admin_info'];
			unset($result);
		}
	}

	function getAdminFile() {

		return _SUX_PATH_ . 'files/config/config.admin.php';
	}

	function loadTableInfo() {

		$filename = $this->getTableFile();
		if (is_readable($filename)) {
			$result = include $filename;
			foreach ($result['table_list'] as $key => $value) {
				$this->setTable($key, $value);
			}
			unset($result);
		}		
	}

	function getTableFile() {

		return _SUX_PATH_ . 'files/config/config.table.php';
	}

	function getPrefix() {

		return $this->db_info['db_table_prefix'];
	}

	function getTable( $key ) {

		return $this->table_list[$key];
	}
	
	/**
	 * @method setTable
	 * @param $key
	 * @param $value 
	 * 접두사가 붙은 값을 저장한다.
	 */
	function setTable( $key, $value ) {

		$this->table_list[$key] = $value;
	}

	function getModule( $key ) {

		return $this->module_list[$key];
	}

	function setModule( $key, $value) {

		$this->module_list[$key] = $value;
	}

	function getAdminInfo($key) {

		if (isset($key) && $key) {
			return $this->admin_info[$key];
		} else {
			return $this->admin_info;
		}
	}

	function getDB($key) {

		return $this->db_info['db_database'];
	}

	function getDBInfo($key) {

		if (isset($key)) {
			return $this->db_info[$key];
		} else {
			return $this->db_info;
		}		
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

	function getRequestToArray($key) {

		$request = $this->getRequestAllToArray();
		return $request[$key];
	}

	function getRequestAllToArray() {

		$result = array();
		$requests = $this->getRequestAll();
		foreach ($requests as $key => $value) {
			$result[$key] = $value;
		}
		return $result;
	}

	function getReqeustMethod() {

		return $_SERVER['REQUEST_METHOD'];
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

	function getJsonToArray($value) {

		$result = array();
		$tempArr = json_decode($value);
		foreach ($tempArr as $key => $value) {
			$result[$key] = $value;
		}
		return $result;
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

	function getParameter( $key) {

		return $this->parameter_list[$key];
	}

	function setParameter( $key, $value) {

		$this->parameter_list[$key] = trim($value);
	}

	function geParameters() {

		return $this->parameter_list;
	}

	function getPasswordHash($password) {

		return md5($password);
	}

	function checkAdminPass() {

		$is_logged = false;
		if ($this->getPasswordHash($this->getAdminInfo('admin_id')) == $this->getSession('admin_id')) {
			$is_logged = true;
		}
		return $is_logged;
	}

	function ajax() {

		$uri =  strtolower($this->getServer('REQUEST_URI'));
		if (preg_match('/(jquery|callback)/', $uri)) {
			return true;
		}

		return false;
	}
}
?>