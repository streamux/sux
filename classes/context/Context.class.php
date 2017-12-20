<?php

class Context
{ 

  private static $aInstance = NULL;
  private $hashmap_params = array();
  private $table_list = array();
  private $module_list = array();
  private $parameter_list = array();
  public $db_info = NULL;
  private $admin_info = Null;
  private$cookie_id = 'sux_version_date';

  public static function &getInstance() {

    if (empty(self::$aInstance)) {
      self::$aInstance = new self;
    }

    return self::$aInstance;
  }

  function init() {

    // fix missing HTTP_RAW_POST_DATA in PHP 5.6 and above
    /*if(!isset($GLOBALS['HTTP_RAW_POST_DATA']) && version_compare(PHP_VERSION, '5.6.0', '>=') === TRUE)
    {
      $GLOBALS['HTTP_RAW_POST_DATA'] = file_get_contents("php://input");
      
      // If content is not XML JSON, unset
      if(!preg_match('/^[\<\{\[]/', $GLOBALS['HTTP_RAW_POST_DATA']) && strpos($_SERVER['CONTENT_TYPE'], 'json') === FALSE && strpos($_SERVER['HTTP_CONTENT_TYPE'], 'json') === FALSE)
      {
        unset($GLOBALS['HTTP_RAW_POST_DATA']);
      }
    }*/

    $this->startSession();
    $this->loadDBInfo();
    $this->loadAdminInfo();
    $this->loadTableInfo();
  }

  function startSession() {
    
    session_set_cookie_params(0, _SUX_ROOT_);
    session_start();
  }

  function stopSession() {

    session_destroy();
  }

  /**
   * explode in InstallCass
   */ 
  function makeFilesDir($is_safe=false, $db_info=null) {

    $dirList = array(
      './files',
      './files/config',
      './files/caches',
      './files/caches/queries',
      './files/caches/routes',
      './files/cookie',
      './files/board',
      './files/document',
      './files/gnb'
    );

    $msg = '';
    foreach ($dirList as $key => $dir) {
      $msg .= FileHandler::makeDir($dir, $is_safe, $db_info);
      $msg .= "\n";
    }

    return $msg;
  }

  function makeRouteCaches() {

    $moduleList = FileHandler::readDir('./modules');
    foreach ($moduleList as $key => $value) {
      $module = $value['file_name'];

      $classList = array();
      $classList[] = array( 'class'=>ucfirst($module) . 'Admin',
                'class_path'=>'./modules/' . $module . '/' . $module . '.admin.class.php',
                'route_path'=>'./files/caches/routes/' . $module . '.admin.cache.php' );

      $classList[] = array( 'class'=>ucfirst($module),
                'class_path'=>'./modules/' . $module . '/' . $module . '.class.php',
                'route_path'=>'./files/caches/routes/' . $module . '.cache.php' );
      $routedValue = null;

      foreach ($classList as $key => $value) {
        $classPath = $value['class_path'];
        $routePath = $value['route_path'];

        if (file_exists($routePath)) {          
          $routedValue = CacheFile::readFile($routePath);
        }

        if (file_exists($classPath)) {
          $Class = $value['class'];
          $routes = array();

          // set category
          $classCategories = array();
          $routedCategories = array();
          $classAction = array();
          $routedAction = array();

          if (isset($Class::$categories) && $Class::$categories) {            
            $classCategories = $Class::$categories;         
          }

          if (isset($routedValue['categories']) && $routedValue['categories']) {
            $routedCategories = $routedValue['categories'];             
          }

          $categories = array_merge($classCategories, $routedCategories);
          $categories = array_unique($categories);
          $routes['categories'] = $categories;

          // set action
          if (isset($Class::$action) && $Class::$action) {
            $classAction = $Class::$action;           
          } 

          if (isset($routedValue['action']) && $routedValue['action']) {
            $routedAction = $routedValue['action'];             
          }

          $actions = array_merge($classAction, $routedAction);          
          $actions = array_unique($actions);
          $routes['action'] = $actions;

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


    $post = $this->_getTrimRequestData($_POST[$key]);
    if (empty($post)) {

      $json = $this->getJson();
      $posts = $this->getJsonToArray($json);
      $post = $posts[$key];
      if (empty($post)) {

        // 실서버 반영 시 반드시 주석처리        
        if ($this->isLocalhost()) {
          $post = $this->getRequestToArray($key);
        } 
      }   
    }
    
    return $post;
  }

  function setPost($key, $value) {

    $_POST[$key] = $value;
  }

  function getPostAll() {

    $posts = $this->_getTrimRequestData($_POST);
    if (empty($posts)) {

      $json = $this->getJson();
      $posts = $this->getJsonToArray($json);
      if (empty($posts)) {

        // 로컬 서버에서만 실행 
        if ($this->isLocalhost()) {
          $posts = $this->getRequestAllToArray();
        }
      }
    }
    return $posts;
  }

  function getJson() {

    return file_get_contents('php://input');
  }

  /////////////////////////// Utils.Class 에 정의 됨
  function getJsonToArray($value) {

    $result = array();
    $tempArr = json_decode($value);
    foreach ($tempArr as $key => $value) {
      $result[$key] = $value;
    } // end of key type
    
    return $result;
  }

  /////////////////////////// Utils.Class 에 정의 됨
  function getArrayToObject($value) {

    $result = array();
    $tempArr = $value;

    for ($i=0; $i<count($tempArr); $i++) {
      $result[$i] = array();

      foreach ($tempArr[$i] as $key => $value) {
        $result[$i][$key] = $value;
      } 
    } // end of key type

    return $result;
  }

  function getRequest($key) {

    return $this->_getTrimRequestData($_REQUEST[$key]);
  }

  function setRequest($key, $value) {

    $_REQUEST[$key] = $value;
  }

  function getRequestAll() {

    return $this->_getTrimRequestData($_REQUEST);
  }

  /**
   * value    date('Y-m-d H:i:s')
   * expiry time() + 86400 * 30 * 12
   */
  function setCookie($name, $value, $expiry, $path='/') {
    
    $path = './files/cookie/version.cookie.php';
    if (isset($value) && $value) {
      setcookie($name, $value, $expiry, $path);

      $buf = array();
      $buf[] = "<?php\n";
      $buf[] = "\$version=array('" . $name . "'=>'" . $value . "');\n";
      $buf[] = "return \$version;\n";
      $buf[] = "?>";
      FileHandler::writeFile( $path, $buf);
    } else {
      unset($_COOKIE[$name]);
      setcookie($name, '', time()-1);
      unlink($path);
    }   
  }

  function getCookie($name) {
    return $_COOKIE[$name];
  }

  function getCookieId()
  {
    return $this->cookie_id;
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

    return $this->_getTrimRequestData($_GET[$key]);
  }

  function getGetAll() {

    return $this->_getTrimRequestData($_GET);
  }

  function getFiles() {

    return $_FILES;
  }

  function getFileAll() {

    return $_FILES;
  }

  function getSession($key) {

    return $this->_getTrimRequestData($_SESSION[$key]);
  }

  function setSession($key, $value) {

    $_SESSION[$key] = $value;
  }

  function getSessionAll() {

    return $this->_getTrimRequestData($_SESSION);
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

  function getPasswordHash($password) {

    return md5($password);
  }

  function isLocalhost() {

    $domain = $this->getServer('HTTP_HOST');
    $result = preg_match('/^(http\:\/\/)?(localhost|127.0.0.1)+/', $domain);
    return $result;
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
    if (preg_match('/(callback)+/', $uri)) {
      return true;
    }

    return false;
  }

  function equalVersion($name) {

    $path = './files/cookie/version.cookie.php';    
    if (!file_exists($path) || empty($name)) {
      return false;
    }
    $cookieVersion = trim($this->getCookie($name));
    $fileVersion = CacheFile::readFile($path, $name);

    return $cookieVersion === $fileVersion;
  }

  function installed() {
    return isset($this->db_info) == true;
  }

  function _getTrimRequestData($dataes) {

    if (!is_array($dataes)) {
      return trim($dataes);
    }

    foreach ($dataes as $key => $value) {
      $dataes[$key] = trim($value);
    }
    return $dataes;
  }
}
?>