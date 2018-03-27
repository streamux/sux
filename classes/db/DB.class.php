<?php

class DB extends Object {

  private static $aInstance = NULL;

  var $pdo = null;
  var $db_info = null;
  var $is_connected = FALSE;
  var $master_db = NULL;
  var $statement = NULL;
  var $errno = 0;
  var $errstr = '';
  var $tracer = null;

  function DB() {

    $this->tracer = Tracer::getInstance();

    $context = Context::getInstance();
    $this->db_info = $context->getDBInfo();
  }

  public static function &getInstance() {

    if (empty(self::$aInstance)) {
      self::$aInstance = new DB();
    }

    return self::$aInstance;
  }

  function _getMysqlDNS() {

    return sprintf(
          'mysql:host=%s;port=%s;charset=%s',
          $this->db_info['db_hostname'],
          $this->db_info['db_port'],
          $this->db_info['db_charset']
        );
  }

  function _getDBDNS() {

    return sprintf(
          'mysql:host=%s;dbname=%s;port=%s;charset=%s',
          $this->db_info['db_hostname'],
          $this->db_info['db_database'],
          $this->db_info['db_port'],
          $this->db_info['db_charset']
        );
  }

  function _connect() {

    try {

      $dsn = $this->_getDBDNS();

      $charset = $this->db_info['db_charset'];
      $collate = 'utf8_general_ci';
      $options = array(
        PDO::ATTR_PERSISTENT => false,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset COLLATE $collate"
      );

      $this->pdo = new PDO( $dsn, $this->db_info['db_userid'], $this->db_info['db_password'], $options);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch( PDOException $e ) {
      
      die('Cannot connect to DB : ' . $e->getMessage());
    }

    $this->master_db = 'MYSQL';

    return true;
  }

  function getAttribute( $option ) {

    return $this->pdo->getAttribute($option);
  }

  function getPDO() {

    return $this->pdo;
  }

  function connect() {

    $this->is_connected = $this->_connect();
  }

  function isConnected() {

    return $this->master_db ? TRUE : FALSE;
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
    if ($limit !== '') {
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

  function _createSql($query) {

    $tables = $query->getTable();
    $schema = $query->getSchema();

    return 'CREATE TABLE ' . $tables . '(' . $schema . ')';
  }

  function _dropSql($query) {

    $tables = $query->getTable();

    return 'DROP TABLE ' . $tables;
  }

  function _showTables($query=NULL) {

    $db = $query->getDBName();

    if ($db !== '') {
      $db = ' ' . $db;
    }

    $tableName = $query->getTable();

    if ($tableName != '') {
      $like = ' LIKE ' . '\'' . $tableName . '\'';
    }

    return 'SHOW TABLES FROM ' . $db . $like;
  }

  function _createDatabase($dbname, $charset='utf8' , $collate='utf8_general_ci') {

    if (gettype($dbname) !== 'string' && empty($dbname)) {
      $this->_setLogger('DB->createDatabase : \' dbname is not valid');
      return false;
    }

    return "CREATE DATABASE `$dbname` CHARACTER SET `$charset` COLLATE `$collate`";
  }

  function _dropDatabase($dbname) {

    if (gettype($dbname) !== 'string' && empty($dbname)) {
      $this->_setLogger('DB->dropDatabase : \' dbname is not valid');
      return false;
    }

    return "DROP DATABASE IF EXISTS " . $dbname ;
  }

  function _showDatabases($query=NULL) {

    return 'SHOW DATABASES ';
  }

  function _setColumnBindValue( $values) {

    if (count($values) === 0) {
      return;
    }

    foreach ($values as $key => $value) {

      if ($value !== 'now()') {
        $this->statement->bindValue($key, $value);
      }
    } 

    return $msg;   
  }

  function _setWhereBindValue( $values) {

    if (count($values) === 0) {
      return;
    }

    foreach ($values as $key => $value) { 
      $this->statement->bindValue($key, $value);
    }    
  }

  function _query($sql) {

    $this->statement = $this->pdo->prepare($sql);
  }

  function _executeQuery() {

    $this->statement->execute();

    if (!$this->statement) {
      $errorInfoes = $this->pdo->errorInfo();
      $this->setError($errorInfoes[1], 'DB->select : ' + $errorInfoes[2]);

      return false;
    }

    return true;
  }

  function select($query) {

    $sql = $this->_selectSql($query);
    $bindWhere = $query->getWhereBindValue();

    $this->_setLogger($sql);
    $this->_query($sql);    
    $this->_setWhereBindValue($bindWhere);

    return $this->_executeQuery();
  }

  function insert($query) {

    $sql = $this->_insertSql($query);    

    $this->_setLogger($sql);
    $this->_query($sql);

    return $this->_executeQuery();
  }

  function update($query) {

    $sql = $this->_updateSql($query);

    $bindWhere = $query->getWhereBindValue();


    $this->_setLogger($sql);
    $this->_query($sql);
    $this->_setWhereBindValue($bindWhere);

    return $this->_executeQuery();
  }

  function delete($query) {

    $sql = $this->_deleteSql($query);
    $bindWhere = $query->getWhereBindValue();

    $this->_setLogger($sql);
    $this->_query($sql);
    $this->_setWhereBindValue($bindWhere);    

    return $this->_executeQuery();
  }

  function createDatabase($query) {

    if ($this->searchDatabase($query)) {
      return;
    }

    $dbname = $query->getDBName();
    $sql = $this->_createDatabase($dbname);
    $dsn = $this->_getMysqlDNS();

    try {
      $pdo = new PDO( $dsn, $this->db_info['db_userid'], $this->db_info['db_password']);
      $pdo->exec($sql);
    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }
  }

  function dropDatabase($query) {

    $dbName = $query->getDBName();
    $sql = $this->_dropDatabase($dbName);
    $dsn = $this->_getMysqlDNS();

    try {
      $pdo = new PDO( $dsn, $this->db_info['db_userid'], $this->db_info['db_password']);
      $pdo->exec($sql);
    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }
  }

  function showDatabases($query) {

    if (isset($query) && $query) {
      $dbname = $query->getDBName();
    }

    $dbList = array();    
    $sql = $this->_showDatabases();
    $dsn = $this->_getMysqlDNS();

    try {
      $pdo = new PDO( $dsn, $this->db_info['db_userid'], $this->db_info['db_password']);
      $dbs = $pdo->query($sql);

      while(( $db = $dbs->fetchColumn( 0 )) !== false ) {

        $dbList[] = $db;
      }
    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }

    return $dbList;
  }

  function searchDatabase($query) {

    if (isset($query) && $query) {
      $dbname = $query->getDBName();
    }

    $dbList = array();
    
    $sql = $this->_showDatabases();
    $dsn = $this->_getMysqlDNS();

    try {
      $pdo = new PDO( $dsn, $this->db_info['db_userid'], $this->db_info['db_password']);
      $dbs = $pdo->query($sql) or die(print_r($pdo->errorInfo(), true));

      while(( $db = $dbs->fetchColumn( 0 )) !== false ) {

        if (isset($dbname) && $dbname && $db === $dbname) {
          return true;
        }
      }
    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }

    return false;
  }

  function createTable($query) {

    $sql = $this->_createSql($query);

    $this->_setLogger($sql);
    $this->_query($sql);    

    return $this->_executeQuery();
  }

  function showTables($query) {

    $sql = $this->_showTables($query);

    $this->_setLogger($sql);
    $this->_query($sql);    

    return $this->_executeQuery();
  }

  function dropTable($query) {

    $sql = $this->_dropSql($query);

    $this->_setLogger($sql);
    $this->_query($sql);
    
    return $this->_executeQuery();
  }

  function getLastInsertId() {

    if (!$this->pdo) {
      $errorInfoes = $this->pdo->errorInfo();
      $this->setError($errorInfoes[1], 'DB->getLastInsertId : ' + $errorInfoes[2]);
    }

    return $this->pdo->lastInsertId();
  }

  function getFetchArray() {

    if (!$this->statement) {
      $errorInfoes = $this->pdo->errorInfo();
      $this->setError($errorInfoes[1], 'DB->getFetchArray : ' + $errorInfoes[2]);
    }

    return $this->statement->fetch( PDO::FETCH_ASSOC );
  }

  function getNumRows() {

    if (!$this->statement) {
      $errorInfoes = $this->pdo->errorInfo();
      $this->setError($errorInfoes[1], 'DB->getNumRows : ' + $errorInfoes[2]);
    }

    return $this->statement->rowCount();
  }

  function getError() {

    return array('no'=>$this->errno, 'msg'=>$this->errstr);
  }

  function setError($errno = 0, $errstr = 'success') {

    $this->errno = $errno;
    $this->errstr = $errstr;
  }

  function _setLogger($msg) {

    if (isset($this->tracer) && $this->tracer) {
      $this->tracer->setMessage($msg);
    }
  }
}
?>