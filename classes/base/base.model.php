<?

class BaseModel extends Object {

	var $name = 'model';
	var $result = NULL;
	var $rows_data;
	var $hashmap_params = array();

	function __construct() {}

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

	function getRows($result=NULL) {

		if ($result) {
			$this->result = $result;
		}

		$this->rows_data = array();
		while($rows = mysql_fetch_array($this->result)) {

			$fields = array();
			foreach ($rows as $key => $value) {

				if (gettype($key) == 'string' && isset($value) && trim($value) !== '') {
					$fields[$key]=$value;
				}				
			}
			$this->rows_data[]=$fields;
		}
		return $this->rows_data;
	}

	function getJson($result=NULL) {

		if ($result) {
			$this->result = $result;
		}

		$this->rows_data = array();
		while($rows = mysql_fetch_array($this->result)) {

			$fields = array();
			foreach ($rows as $key => $value) {

				if (gettype($key) == 'string') {
					$fields[$key]=$value;
				}				
			}
			$this->rows_data[]=$fields;
		}

		return JsonEncoder::getInstance()->parse($this->rows_data);
	}

	function getCount() {

		return count($this->rows_data);
	}

	function setParam($key, $val) {

		$this->hashmap_params[$key] = $val;
	}

	function getParam($key) {

		return $this->hashmap_params[$key];
	}
}
?>