<?

class BaseModel extends Object {

	var $name = 'model';
	var $result = NULL;
	var $rows_data;
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
		$values = $query['values'];

		return 'INSERT $priority INTO $tableName (' . $values . ')';
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
			$sql .= ' WHERE ' . $where;
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

		$this->result = mysql_query($this->getSelectSql($query));
		return $this->result;
	}

	function insert($query=NULL) {

		$this->result = mysql_query($this->getInsertSql($query));
		return $this->result;
	}

	function update($query=NULL) {

		$this->result = mysql_query($this->getUpdateSql($query));
		return $this->result ;
	}

	function delete($query=NULL) {

		$this->result = mysql_query($this->getDeleteSql($query));
		return $this->result;
	}

	function getRows($result=NULL, $ignore=NULL) {

		if ($result) {
			$this->result = $result;
		}

		$this->rows_data = array();
		while($rows = mysql_fetch_array($this->result)) {

			$fields = array();
			foreach ($rows as $key => $value) {

				if (isset($ignore) && ($ignore === TRUE ||  $ignore === 'true')) {
					$flag = gettype($key) === 'string' && isset($value) && $value !== '';
				} else {
					$flag = gettype($key) === 'string';
				}

				if ($flag) {
					$fields[$key]=$value;
				}				
			}
			$this->rows_data[]=$fields;
		}
		return count($this->rows_data) > 0 ? $this->rows_data : $fields;
	}

	function getJson($result=NULL, $ignore=NULL) {

		return JsonEncoder::getInstance()->parse($this->getRows($result, $ignore));
	}	

	function getCount() {

		return count($this->rows_data);
	}
}
?>