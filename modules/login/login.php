<?

session_start();
include "../lib.php";

$action = trim($_REQUEST['action']);

$login_model = new LoginModel();
$login_controller = new LoginController($login_model);
$login_views = new LoginView($login_model, $login_controller);

if (isset($action) && $action) {

	$login_model->setParam('repuest', $_REQUEST);
	$login_model->setParam('post', $_POST);
	$login_model->setParam('memberGroup', $member_group);
	$login_model->setParam('adminName', $admin_name);
	$login_model->setParam('adminMail', $admin_email);

	$login_views->display($action);
} else {
	Error::alertTo('파라미터 값을 확인해주세요.\n로그인 메인으로 이동합니다.', 'login.php?action=login');
}
?>