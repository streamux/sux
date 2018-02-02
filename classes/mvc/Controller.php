<?php

class Controller extends Object {

  var $class_name = "base_controller";
  var $model = NULL;
  
  function __construct($m=NULL) {

    $this->model = $m;
  }

  function setCookieVersion() {

    $context = Context::getInstance();
    $context->setCookieVersion();
  }

  function select($query=NULL) {

    $result = $this->model->select($query);
    return $result;
  }

  function insert($query=NULL) {

    $this->setCookieVersion();
    
    $result = $this->model->insert($query);
    return $result;
  }

  function update($query=NULL) {

   $this->setCookieVersion();

    $result = $this->model->update($query);
    return $result;
  }

  function delete($query=NULL) {

    $this->setCookieVersion();

    $result = $this->model->delete($query);
    return $result;
  } 
}
?>