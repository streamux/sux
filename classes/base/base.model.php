<?

class BaseModel extends Object {

	var $name = 'model';
	var $query_sql = '';
	var $result = NULL;
	var $rows_data = array();
	var $hashmap_params = array();

	function BaseModel() {}

	function getSelectSql($query=NULL) {

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

	function getInsertSql($query=NULL) {

		$tables = $query['tables'];
		$priority = $query['priority'];
		$keys = $query['keys'];
		$values = $query['values'];

		return 'INSERT ' . $priority . ' INTO ' . $tableName . ' (\'' . implode(',', $keys) . '\') VALUES (\'' . implode(',', $values) .'\')';
	}

	function getUpdateSql($query=NULL) {

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

	function getDeleteSql($query=NULL) {
		
		$sql = 'DELETE ';
		$sql .= $query['priority'];
		$sql .= ' FROM ' . $query['from'];

		$where = $query['where'];	
		if ($where != '') {
			$where = $this->getWhereList($where);
			$sql .= ' WHERE ' . $where;
		}

		return $sql;
	}

	function getArrayToList($arr, $glue=',') {

		if (is_array($arr)) {
			$arr = implode($glue, $arr);
		}

		return $arr;
	}

	function select($query=NULL) {

		$this->query_sql = $this->getSelectSql($query);
		$this->result = $this->getQueryResult();		
	}	

	function insert($query=NULL) {

		$this->query_sql = $this->getInsertSql($query);
		$this->result = $this->getQueryResult();
	}

	function update($query=NULL) {

		$this->query_sql = $this->getUpdateSql($query);
		$this->result = $this->getQueryResult();
	}

	function delete($query=NULL) {

		$this->query_sql = $this->getDeleteSql($query);
		$this->result = $this->getQueryResult();
	}

	function getQueryResult() {

		return mysql_query($this->query_sql);	
	}

	function getFetchArray() {

		return mysql_fetch_array($this->result);
	}

	function getNumRows() {

		return mysql_num_rows($this->result);
	}

	function getRows($ignore=TRUE) {

		$this->rows_data = array();
		$this->result = $this->getQueryResult();

		while($rows = $this->getFetchArray()) {
			$fields = array();
			foreach ($rows as $key => $value) {

				if (($ignore === 'true' || $ignore === TRUE) && gettype($key) == 'string' && isset($value) && $value != '' ) {
					$fields[$key]=$value;
				} else if (($ignore != 'true' || $ignore != TRUE) && gettype($key) == 'string'){
					$fields[$key]=$value;
				}		
			}
			$this->rows_data[]=$fields;
		}

		return count($this->rows_data) > 1 ? $this->rows_data : $this->rows_data[0];
	}

	function getJson($ignore=TRUE) {

		return JsonEncoder::getInstance()->parse($this->getRows($ignore));
	}	

	function getCount($ignore=TRUE) {

		$this->result = $this->getQueryResult();
		return $this->getNumRows();
	}
}
?>