<?php

class Controller extends Object
{
  var $class_name = "base_controller";
  var $model = NULL;
  
  function __construct($m=NULL)
  {
    $this->model = $m;
  }

  function getModel()
  {
    return $this->model;
  }
}
?>