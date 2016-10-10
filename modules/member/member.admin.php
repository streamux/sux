<?php
include "../../config/config.inc.php";

$context = Context::getInstance();
$context->init();

$action = $context->getRequest('action');
if (!isset($action)) {
	$action = $context->getPost('action');
}

$model = new MemberAdminModel();
$controller = new MemberAdminController($model);
$views = new MemberAdminView($model, $controller);

if (isset($action) && $action) {
	$views->display($action);
} else {
	UIError::alertTo('파라미터 값을 확인해주세요.\회원가입 페이지로 이동합니다.', 'member.admin.php?action=grouplist');
}
?>