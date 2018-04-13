<?php

class QueryWhere extends Object {
  
  public static $_instance = null;
  var $class_name = 'query_where';
  var $sql = '';
  var $bindValues = array();
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

  function set( $field, $value='', $cond='=', $glue='and') {

    $bindField = ':' . $field . '_' . $this->counter;
    $this->setBindValue($bindField, $value);
    $isNumber = is_numeric($value);

    if ($isNumber !== true) {
      $value = Utils::mysql_real_escape_string($value);
    }

    if ($glue !== '' && $this->counter > 0) {
      $this->sql .= ' ' . $glue . ' ';
    }

    if (preg_match('/like/i', $cond)) {
     $this->sql .= $field . " LIKE CONCAT('%', " . $bindField . ", '%')";
    } else {
      $this->sql .= $field . $cond . $bindField;
    }

    $this->counter++;
  }

  function getBindValue() {

    return $this->bindValues;
  }

  function setBindValue( $key, $value) {

    $this->bindValues[$key] = $value;
  }

  function add($values) {

    $this->sql .= ' ' . $values . ' ';
  }

  function reset() {

    $this->sql = '';
    $this->counter = 0;
    $this->bindValues = array();
  }
}
?>