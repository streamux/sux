<?php

class Model extends Object {

  var $class_name = 'model';
  var $query_sql = '';
  var $hashmap_params = array();
  var $db = NUll;
  var $fetchArrayList = NULL;
  var $rownum = 0;

  function __construct() {

    $this->db = DB::getInstance();
    $this->db->connect();
  }
  
  function select( $table_name, $field = '*', $where = null, $orderby = null,
      $passover = 0, $limit = null) {

    $context = Context::getInstance();
    $tableName = $context->getTable($table_name);

    $query = new Query();
    $query->setTable($tableName);
    $query->setField($field);

    if (isset($where) && $where) {
      $query->setWhere($where);
    }

    if (isset($orderby) && $orderby) {
      $query->setOrderBy($orderby);
    }

    if (isset($limit) && $limit) {
      $query->setLimit($passover, $limit);
    }

    return $this->db->select($query);
  }

  function insert( $table_name, $columns = null) {

    $context = Context::getInstance();
    $context->setCookieVersion();
    $tableName = $context->getTable($table_name);

    $query = new Query();
    $query->setTable($tableName);
    $query->setColumn($columns);

    return $this->db->insert($query);
  }

  function update( $table_name, $columns, $where = null) {

    $context = Context::getInstance();
    $context->setCookieVersion();
    $tableName = $context->getTable($table_name);

    $query = new Query();
    $query->setTable($tableName);
    $query->setColumn($columns);

    if (isset($where) && $where) {
      $query->setWhere($where);
    }

    return $this->db->update($query);
  }

  function delete( $table_name, $where = null) {

    $context = Context::getInstance();
    $context->setCookieVersion();
    $tableName = $context->getTable($table_name);

    $query = new Query();
    $query->setTable($tableName);
    
    if (isset($where) && $where) {
      $query->setWhere($where);
    }

    return $this->db->delete($query);
  }

  function showTables($query) {

    $this->result = $this->db->showTables($query);
    return $this->result;
  }

  function getLastInsertId() {

    return $this->db->getLastInsertId();
  }

  function createTable($query) {

    return $this->db->createTable($query);
  }

  function dropTable($query) {

    return $this->db->dropTable($query);
  }

  function getMysqlFetchArray() {

    return $this->db->getFetchArray();
  }

  function getMysqlNumrows() {

    return $this->db->getNumRows();
  }

  function getNumRows() {

    return $this->db->getNumRows();
  }

  function getRows() {

    $datas = array();

    while(($row = $this->db->getFetchArray()) !== false) {
      $fields = array();

      foreach ($row as $key => $value) {

        if (is_string($key) !== false) {
          $fields[$key] = $value;
        }       
      }
      
      $datas[] = $fields;
    }
    
    return $datas;
  }

  function getRow() {

    $rows = $this->getRows();
    return $rows[0];
  }

  function getJson($ignore=TRUE) {

    $numrow = $this->getNumRows();

    if ($numrow > 1) {
      $str_data = $this->getRows();
    } else {
      $str_data = $this->getRow();
    }

    return JsonEncoder::getInstance()->parse($str_data);
  }

  function parseToJson($rows) {

    return JsonEncoder::getInstance()->parse($rows);
  }
}
?>