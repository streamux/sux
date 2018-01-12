<?php
class URIToMethod
{
  private static $urlInstance = null;
  var $lists = array();

  public static function getInstance() {

    if (empty(self::$urlInstance)) {
      self::$urlInstance = new self;
    }

    return self::$urlInstance;
  }

  function setURI( $uri ) {

    $arr = array();
    $uri = explode('?', $uri);
    $uriName = $uri[0];
    $uries = explode(_SUX_ROOT_, $uriName);
    $uries = explode('/', $uries[1]);

    for ($i=0; $i<count($uries); $i++) {        
      $arr[] = $uries[$i];
    }

    $this->lists['module-key'] = $arr[0];    
    $this->lists['category'] = empty($arr[1]) ?  null : $this->replaceHyphenToCamel($arr[0]); 
    $this->lists['action'] =  empty($arr[1]) ?  $this->replaceHyphenToCamel($arr[0]) : $this->replaceHyphenToCamel($arr[1]);
  }

  function replaceHyphenToCamel( $action ) {

    if (strstr($action, '-') != -1) {
      $pieces = explode('-', $action);
      $action = $pieces[0];
      for ($i=1; $i<count($pieces); $i++) {
        $action .= ucfirst($pieces[$i]);
      }
    }
    return $action;
  }

  function getMethod($key) {

    if (empty($key)) {
      return null;
    }

    $method = $this->lists[$key];

    if (empty($method)) {
      return null;
    }

    if (!preg_match("/^([a-z0-9\_\-]+)$/i", $method)) {
      echo $key . ' is not available';
      exit;
    }

    return $method;
  }
}