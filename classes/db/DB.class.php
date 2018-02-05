<?php

class DB extends Object {

  private static $aInstance = NULL;

  var $class_name = 'db_class';
  var $is_connected = FALSE;
  var $master_db = NULL;
  var $query_result = NULL;
  var $errno = 0;
  var $errstr = '';
  var $tracer = null;

  function DB() {

    $this->tracer = Tracer::getInstance();

    $context = Context::getInstance();
    $db_info = $context->getDBInfo();
    $db_connect = $this->_connect($db_info);
    $this->_selectDB($db_info, $db_connect);
  }

  public static function &getInstance() {

    if (empty(self::$aInstance)) {
      self::$aInstance = new DB();
    }

    return self::$aInstance;
  }

  function _connect($db_info) {

    $db_connect = @mysql_connect( $db_info['db_hostname'], $db_info['db_userid'], $db_info['db_password']);

    if (!$db_connect) {
      die('Cannot connect to DB');
    }

    if(mysql_error()) {
      $this->setError( mysql_errno(), mysql_error());
      return false;
    }
    $this->master_db = 'MYSQL';

    return $db_connect;
  }

  function _selectDB($db_info, $db_connect) {

    $select = @mysql_select_db($db_info['db_database'], $db_connect);
    if (!$select) {
      die('SUX cannot select DB');
    }
    mysql_set_charset("utf8");

    return $select;
  }

  function isConnected() {

    return $this->master_db ? TRUE : FALSE;
  }

  function close($connection) {

    @mysql_close();
  }

  function _selectSql($query=NULL) {

    $select = $query->getField();
    if ($select != '') {
      $select = 'SELECT ' . $select;
    }

    $from = $query->getTable();
    if ($from != '') {
      $from = ' FROM ' . $from;
    }

    $index_hint_list = $query->getIndexHintList();
    if ($index_hint_list != '') {
      $index_hint_list = ' USE INDEX (' . $index_hint_list . ')';
    }

    $where = $query->getWhere();
    if ($where != '') {
      $where = ' WHERE ' . $where;
    }

    $groupBy = $query->getGroupBy();
    if ($groupBy != '') {
      $groupBy = ' GROUP BY ' . $groupBy;
    }

    $orderBy = $query->getOrderBy();
    if ($orderBy != '') {
      $orderBy = ' ORDER BY ' . $orderBy;
    }

    $limit = $query->getLimit();
    if ($limit != '') {
      $limit = ' LIMIT ' . $limit;
    }

    return $select . ' ' . $from . ' ' . $index_hint_list . ' ' . $where . ' ' . $groupBy . ' ' . $orderBy . ' ' . $limit;
  }

  /**
   * @method _insertSql
   * @notice
   * 입력 실패 시 필드값에 사칙 연산자( +,-,*,/)가 포함되어 있는지 확인한다.
   * Query class 내의 addQuotation 메서드 확인
   * Query Class Path : modules/classes/db/query.class.php
   */
  function _insertSql($query=NULL) {

    $tables = $query->getTable();
    $priority = $query->getPriority();
    if ($priority != '') {
      $priority .= ' ';
    }

    $keys = $query->getColumn('key');
    if ($keys != '') {
      $keys = ' (' . $keys . ')' ;
    }
    $values = $query->getColumn('value');

    return 'INSERT ' . $priority . 'INTO ' . $tables . $keys . ' VALUES (' . $values .')';
  }

  function _updateSql($query=NULL) {

    $priority = $query->getPriority();
    $tables = $query->getTable();
    $columnList = $query->getColumn();
    $where = $query->getWhere();

    if ($where != '') {
      $where = ' WHERE ' . $where;
    }

    return 'UPDATE ' . $priority . $tables . ' SET ' . $columnList . $where;
  }

  function _deleteSql($query=NULL) {
    
    $priority = $query->getPriority();
    $tables = $query->getTable();
    $where = $query->getWhere();

    return  'DELETE ' . $priority . ' FROM ' . $tables . ' WHERE ' . $where;
  }

  function _showSql($query) {

    $db = $query->getDB();

    return 'SHOW TABLES FROM ' . $db;
  }

  function _createSql($query) {

    $tables = $query->getTable();
    $schema = $query->getSchema();

    return 'CREATE TABLE ' . $tables . '(' . $schema . ')';
  }

  function _dropSql($query) {

    $tables = $query->getTable();

    return 'DROP TABLE ' . $tables;
  }

  function _query($sql) {

    return mysql_query($sql);
  }

  function _fetchArray($result) {

    return mysql_fetch_array($result);
  }

  function _numRows($result) {

    return mysql_num_rows($result);
  }

  function select($query) {

    $sql = $this->_selectSql($query);
    $this->setLogger($sql);
    $this->query_result = $this->_query($sql);

    return $this->query_result;
  }

  function insert($query) {

    $sql = $this->_insertSql($query);
    $this->setLogger($sql);
    $this->query_result = $this->_query($sql);

    return $this->query_result;
  }

  function update($query) {

    $sql = $this->_updateSql($query);
    $this->setLogger($sql);
    $this->query_result = $this->_query($sql);

    return $this->query_result;
  }

  function delete($query) {

    $sql = $this->_deleteSql($query);
    $this->setLogger($sql);
    $this->query_result = $this->_query($sql);

    return $this->query_result;
  }

  function getInsertId() {

    return mysql_insert_id();
  }

  function showTables($query) {

    $sql = $this->_showSql($query);
    $this->setLogger($sql);
    $this->query_result = $this->_query($sql);

    return $this->query_result;
  }

  function createTable($query) {

    $sql = $this->_createSql($query);
    $this->setLogger($sql);
    $this->query_result = $this->_query($sql);

    return $this->query_result;
  }

  function dropTable($query) {

    $sql = $this->_dropSql($query);
    mysql_query($sql);

    $this->setLogger($sql);
    $this->query_result = $this->_query($sql);

    return $this->query_result;
  }

  function getFetchArray($result) {

    if (isset($result) && $result) {
      $this->query_result = $result;
    }

    return $this->_fetchArray($this->query_result);
  }

  function getNumRows($result) {

    if (isset($result) && $result) {
      $this->query_result = $result;
    }

    return $this->_numRows($this->query_result);
  }

  function setError($errno = 0, $errstr = 'success') {

    $this->errno = $errno;
    $this->errstr = $errstr;
  }

  function getError() {

    return array('no'=>$this->errno, 'msg'=>$this->errstr);
  }

  function setLogger($msg) {

    if (isset($this->tracer) && $this->tracer) {
      $this->tracer->setMessage($msg);
    }
  }
}
?>