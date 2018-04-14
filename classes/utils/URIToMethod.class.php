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

    if (strlen(_SUX_ROOT_) == 1 && substr_compare(_SUX_ROOT_, '/', 0, 1) == 0) {
      $uriName = substr($uriName, 1);
    } else {
      $uriName = explode(_SUX_ROOT_, $uriName);
      $uriName = $uriName[1];
    }
    $uries = explode('/', $uriName);

    for ($i=0; $i<count($uries); $i++) {
      $typeInt = (int) $uries[$i];

      // 문자열 값만 저장 
      if ($typeInt === 0) {
        $arr[] = $uries[$i];
      }      
    }

    $this->lists['module-key'] = $arr[0];
    $this->lists['category'] = empty($arr[1]) ?  null : $arr[0]; 
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