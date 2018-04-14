<?php

class Query extends Object {

  private static $aInstance = NULL;

  var $db = null;
  var $tableId = '';
  var $priority;
  var $fields = '';
  var $column_list = '';
  var $column_keys = array();
  var $column_values = array();
  var $columnBindValues = array();
  var $where = null;  
  var $whereBindValues = array();
  var $index_hint = '';
  var $groupBy = '';
  var $orderBy = '';
  var $limit = '';
  var $schema = '';

  public static function &getInstance() {

    if (empty(self::$aInstance)) {
      self::$aInstance = new self;
    }
    return self::$aInstance;
  }

  function setSQL($obj=NULL) {

    $table =$obj['table'];

    if ($table !== '') {
      $this->setTable($table);
    }

    $priority =$obj['priority'];

    if ($priority !== '') {
      $this->setPriority($priority);
    }

    $column =$obj['column'];

    if ($column !== '') {
      $this->setColumn($column);
    }

    $index_hint = $obj['indexhint'];

    if ($index_hint !== '') {
      $this->setIndexHintList($index_hint);
    }

    $where =$obj['where'];

    if ($where !== '') {
      $this->setWhere($where);
    }

    $groupBy =$obj['groupBy'];

    if ($groupBy !=='') {
      $this->setGroupBy($groupBy);
    }

    $orderBy =$obj['orderBy'];

    if ($orderBy !== '') {
      $this->setOrderBy($orderBy);
    }

    $passover = (int) $obj['passover'];

    if (!(isset($passover) && $passover)) {
      $passover = 0;
    }

    $limit = (int) $obj['limit'];

    if ($limit > 0) {
      $this->setLimit($passover , $limit);
    }
  }

  function getDBName() {

    return $this->db;
  }

  function setDBName($db) {

    $this->db = $db;
  }
  
  function getTable() {

    return $this->tableId;
  }

  function setTable($id) {

    $this->tableId = $id;
  }

  function getPriority() {

    return $this->priority;
  }

  function setPriority($values) {

    $this->priority = $values;
  }

  function getField() {

    return $this->fields;
  }

  function setField($values) {

    $this->fields = $values;
  }

  function getColumn($type=NULL) {

    switch ($type) {
      case 'key':
        $result = $this->column_keys;
        break;

      case 'value':
        $result = $this->column_values;
        break;   

      default:
        $result = $this->column_list; 
        break;
    }

    return $result; 
  }

  function setColumn($values) {

    $columns = array();
    $columnUpdate = array();    

    foreach ($values as $key => $value) {

      if (preg_match('/^now\(\)$/', trim($value))) {
        $columns[$key] = $value;
        $columnUpdate[] = $key . '=' . $value;
      } else {

        // check update
        if (preg_match('/([+|-|*])+/', $value, $matches)) {
          $columns[$key] = $key . $matches[1] . $value; 
          $columnUpdate[] = $key . '=' . $key . $matches[1] . $value;            
        } else {
          $columns[$key] = $this->addQuotation( $value );
          $columnUpdate[] = $key . '=' . $this->addQuotation( $value );
        }       
      }      
    }

    if (is_array($values)) {
      $this->column_keys = $this->getColumnKeys($columns, ',');
      $this->column_values = $this->getColumnValues($columns, ',');
    }

    $this->column_list = $this->convertToString($columnUpdate, ',');
  }

  function getColumnValues( $values ) {

    $temp_arr = array();

    foreach ($values as $key => $value) {
      $temp_arr[] = $value;
    }

    return $this->convertToString($temp_arr);
  }

  function getColumnKeys( $values ) {

    $temp_arr = array();

    foreach ($values as $key => $value) {

      if (is_string($key)) {
        $temp_arr[] = $key;
      }
    }

    return $this->convertToString($temp_arr);
  }

  function getColumnBindValue() {

    return $this->columnBindValues;
  }

  function setColumnBindValue( $key, $value) {

    $this->columnBindValues[$key] = $value;
  }

  function getWhere() {

    return $this->where;
  }

  function setWhere( $values, $cond="=", $glue='and') {
    
    $tempArr = null;
    $glue = ' ' . trim($glue) . ' ';

    if (is_a($values, 'QueryWhere')) {
      $this->whereBindValues = $values->getBindValue();
      $this->where = $values->get();
    } else {

      if (is_array($values)) {
        $keyId = 0;

        foreach ($values as $key => $value) {
          $bindField = ':' . $key . '_' . $keyId;
          $this->setWhereBindValue($bindField, $value);

          if (preg_match('/like/i', $cond)) {            
            $tempArr[] = $key . ' LIKE \'% ' . $bindField . ' %\'';
          } else {
            $tempArr[] = $key . $cond . $bindField;
          }

          $keyId++;
        }

        $this->where = $this->convertToString($tempArr, $glue);
      } else {

        if (preg_match('/like/i', $values)) {
          $splitItems = preg_split('/\s+like\s+/', $values);
          $this->where = $splitItems[0] . ' LIKE \'% ' . ':' . $splitItems[0] . ' %\'';   
        } else {
           $splitItems = preg_split('/\s+=\s+/', $values);
           $this->where = $splitItems[0] . '=' . ':' . $splitItems[0];
        }

        $this->setWhereBindValue($splitItems[0], $splitItems[1]);         
      }   // end of else if is_array()
    }   // end of if is_a()
  }  

  function getWhereBindValue() {

    return $this->whereBindValues;
  }

  function setWhereBindValue( $key, $value) {

    $this->whereBindValues[$key] = $value;;
  }

  function setIndexHintList($value) {

    $this->index_hint = $this->convertToString($value, ',');
  }

  function getIndexHintList() {

    return $this->index_hint;
  }

  function setGroupBy($values) {

    $this->groupBy = $values;
  }

  function getGroupBy() {

    return $this->groupBy;
  }

  function setOrderBy($values) {

    if (is_array($value)) {
      $this->orderBy = $this->convertToString($value, ',');
    } else {
      $this->orderBy = $values;
    }
  }

  function getOrderBy() {

    return $this->orderBy;
  }

  function getLimit() {

    return $this->limit;
  }

  function setLimit($passover, $limit = 0) {

    $_limit = (int) $limit;

    if ($_limit > 0) {
      $this->limit .= $passover . ', ' . $limit;
    }
  }
  function getSchema() {

    return $this->schema;
  }

  function setSchema($schema) {

    $resultArr = $schema->get();
    $this->schema = implode(',', $resultArr);
  }

  function reset() {

    $this->tableId = '';
    $this->priority;
    $this->fields = '';
    $this->column_list = '';
    $this->column_keys = array();    
    $this->column_values = array();
    $this->columnBindValues = array();    
    $this->where = null;  
    $this->whereBindValues = array();
    $this->bindValues = array();
    $this->index_hint = '';
    $this->groupBy = '';
    $this->orderBy = '';
    $this->limit = '';
    $this->schema = '';
  }

  function resetSchema() {

    $this->schema = '';
  }

  function convertToString( $value, $glue=' , ') {

    if (is_array($value)) {
      return implode($glue, $value);
    }

    return $value;
  }

  function addQuotationToArray( $obj, $cond='=') {

    $temp_arr = array();

    foreach ($obj as $key => $value) {
      $value = mysql_real_escape_string($value);

      if (is_string($key)) {
        $temp_arr[] = $key . $cond . $this->addQuotation($value);
      } else {
        $temp_arr[] = $this->addQuotation($value);
      }     
    }

    return $temp_arr;
  }

  function addQuotation($value) {

    $temp_value = '';

    if (is_string($value) && (preg_match('/\(\)+$/', $value) !== true) &&
        (preg_match('/[+|-|*|%]+/', $value) !== true)) {

      $temp_value = '\'' . $value. '\'';
    } else {    
      $temp_value = $value;
    }

    return $temp_value;
  }
}
?>