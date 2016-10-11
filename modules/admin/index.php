<?
include "../../config/config.inc.php";

$context = Context::getInstance();
$context->init();

if (!$context->checkAdminPass()) {
	Utils::goURL('../login/login.admin.php?action=login');
}

$model = new AdminAdminModel();
$controller = new AdminAdminController($model);
$view = new AdminAdminView($model, $controller);

$selfURL = $context->getServer('PHP_SELF');
$action = $context->getRequest('action');
if (isset($action) && $action) {
	$view->display($action);
} else {
	UIError::alertTo('파라미터 값을 확인해주세요.', $selfURL . '?action=main');
}
?>