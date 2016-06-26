<?

class LoginModel extends BaseModel {

	var $name = 'login_model';
	var $dataList = NULL;
	var $result = NULL;
	var $jsonData = NULL;

	function LoginModel() {

	}

	function select($query) {

		$this->result = parent::select($query);

		return $this->result;
	}

	function getVariables($result=NULL) {

		if (isset($result)) {
			$this->result = $result;
		}
		return parent::getVariables($this->result);
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