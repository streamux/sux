<?
include "../../config/config.inc.php";

$context = Context::getInstance();
$context->init();

$action = $context->getRequest('action');
/*$url = $context->getRequest('returnToURL');
echo 'returnToURL=' . $url;
echo ("<meta http-equiv='Refresh' content='0; URL=$url'>");
return;*/

$model = new LoginModel();
$controller = new LoginController($model);
$views = new LoginView($model, $controller);

if (isset($action) && $action) {
	$views->display($action);
} else {
	Error::alertTo('파라미터 값을 확인해주세요.\n로그인 메인으로 이동합니다.', 'login.php?action=login');
}
?>