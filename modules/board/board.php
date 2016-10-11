<?
include "../../config/config.inc.php";

$context = Context::getInstance();
$context->init();


$board = $context->getRequest('board');
if (!isset($board) || $board == '') {
	UIError::alert('파라미터[ board.php?board= ] 값을 확인해주세요.');
}

$model = new BoardModel();
$controller = new BoardController($model);
$views = new BoardView($model, $controller);

$selfURL = $context->getServer('PHP_SELF');
$action = $context->getRequest('action');
if (isset($action) && $action) {
	$views->display($action);
} else {
	UIError::alertTo('파라미터 값을 확인해주세요.\게시판 메인으로 이동합니다.', $selfURL . '?board=' . $board . '&action=list');
}
?>