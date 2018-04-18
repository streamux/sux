<?php
class RouterModule
{
  private static $aInstance = null;
  private static $cache_data = null;
  var $router = null;
  var $baseUrl = '/';
  var $explodingMethod = '';

  public static function &getInstance()
  {
    if (empty(self::$aInstance)) {      
      self::$aInstance = new self;      
    }
    return self::$aInstance;
  }

  function init() 
  {
    $this->explodingMethod = 'setupRoute';
    $this->initRoute();
  }

  function install()
  {
    echo 'aaa';
    $this->explodingMethod = 'setupInstallRoute';
     echo 'aaa';
    $this->initRoute();
     echo 'aaa';
  }

  private function initRoute()
  {

    echo "<br>";
    echo PHP_VERSION ;

    if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
      $this->setFastRoute();
    } else {
      $this->setEpiRoute();
    }   
  }

  /*
   * @ method setEpiRoute
   * @ description php 5.3.29 이상 ~ 5.6.39 이하 지원 라우터 
   */
  private function setEpiRoute() {

    Epi::setPath('base', _SUX_PATH_ . 'libs/jmathai/epiphany/src');
    Epi::setSetting('exceptions', false);
    Epi::init('route'); 
    getRoute()->get('/', array( 'PageModule', 'display')); 

    // Epi::init('base','cache','session');
    // Epi::init('base','cache-apc','session-apc');
    // Epi::init('base','cache-memcached','session-apc');
  }

  /*
   * @ method setEpiRoute
   * @ description php 5.34.0 이상 지원 라우터 
   */
  private function setFastRoute() {

    $this->baseUrl = _SUX_ROOT_;

    if (preg_match('/\/$/', $this->baseUrl)) {
      $this->baseUrl = preg_replace('/\/$/', '', $this->baseUrl);
    }

    $dispatcher = FastRoute\simpleDispatcher( function( FastRoute\RouteCollector $r ) {
      $this->router = $r;
      $this->addRoute('/', array('PageModule','display'));   
      $this->{$this->$explodingMethod}();
    });

    $httpMethod = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];

    // Strip query string (?foo=bar) and decode URI
    if (false !== $pos = strpos($uri, '?')) {
        $uri = substr($uri, 0, $pos);
    }
    $uri = rawurldecode($uri);
    $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

    switch ($routeInfo[0]) {
      case FastRoute\Dispatcher::NOT_FOUND:
          // ... 404 Not Found
          echo '404 Not Found';
          break;

      case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
          $allowedMethods = $routeInfo[1];
          // ... 405 Method Not Allowed
          echo '405 Method Not Allowed';
          break;

      case FastRoute\Dispatcher::FOUND:
          $handler = $routeInfo[1];
          $vars = $routeInfo[2];        
          list($class, $method) = explode("/", $handler, 2);
          call_user_func_array(array('PageModule', 'display'), $vars);
          // ... call $handler with $vars
          break;
    }
  }

  private function setupInstallRoute()
  {
    $context = Context::getInstance(); 
    $actionList = Install::$action;
    for ($k=0; $k<count($actionList); $k++) {
      $mAction = (string) $actionList[$k];
      $context->setModule($mAction, 'Install');
      $this->addSingleKeyRoute($mAction);
    }
  }

  private function setupRoute() 
  {
    $context = Context::getInstance(); 
    $moduleList = Utils::readDir('modules');
    $classList = array();

    foreach ($moduleList as $key => $value) {
      $dirName = strtolower($value['file_name']);

      if (preg_match('/^[a-z_][a-z0-9_]+/', $dirName)) {
        $ClassName = ucfirst($dirName);
        $classList[] = array( 'module'=>$dirName, 'class'=>$ClassName,
                  'path'=>'./files/caches/routes/' . $dirName . '.cache.php');
        $classList[] = array( 'module'=>$dirName, 'class'=>$ClassName."Admin",
                  'path'=>'./files/caches/routes/' . $dirName . '.admin.cache.php');
      }      
    }   // end of foreach

    for($i=0; $i<count($classList); $i++) {
      $cachePath = $classList[$i]['path'];

      if (file_exists($cachePath)) {
        $this->loadCacheFile($cachePath);
        $mClass = (string) $classList[$i]['class'];        
        $categoryList = $this->getRouteKey('categories');
        $actionList = $this->getRouteKey('action');

        if (isset($categoryList) && $categoryList && count($categoryList) > 0) {

          for ($j=0; $j<count($categoryList); $j++) {            
            $mCategory = (string) $categoryList[$j];
            $context->setModule($mCategory, $mClass);
            $this->addSingleKeyRoute($categoryList[$j]);

            if (isset($actionList) && $actionList && count($actionList)) {

              for ($k=0; $k<count($actionList); $k++) {      
                $mAction = (string) $actionList[$k];
                $context->setModule($mAction, $mClass);
                $this->addMultiKeyRoute($mCategory, $mAction);
              }
            }
          }
        } else {

          if (isset($actionList) && $actionList && count($actionList)) {

              for ($k=0; $k<count($actionList); $k++) {
                $mAction = (string) $actionList[$k];
                $context->setModule($mAction, $mClass);
                $this->addSingleKeyRoute($mAction);
              }
            }
        }
      }   // end of if
    }   // end of foreach : module list
  }

  private function addSingleKeyRoute( $action)
  {
    $this->addRoute( sprintf('/%s', $action), array( 'PageModule', 'display'));
    $this->addRoute( sprintf('/%s/{id:\d+}', $action), array( 'PageModule', 'display'));
  }

  private function addMultiKeyRoute( $category, $action)
  {
    $this->addRoute( sprintf('/%s/%s', $category, $action), array( 'PageModule', 'display'));
    $this->addRoute( sprintf('/%s/%s/{id:\d+}', $category, $action), array( 'PageModule', 'display'));
    $this->addRoute( sprintf('/%s/{id:\d+}/%s', $category, $action), array( 'PageModule', 'display'));
    $this->addRoute( sprintf('/%s/{id:\d+}/%s/{sid:\d+}', $category, $action), array( 'PageModule', 'display'));
  }

  private function addRoute( $route, $class)
  {
    if (!preg_match(sprintf('/^(\%s)(\/)?$/', $this->baseUrl), $route)) {
      $route = $this->baseUrl . $route;
    }

    //$this->router->addRoute(['GET', 'POST'], $route, $class);
  }

  private function loadCacheFile( $path)
  {
    $filename = $this->getRealPath($path);
    $pathinfo = pathinfo($file);
    $this->cache_data = array('categories'=>null, 'action'=>null);

    if (file_exists($filename)) {
      include $filename;

      foreach ($this->cache_data as $key => $value) {
        $this->cache_data[$key] = ${$key};
        unset(${$key});
      }     
    } else {
      printf("[ %s ] Cache File don't exist<br>", $$pathinfo['filename']);
    }   
  }

  private function getRouteKey($key)
  {    
    return $this->cache_data[$key];
  }

  private function getRealPath($path)
  {
    if(strlen($path) >= 2 && substr_compare($path, './', 0, 2) === 0) {
      return _SUX_PATH_ . substr($path, 2);
    }
    return $path;
  }
}