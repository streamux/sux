<?PHP

class LoginModel extends BaseModel {

	var $name = 'login_model';

	function LoginModel() {}

	function memberGroup() {

		$context = Context::getInstance();
		$query = array();
		$query['select'] = 'name';
		$query['from'] = $context->getParam('memberGroup');
		$query['orderBy'] = 'id asc';
		parent::select($query);
	}

	function logpass($type=NULL,$params=NULL) {

		$context = Context::getInstance();

		if ($type === 'select') {
			$query = array();
			$query['select'] = '*';
			$query['from'] = $context->getParam('post')['member'];
			$query['where'] = 'ljs_memberid=\'' . $context->getParam('post')['memberid'] . '\'';
			parent::select($query);

		} else if ($type === 'update') {
			$query = array();
			$query['tables'] = $context->getParam('post')['member'];
			$query['columnList'] = array();
			$query['columnList'][] = 'hit='.$params['hit'];
			$query['where'] = 'ljs_memberid=\'' . $context->getParam('post')['memberid'] . '\'';
			parent::update($query);
		}
	}

	function logout($type=NULL) {}

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