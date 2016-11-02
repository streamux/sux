<?
include "../../config/config.inc.php";

$context = Context::getInstance();

$view = new InstallView();

$selfURL = $context->getServer('PHP_SELF');
$action = $context->getRequest('action');
if (isset($action) && $action) {
	$view->display($action);
} else {
	UIError::alertTo('파라미터 값을 확인해주세요.\n로그인 메인으로 이동합니다.', $selfURL . '?action=terms');
}
?>