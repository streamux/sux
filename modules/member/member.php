<?php
include "../../config/config.inc.php";

$context = Context::getInstance();
$context->init();

$action = $context->getRequest('action');
if (!isset($action)) {
	$action = $context->getPost('action');
}

$model = new MemberModel();
$controller = new MemberController($model);
$views = new MemberView($model, $controller);

if (isset($action) && $action) {
	$views->display($action);
} else {
	Error::alertTo('파라미터 값을 확인해주세요.\회원가입 페이지로 이동합니다.', 'member.php?action=add');
}
?>