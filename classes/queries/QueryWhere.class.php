<?php

class QueryWhere extends Object {
  
  public static $_instance = null;
  var $class_name = 'query_where';
  var $sql = '';
  var $counter = 0;

  function __construct() {}

  public static function &getInstance() {

    if (self::$_instance === null) {
      self::$_instance = new self();
    }

    self::$_instance->reset();
    return self::$_instance;
  }

  function get() {

    return $this->sql;
  }

  function set($field,$value,$cond='=', $glue='and') {

    $isNumber = is_numeric($value);
    if ($isNumber !== true) {
     $value = mysql_real_escape_string($value);
    }

    if ($glue !== '' && $this->counter > 0) {
      $this->sql .= ' ' . $glue . ' ';
    }

    if (preg_match('/like/i', $cond)) {
      $this->sql .= $field . ' LIKE \'%' . $value . '%\'';
    } else {
      $this->sql .= $field . $cond . '\'' . $value . '\'';
    }

    $this->counter++;
  }

  function add($values) {

    $this->sql .= ' ' . $values . ' ';
  }

  function reset() {

    $this->sql = '';
    $this->counter = 0;
  }
}
?>