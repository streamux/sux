<?php

/**
*  @class ModuleHandler
*/
class ModuleHandler
{
  private static $aInstance = null;

  public static function &getInstance()
  {
    if (empty(self::$aInstance)) {
      self::$aInstance = new self;
    }
    return self::$aInstance;
  }

  function init()
  {
    $context = Context::getInstance();
    $isEqual = $context->equalCookieVersion();
    if (!$isEqual) {
      $context->setCookieVersion();
      $context->makeRouteCaches();
    }
    
    $router = RouterModule::getInstance();    
    if ($context->installed()) {
      $router->init(); 
    } else {
      $router->install(); 
    }    
  }
}