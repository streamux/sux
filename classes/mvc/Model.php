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
  
  function select( $table_name, $field = '*', $where = null, $orderby = null,
      $passover = 0, $limit = null) {

    $context = Context::getInstance();
    $tableName = $context->getTable($table_name);

    $query = new Query();
    $query->setTable($tableName);
    $query->setField($field);

    if (isset($where) && $where) {
      $query->setWhere($where);
    }

    if (isset($orderby) && $orderby) {
      $query->setOrderBy($orderby);
    }

    if (isset($limit) && $limit) {
      $query->setLimit($passover, $limit);
    }

   $this->result = $this->db->select($query);
    return $this->result;
  }

  function insert( $table_name, $columns = null) {

    $context = Context::getInstance();
    $context->setCookieVersion();
    $tableName = $context->getTable($table_name);

    $query = new Query();
    $query->setTable($tableName);
    $query->setColumn($columns);

    $this->result = $this->db->insert($query);
    return $this->result;
  }

  function update( $table_name, $columns, $where = null) {

    $context = Context::getInstance();
    $context->setCookieVersion();
    $tableName = $context->getTable($table_name);

    $query = new Query();
    $query->setTable($tableName);
    $query->setColumn($columns);

    if (isset($where) && $where) {
      $query->setWhere($where);
    }

    $this->result = $this->db->update($query);
    return $this->result;
  }

  function delete( $table_name, $where = null) {

    $context = Context::getInstance();
    $context->setCookieVersion();
    $tableName = $context->getTable($table_name);

    $query = new Query();
    $query->setTable($tableName);
    
    if (isset($where) && $where) {
      $query->setWhere($where);
    }

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