<?PHP

class LoginModel extends BaseModel {

	var $name = 'login_model';

	function _construct() {}

	function memberGroup() {

		$context = Context::getInstance();
		$query = array();
		$query['select'] = 'name';
		$query['from'] = $context->getParam('memberGroup');
		$query['orderBy'] = 'id asc';
		parent::select($query);
	}

	function logout($queryKey=NULL) {

		$context = Context::getInstance();

		if ($queryKey === 'select') {

			$query = array();
			$query['select'] = 'name';
			$query['from'] = $context->getParam('memberGroup');
			$query['orderBy'] = 'id asc';
			parent::select($query);

		} else if ($queryKey === 'update') {

			$query = array();
			$query['update'] = 'name';
			$query['from'] = $context->getParam('memberGroup');
			$query['orderBy'] = 'id asc';
			parent::update($query);
		}		
	}

	function searchid() {

		$context = Context::getInstance();
		$member = $context->getParam('post')['member'];
		$check_name = $context->getParam('post')['check_name'];

		$query = array();
		$query['select'] = 'ljs_memberid, email';
		$query['from'] = $member;
		$query['where'] = 'name=\''.$check_name.'\'';
		parent::select($query);
	}

	function searchpwd() {

		$context = Context::getInstance();
		$member = $context->getParam('post')['member'];
		$check_name = $context->getParam('post')['check_name'];
		$check_email = $context->getParam('post')['check_email'];

		$query = array();
		$query['select'] = 'ljs_memberid, email, ljs_pass1';
		$query['from'] = $member;
		$query['where'] = 'name=\''.$check_name.'\'';
		parent::select($query);
	}
}
?>