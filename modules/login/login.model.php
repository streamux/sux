<?PHP

class LoginModel extends BaseModel {

	var $name = 'login_model';

	function _construct() {}

	function memberGroup() {

		$query = array();
		$query['select'] = 'name';
		$query['from'] = parent::getParam('memberGroup');
		$query['orderBy'] = 'id asc';
		parent::select($query);
	}

	function logout($queryKey=NULL) {

		if ($queryKey === 'select') {

			$query = array();
			$query['select'] = 'name';
			$query['from'] = parent::getParam('memberGroup');
			$query['orderBy'] = 'id asc';
			parent::select($query);

		} else if ($queryKey === 'update') {

			$query = array();
			$query['update'] = 'name';
			$query['from'] = parent::getParam('memberGroup');
			$query['orderBy'] = 'id asc';
			parent::update($query);
		}
		
	}

	function searchid() {

		$member = parent::getParam('post')['member'];
		$check_name = parent::getParam('post')['check_name'];

		$query = array();
		$query['select'] = 'ljs_memberid, email';
		$query['from'] = $member;
		$query['where'] = 'name=\''.$check_name.'\'';
		parent::select($query);
	}

	function searchpwd() {

		$member = parent::getParam('post')['member'];
		$check_name = parent::getParam('post')['check_name'];
		$check_email = parent::getParam('post')['check_email'];

		$query = array();
		$query['select'] = 'ljs_memberid, email, ljs_pass1';
		$query['from'] = $member;
		$query['where'] = 'name=\''.$check_name.'\'';
		parent::select($query);
	}
}
?>