<?
include "../../config/config.inc.php";

$context = Context::getInstance();
$action = $context->getRequest('action');

$view = new InstallView();

if (isset($action) && $action != '') {
	$view->display($action);
} else {
	Error::alertTo('파라미터 값을 확인해주세요.\n로그인 메인으로 이동합니다.', 'install.php?action=terms');
}
?>