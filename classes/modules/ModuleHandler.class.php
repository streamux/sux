<?php

/**
*  @class ModuleHandler
*/
class ModuleHandler
{
  static $aInstance = null;

  public static function &getInstance()
  {
    if (empty(self::$aInstance)) {
      self::$aInstance = new self;
    }
    return self::$aInstance;
  }

  public function init()
  {
    $context = Context::getInstance();
    $versionCookieId = $context->getCookieId('version');
    $isEqual = $context->equalVersion($versionCookieId);

    if (!$isEqual) {
      $filePath = './files/cookie/version.cookie.php';
      $context->setCookie($versionCookieId, date('Y-m-d H:i:s'), time() + 86400 * 30 * 12, '/', $filePath);
      $context->makeRouteCaches();
      /*echo 'set cookie version is ' . date('Y-m-d H:i:s') . ' : location -> 25 line in ModuleHandler.class.php' . "<br>";*/
    }
    
    $router = RouterModule::getInstance();
    if ($context->installed()) {
      $router->init();
    } else {
      $router->install(); 
    }   
  }
}