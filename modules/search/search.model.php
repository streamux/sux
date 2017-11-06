<?php
class SearchModel extends Model
{
  function select($table_name, $field = '*', $where = null, $orderby = null, $passover = 0, $limit = null) {

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
    return parent::select($query);
  }

  function insert($table_name, $columns = null) {

    $context = Context::getInstance();
    $tableName = $context->getTable($table_name);

    $query = new Query();
    $query->setTable($tableName);
    $query->setColumn($columns);

    return parent::insert($query);
  }

  function update($table_name, $columns, $where = null) {
    
    $context = Context::getInstance();
    $tableName = $context->getTable($table_name);

    $query = new Query();
    $query->setTable($tableName);
    $query->setColumn($columns);

    if (isset($where) && $where) {
      $query->setWhere($where);
    }

    return parent::update($query);
  }

  function delete($table_name, $where = null) {

    $context = Context::getInstance();
    $tableName = $context->getTable($table_name);

    $query = new Query();
    $query->setTable($tableName);
    
    if (isset($where) && $where) {
      $query->setWhere($where);
    }
    return parent::delete($query);
  }
}