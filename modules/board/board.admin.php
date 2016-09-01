<?
include "../../config/config.inc.php";

$context = Context::getInstance();
$context->init();

$action = $context->getRequest('action');

$model = new BoardAdminModel();
$controller = new BoardAdminController($model);
$views = new BoardAdminView($model, $controller);

if (isset($action) && $action) {
	$views->display($action);
} else {
	Error::alertTo('파라미터 값을 확인해주세요.\게시판 메인으로 이동합니다.', 'board.php?board=' . $board . '&action=list');
}
?>