<?
include "../../config/config.inc.php";

$context = Context::getInstance();
$context->init();

$action = $context->getRequest('action');
$board = $context->getRequest('board');
if (!isset($board)) {
	Error::alert('파라미터[ board.php?board= ] 값을 확인해주세요.');
}

$model = new BoardModel();
$controller = new BoardController($model);
$views = new BoardView($model, $controller);

if (isset($action) && $action != '') {
	$views->display($action);
} else {
	Error::alertTo('파라미터 값을 확인해주세요.\게시판 메인으로 이동합니다.', 'board.php?board=' . $board . '&action=list');
}
?>