<?
include "../../config/config.inc.php";

$context = Context::getInstance();
$context->init();

if (!$context->checkAdminPass()) {
	Utils::goURL('../login/login.admin.php?action=login');
}

$action = $context->getRequest('action');

$model = new AdminAdminModel();
$controller = new AdminAdminController($model);
$view = new AdminAdminView($model, $controller);

if (isset($action) && $action != '') {
	$view->display($action);
} else {
	Error::alert('파라미터 값을 확인해주세요.');
}
?>