<?

session_start();
include "../lib.php";

$action = trim($_REQUEST['action']);

$login_model = new LoginModel();
$login_controller = new LoginController($login_model);
$login_views = new LoginView($login_model, $login_controller);

if (isset($action) && $action) {	

	$context = Context::getInstance();
	$context->setParam('repuest', $_REQUEST);
	$context->setParam('post', $_POST);
	$context->setParam('memberGroup', $member_group);
	$context->setParam('adminName', $admin_name);
	$context->setParam('adminMail', $admin_email);

	$login_views->display($action);
} else {
	Error::alertTo('파라미터 값을 확인해주세요.\n로그인 메인으로 이동합니다.', 'login.php?action=login');
}
?>