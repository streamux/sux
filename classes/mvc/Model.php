<?

class Model extends Object {

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

    $this->result = $this->db->select($query);
    return $this->result;
  }

  function insert($query=NULL) {

    $this->result = $this->db->insert($query);
    return $this->result;
  }

  function update($query=NULL) {

    $this->result = $this->db->update($query);
    return $this->result;
  }

  function delete($query=NULL) {

    $this->result = $this->db->delete($query);
    return $this->result;
  }

  function showTables($query) {

    $this->result = $this->db->showTables($query);
    return $this->result;
  }

  function getInsertId() {

    return $this->db->getInsertId();
  }

  function createTable($query) {

    $this->result = $this->db->createTable($query);
    return $this->result;
  }

  function dropTable($query) {

    $this->result = $this->db->dropTable($query);
    return $this->result;
  }

  function getMysqlFetchArray($result) {

    return $this->db->getFetchArray($result);
  }

  function getMysqlNumrows($result) {

    return $this->db->getNumRows($result);
  }

  function getNumRows() {

    return $this->db->getNumRows($this->result);
  }

  function getRows() {

    $datas = array();
    while($row = $this->db->getFetchArray($this->result)) {
      $fields = array();

      foreach ($row as $key => $value) {
        if (is_string($key) !== false) {
          $fields[$key] = $value;
        }       
      }
      $datas[] = $fields;
    }
    
    return $datas;
  }

  function getRow() {

    $rows = $this->getRows();
    return $rows[0];
  }

  function getJson($ignore=TRUE) {

    $numrow = $this->getNumRows();
    if ($numrow > 1) {
      $str_data = $this->getRows();
    } else {
      $str_data = $this->getRow();
    }

    return JsonEncoder::getInstance()->parse($str_data);
  }

  function parseToJson($rows) {

    return JsonEncoder::getInstance()->parse($rows);
  }
}
?>