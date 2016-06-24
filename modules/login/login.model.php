<?

class LoginModel extends BaseModel {

	var $className = "login_model";
	var $dataList = NULL;
	var $result = NULL;
	var $jsonData = NULL;

	function LoginModel() {

	}

	function select($query) {

		$this->result = parent::select($query);

		return $this->result;
	}

	function getVariable($result=NULL) {

		if (isset($result)) {
			$this->result = $result;
		}
		return parent::getVariable($this->result);
	}

	function getJson($result=NULL) {

		if (isset($result)) {
			$this->result = $result;
		}
		$this->jsonData = parent::getJson($this->result);
		return $this->jsonData;
	}
}
?>