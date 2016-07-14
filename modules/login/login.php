<?

session_start();
include "../../config/config.inc.php";


$context = Context::getInstance();
$context->init();

$action = $context->getRequest('action');
$url = $context->getRequest('returnToURL');
/*echo 'returnToURL=' . $url;
echo ("<meta http-equiv='Refresh' content='0; URL=$url'>");
return;*/

$login_model = new LoginModel();
$login_controller = new LoginController($login_model);
$login_views = new LoginView($login_model, $login_controller);

if (isset($action) && $action) {
	$login_views->display($action);
} else {
	Error::alertTo('파라미터 값을 확인해주세요.\n로그인 메인으로 이동합니다.', 'login.php?action=login');
}
?>