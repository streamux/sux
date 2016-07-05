<?php

class DB {

	private static $aInstance = NULL;

	var $name = 'db_class';
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

		$select = $query['select'];
		if ($select != '') {
			$select = 'SELECT ' . $select;
		}

		$from = $query['from'];
		if ($from != '') {
			$from = ' FROM ' . $from;
		}

		$where = $query['where'];
		if ($where != '') {

			$where = $this->getArrayToList($where, ' and ');
			$where = ' WHERE ' . $where;
		}

		$index_hint_list = $query->index_hint_list;

		$groupBy = $query['groupBy'];
		if ($groupBy != '') {
			$groupBy = ' GROUP BY ' . $groupBy;
		}

		$orderBy = $query['orderBy'];
		if ($orderBy != '') {
			$orderBy = ' ORDER BY ' . $orderBy;
		}

		$limit = $query['limit'];
		if ($limit != '') {
			$limit = ' LIMIT ' . $limit;
		}

		return $select . ' ' . $from . ' ' . $where . ' ' . $index_hint_list . ' ' . $groupBy . ' ' . $orderBy . ' ' . $limit;
	}

	function _insertSql($query=NULL) {

		$tables = $query['tables'];
		$priority = $query['priority'];
		$keys = $query['keys'];
		if (isset($keys)) {
			$keys = ' (' . implode(',', $keys) . ')' ;
		}

		$values = $query['values'];
		if (is_array($values)) {
			$values = $this->addQuotation($values);
		}

		return 'INSERT ' . $priority . ' INTO ' . $tables . $keys . ' VALUES (' . implode(',', $values) .')';
	}

	function _updateSql($query=NULL) {

		$priority = $query['priority'];
		$tables = $query['tables'];
		$columnList = $query['columnList'];
		if ($columnList != '') {
			$columnList = $this->getArrayToList($columnList, ',');
		}

		$where = $query['where'];	
		if ($where != '') {
			$where = $this->getArrayToList($where, ' and ');
			$where = ' WHERE ' . $where;
		}

		return 'UPDATE ' . $priority . $tables . ' SET ' . $columnList . $where;
	}

	function _deleteSql($query=NULL) {
		
		$sql = 'DELETE ';
		$sql .= $query['priority'];
		$sql .= ' FROM ' . $query['from'];

		$where = $query['where'];	
		if ($where != '') {
			$where = $this->getArrayToList($where, ' and ');
			$sql .= ' WHERE ' . $where;
		}

		return $sql;
	}

	function addQuotation( $arr ) {

		$tmp_arr = array();
		for ($i=0; $i<count($arr); $i++) {

			if ((is_string($arr[$i]) && strpos($arr[$i], '()') === FALSE) || !isset($arr[$i])) {
				$tmp_arr[] = '\'' . $arr[$i] . '\'';
			} else {
				$tmp_arr[] = $arr[$i];
			}			
		}

		return $tmp_arr;
	}

	function getArrayToList($arr, $glue=',') {

		if (is_array($arr)) {
			$arr = implode($glue, $arr);
		}
		return $arr;
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

		return $this->query_result;
	}

	function insert($query) {

		$sql = $this->_insertSql($query);
		$this->query_result = $this->_query($sql);

		return $this->query_result;
	}

	function update($query) {

		$sql = $this->_updateSql($query);
		$this->query_result = $this->_query($sql);

		return $this->query_result;
	}

	function delete($query) {

		$sql = $this->_deleteSql($query);
		$this->query_result = $this->_query($sql);

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