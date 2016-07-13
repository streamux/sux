<?

class BaseModel extends Object {

	var $class_name = 'model';
	var $query_sql = '';
	var $result = NULL;
	var $hashmap_params = array();
	var $db = NUll;
	var $fetchArrayList = NULL;
	var $rownum = 0;

	function __construct() {

		$this->db = DB::getInstance();
	}	

	function select($query=NULL) {

		$result = $this->db->select($query);
		$this->setFetchArray();
		$this->setNumRows();
		return $result;
	}

	function insert($query=NULL) {

		$result = $this->db->insert($query);
		return $result;
	}

	function update($query=NULL) {

		$result = $this->db->update($query);
		return $result;
	}

	function delete($query=NULL) {

		$result = $this->db->delete($query);
		return $result;
	}

	function setFetchArray() {

		$this->fetchArrayList = array();
		while($rows = $this->db->getFetchArray()) {

			$fields = array();
			foreach ($rows as $key => $value) {

				if (gettype($key) == 'string' && isset($value) && $value != '' ) {
					$fields[$key]=$value;
				} else if (gettype($key) == 'string'){
					$fields[$key]=$value;
				}
				$fields[$key]=$value;	
			}
			$this->fetchArrayList[]=$fields;
		}	
	}

	function getFetchArray($ignore=NULL) {

		$rows_data = array();		
		$i=0;

		while ($i < count($this->fetchArrayList)) {

			$fields = array();
			$rows = $this->fetchArrayList[$i];

			foreach ($rows as $key => $value) {
				if (($ignore === 'true' || $ignore === TRUE) && gettype($key) == 'string' && isset($value) && $value != '' ) {
					$fields[$key]=$value;
				} else if (($ignore != 'true' || $ignore != TRUE) && gettype($key) == 'string'){
					$fields[$key]=$value;
				}
			}
			$rows_data[]=$fields;
			$i++;
		}

		return $rows_data;
	}

	function setNumRows() {

		$this->rownum = $this->db->getNumRows();
	}

	function getNumRows() {

		return $this->rownum;
	}

	function getRows($ignore=TRUE) {

		$rows = $this->getFetchArray($ignore);
		return count($rows) > 1 ? $rows : $rows[0];
	}

	function getJson($ignore=TRUE) {

		return JsonEncoder::getInstance()->parse($this->getRows($ignore));
	}
}
?>