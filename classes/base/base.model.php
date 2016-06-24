<?

class BaseModel {

	var $className = "model";

	function Model() {}

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

	}

	function getUpdateSql($query=NULL) {

	}

	function getDeleteSql($query=NULL) {
		
	}

	function select($query=NULL) {

		return mysql_query($this->getSelectSql($query));
	}

	function insert($query=NULL) {

		return mysql_query($this->getInsertSql($query));
	}

	function update($query=NULL) {

		return mysql_query($this->getUpdateSql($query));
	}

	function delete($query=NULL) {

		return mysql_query($this->getDeleteSql($query));
	}

	function getVariable($result=NULL) {

		$rows_data = array();
		while($rows = mysql_fetch_array($result)) {

			$fields = array();
			foreach ($rows as $key => $value) {

				if (gettype($key) == 'string' && isset($value) && trim($value) !== '') {
					$fields[$key]=$value;
				}				
			}
			$rows_data[]=$fields;
		}
		return $rows_data;
	}

	function getJson($result=NULL) {

		$rows_data = array();
		$rows = NULL;

		while($rows = mysql_fetch_array($result)) {

			$fields = array();
			foreach ($rows as $key => $value) {

				if (gettype($key) == 'string') {
					$fields[$key]=$value;
				}				
			}
			$rows_data[]=$fields;
		}

		return JsonEncoder::getInstance()->parse($rows_data);
	}

	function getRows() {

		


	}

	function toString() {

		return $this->className;
	}
}
?>