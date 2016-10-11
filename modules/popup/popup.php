<?
include "../../config/config.inc.php";

$context = Context::getInstance();
$context->init();

/*$url = $context->getRequest('returnToURL');
echo 'returnToURL=' . $url;
echo ("<meta http-equiv='Refresh' content='0; URL=$url'>");
return;*/

$model = new PopupModel();
$controller = new PopupController($model);
$views = new PopupView($model, $controller);

$selfURL = $context->getServer('PHP_SELF');
$action = $context->getRequest('action');
if (isset($action) && $action) {
	$views->display($action);
} else {
	UIError::alertTo('파라미터 값을 확인해주세요.\n현재 페이지 메인으로 이동합니다.', $selfURL . '?action=open');
}
?>