<?PHP

class LoginModel extends Model {

	var $class_name = 'login_model';

	function __construct() {

		 parent::__construct();
	}

	function init() {}

	function selectMemberGroup() {

		$context = Context::getInstance();
		$tableName = $context->getTable('member_group');

		$query = new Query();
		$query->setField('*');
		$query->setTable($tableName);
		$query->setOrderBy('id asc');
		parent::select($query);
	}

	function selectLogpass($params=NUL) {		

		$context = Context::getInstance();
		$tableName = $context->getTable('member');
		$category = $context->getParameter('category');
		$userId = $context->getParameter('user_id');

		$where = new QueryWhere();
		$where->set('category',$category,'=');
		$where->set('user_id',$userId,'=','and');

		$query = new Query();
		$query->setField('*');
		$query->setTable($tableName);
		$query->setWhere($where);
		parent::select($query);
	}

	function updateField($params=NULL) {

		$context = Context::getInstance();
		$tableName = $context->getTable('member');
		$category = $context->getParameter('category');
		$userId = $context->getParameter('user_id');

		$where = new QueryWhere();
		$where->set('category',$category,'=');
		$where->set('user_id',$userId,'=','and');

		$query = new Query();
		$query->setTable($tableName);
		$query->setColumn(array('hit'=>$params['hit']));
		$query->setWhere($where);
		parent::update($query);
	}

	function selectSearchid() {

		$context = Context::getInstance();
		$tableName = $context->getTable('member');
		$category = $context->getParameter('category');
		$userName = $context->getParameter('user_name');

		$where = new QueryWhere();
		$where->set('category',$category,'=');
		$where->set('user_name',$userName,'=','and');

		$query = new Query();
		$query->setField('user_id, email_address');
		$query->setTable($tableName);
		$query->setWhere($where);
		parent::select($query);
	}

	function selectSearchpwd() {

		$context = Context::getInstance();
		$tableName = $context->getTable('member');
		$category = $context->getParameter('category');
		$userId = $context->getParameter('user_id');

		$where = new QueryWhere();
		$where->set('category',$category,'=');
		$where->set('user_id',$userId,'=','and');

		$query = new Query();
		$query->setField('user_name, email_address, password');
		$query->setTable($tableName);
		$query->setWhere($where);
		parent::select($query);
	}
}
?>