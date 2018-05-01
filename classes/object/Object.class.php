<?php

class Object {

  var $class_name = 'object';

  function output($msg) {

    echo $msg . "<br>";
  } 

  function setName($name=NULL) {

    $this->class_name = $name;
  }

  function toString() {

    return $this->class_name;
  }

  function tester($item) {

    $msg = '';

    if (is_string($item)) {
      $msg = $item;
    } else if (is_array($item)) {
      $msg = print_r($str);
    }

    $context = Context::getInstance();
    if ($context->ajax()) {
      $data = array("msg"=>$msg);
      $this->callback($data);     
    } else {
      echo $msg;
    }   
  }

  function callback($data) {
    
    $context = Context::getInstance();
    if ($context->ajax()) {
      $data['msg'] = preg_replace("/<br>/", "\n",$data['msg']);
      $callback = $context->getRequest('callback');
      $strcallback = strtolower($callback);
      $strJson = JsonEncoder::parse($data);

      if (preg_match('/(jsonp|jquery)+/', $strcallback) === 1) {
        echo $callback . '('.$strJson.')';        
      } else {
        echo $strJson;    
      }   
    } else {
      $delay = (isset($data['delay']) ||  $data['delay'] === 0) ? $data['delay'] : 0;
      if ($delay > 0) {
        echo $data['msg'];
      }     
      $url = $data['url'];    
      if (!empty($url)) {
        printf("<meta http-equiv='Refresh' content='%s; URL=%s'>", $delay, $url);
      }     
    }   
  }
}
?>