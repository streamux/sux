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
				'class_path'=>_SUX_PATH_ . 'modules/' . $module . '/' . $module . '.admin.class.php',
				'route_path'=>_SUX_PATH_ . 'files/caches/routes/' . $module . '.admin.cache.php'
				);
			$classList[] = array(
				'class'=>ucfirst($module),
				'class_path'=>_SUX_PATH_ . 'modules/' . $module . '/' . $module . '.class.php',
				'route_path'=>_SUX_PATH_ . 'files/caches/routes/' . $module . '.cache.php'
				);

			foreach ($classList as $key => $value) {
				$classPath = $value['class_path'];
				$routePath = $value['route_path'];				
				if (file_exists($classPath)) {
					//echo $classPath . "<br>";
					$Class = $value['class'];
					$routes = array();

					if (isset($Class::$categories) && $Class::$categories) {
						$routes['categories'] = $Class::$categories;
					}
					if (isset($Class::$action) && $Class::$action) {
						$routes['action'] = $Class::$action;
					} 
					CacheFile::saveRoute( $routePath, $routes);
				}
			}
		}
	}

	function loadDBInfo() {

		$config_file = $this->getConfigFile();
		if (is_readable($config_file)) {
			include $config_file;
		}

		$db_info_list = array(	'db_hostname',
								'db_userid',
								'db_password',
								'db_database',
								'db_table_prefix');

		$db_info = array();
		for($i=0; $i<count($db_info_list); $i++) {
			$db_info[$db_info_list[$i]] = ${$db_info_list[$i]};
			unset(${$db_info_list[$i]});
		}
		$this->db_info = $db_info;
	}

	function getConfigFile() {		

		return _SUX_PATH_ . 'files/config/config.db.php';
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

		$admin_info = array();
		for ($i=0; $i<count($admin_list); $i++) {
			$admin_info[$admin_list[$i]] = ${$admin_list[$i]};
			unset(${$admin_list[$i]});
		}

		$this->admin_info = $admin_info;
	}

	function getAdminFile() {

		return _SUX_PATH_ . 'files/config/config.admin.php';
	}

	function loadTableInfo() {

		$table_file = $this->getTableFile();
		if (is_readable($table_file)) {
			include $table_file;
		}

		foreach ($table_list as $key => $value) {
			$this->setTable($key, $value);
		}

		unset($table_list);
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

	function checkAdminPass() {

		$is_logged = FALSE;
		if (md5($this->getAdminInfo('admin_id')) == $this->getSession('admin_id')) {
			$is_logged = TRUE;
		}
		return $is_logged;
	}

	function ajax() {

		$uri =  strtolower($this->getServer('REQUEST_URI'));
		if (preg_match('/jquery/', $uri)) {
			return true;
		}

		return false;
	}
}
?>