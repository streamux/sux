<?

session_start();
include "../lib.php";

$context = Context::getInstance();
$context->init();

$oDB = DB::getInstance();

$action = $context->getRequest('action');

$login_model = new LoginModel();
$login_controller = new LoginController($login_model);
$login_views = new LoginView($login_model, $login_controller);

if (isset($action) && $action) {

	$context->set('memberGroup', $member_group);
	$context->set('adminName', $admin_name);
	$context->set('adminMail', $admin_email);

	$login_views->display($action);
} else {
	Error::alertTo('파라미터 값을 확인해주세요.\n로그인 메인으로 이동합니다.', 'login.php?action=login');
}

$oDB->close();
?>