<?

session_start();
include "../lib.php";

$context = Context::getInstance();
$context->init();

$action = $context->getRequest('action');
if (!isset($action)) {
	$action = 'list';
}

$board = $context->getRequest('board');
if (!isset($board)) {
	Error::alert('파라미터[ board.php?board= ] 값을 확인해주세요.');
}

$board_model = new BoardModel();
$board_controller = new BoardController($board_model);
$board_views = new BoardView($board_model, $board_controller);

if (isset($action) && $action) {
	$board_views->display($action);
} else {
	Error::alertTo('파라미터 값을 확인해주세요.\게시판 메인으로 이동합니다.', 'board.php?board=' . $board . '&action=list');
}
?>