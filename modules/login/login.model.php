<?PHP

class LoginModel extends BaseModel {

	var $class_name = 'login_model';

	function __construct() {

		 parent::__construct();
	}

	function init() {}

	function getMemberGroup() {

		$context = Context::getInstance();
		$query = new Query();
		$query->setField('name');
		$query->setTable($context->get('db_member_group'));
		$query->setOrderBy('id asc');	
		parent::select($query);		
	}

	function getLogpass($params=NULL, $type=NULL) {

		$context = Context::getInstance();
		$member = $context->getSession('ljs_member');
		if (!isset($member) || $member == '') {
			$member = $context->getPost('member');
		}

		$memberid = $context->getSession('ljs_memberid');
		if (!isset($memberid) || $memberid == '') {
			$memberid = $context->getPost('memberid');
		}

		if ($type === 'select') {
			$query = new Query();
			$query->setField('*');
			$query->setTable($member);
			$query->setWhere(array(
				'ljs_memberid'=>$memberid
			));
			parent::select($query);
			
		} else if ($type === 'update') {
			$query = new Query();
			$query->setTable($member);
			$query->setColumn(array('hit'=>$params['hit']));
			$query->setWhere(array(
				'ljs_memberid'=>$memberid
			));
			parent::update($query);
		}
	}

	function getLogout() {}

	function getSearchid() {

		$context = Context::getInstance();
		$member = $context->getPost('member');
		$check_name = $context->getPost('check_name');

		$query = new Query();
		$query->setField('ljs_memberid, email');
		$query->setTable($member);
		$query->setWhere(array(
			'name'=>$check_name
		));
		parent::select($query);
	}

	function getSearchpwd() {

		$context = Context::getInstance();
		$member = $context->getPost('member');
		$check_name = $context->getPost('check_name');
		$check_email = $context->getPost('check_email');

		$query = new Query();
		$query->setField('ljs_memberid, email, ljs_pass1');
		$query->setTable($member);
		$query->setWhere(array(
			'name'=>$check_name
		));
		parent::select($query);
	}
}
?>