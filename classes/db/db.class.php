<?php

class DB extends Object {

	private static $aInstance = NULL;

	var $class_name = 'db_class';
	var $is_connected = FALSE;
	var $master_db = NULL;
	var $query_result = NULL;

	function DB() {
	
		$context = Context::getInstance();
		$db_info = $context->getDBInfo();
		$db_connect = $this->_connect($db_info);
		$this->_selectDB($db_info, $db_connect);
	}

	public static function &getInstance() {

		if (empty(self::$aInstance)) {
			self::$aInstance = new self;
		}
		return self::$aInstance;
	}

	function _connect($db_info) {

		$db_connect = @mysql_connect($db_info['db_hostname'], $db_info['db_userid'], $db_info['db_password']);
		if (!$db_connect) {
			 die('서버 연결에 실패 했습니다. 계정 또는 패스워드를 확인하세요.');
		}		
		$master_db = 'MYSQL';		

		return $db_connect;
	}

	function _selectDB($db_info, $db_connect) {

		$select = @mysql_select_db($db_info['db_database'], $db_connect);
		if (!$select) {
			die('데이터베이스 연결에 실패 했습니다. 데이터베이스명을 확인하세요.');
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

	function _insertSql($query=NULL) {

		$tables = $query->getTable();
		$priority = $query->getPriority();
		$keys = $query->getColumn('key');
		if ($keys != '') {
			$keys = ' (' . $keys . ')' ;
		}
		$values = $query->getColumn('value');

		return 'INSERT ' . $priority . ' INTO ' . $tables . $keys . ' VALUES (' . $values .')';
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
		$this->query_result = $this->_query($sql);
		parent::output($sql);

		return $this->query_result;
	}

	function insert($query) {

		$sql = $this->_insertSql($query);		
		$this->query_result = $this->_query($sql);
		parent::output($sql);

		return $this->query_result;
	}

	function update($query) {

		$sql = $this->_updateSql($query);		
		$this->query_result = $this->_query($sql);
		parent::output($sql);

		return $this->query_result;
	}

	function delete($query) {

		$sql = $this->_deleteSql($query);		
		$this->query_result = $this->_query($sql);
		parent::output($sql);	

		return $this->query_result;
	}

	function getFetchArray() {

		return $this->_fetchArray($this->query_result);
	}

	function getNumRows() {

		return$this->_numRows($this->query_result);
	}
}
?>