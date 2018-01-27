<?php

class QuerySchema extends Object {
  
  public static $aInstance = null;
  var $class_name = 'query_schema';
  var $_schemas = array();
  var $_schema;
  var $_name = '';
  var $_type = '';
  var $_length = 0;
  var $_notnull = null;
  var $_autoincrement = null;
  var $_primarykey = null;
  var $_counter = 0;

  public static function &getInstance() {

    if (empty(self::$aInstance)) {
      self::$aInstance = new self;
    }
    return self::$aInstance;
  }
  
  function reset() {

    $this->_schemas = array();
  }

  function get() {

    return $this->_schemas;
  }

  function add($name, $type, $size=0, $default=null, $notnull=null, $autoincrement=null, $primarykey=null) {

    $str = '';
    $str .= $name . ' ' . $type;

    if ($size > 0) {
      $str .=  '(' . $size . ')';
    }

    if (isset($default) || $default != '' || !is_null($default )) {
      $str .= " default '" . $default . "'";
    }

    if (isset($notnull) || $notnull != '' || !is_null($notnull)) {
      $str .=  ' not null';
    }

    if (isset($autoincrement) || $autoincrement != '' || !is_null($autoincrement)) {
      $str .=  ' auto_increment';
    }

    if (isset($primarykey) || $primarykey != '' || !is_null($primarykey)) {
      $str .= ' primary key';
    }

    $this->_schemas[] = $str;
  }

  function setName($name) {

    $this->_schema = &$this->_schemas[$this->_counter];
    $this->_schema = $name;
    $this->_counter++;
    //return self;
  }

  function setType($type) {
    
    $this->_schema .= ' ' . $type;    
    //return self;
  }

  function setLength($length) {
    
    $this->_schema .= '(' . $length . ')';
    //return self;
  }

  function setNotnull() {

    $this->_schema .= ' not not';
    //return self;
  }

  function setAutoincrement() {

    $this->_schema .= ' auto_increment';
    //return self;
  }

  function setPrimarykey( $key ) {

    $this->_schemas[] = 'primary key(' . $key . ')';
    //return self;
  }
}
?>