<?
session_start();
include "../lib.php";

$action = trim($_REQUEST['action']);

$login_model = new LoginModel();
$login_view = new LoginView($login_model);

$query = array();
$query['select'] = 'name';
$query['from'] = $member_group;
$query['orderBy'] = 'id asc';

$login_model->select($query);

if (isset($action) && $action) {

	$params_type = array();
	$params_type['request'] = $_REQUEST;
	$params_type['post'] = $_POST;
	$params_type['get'] = $_GET;

	$login_view->display($action, $params_type);
} else {
	Error::alertTo('파라미터 값을 확인해주세요.\n로그인 메인으로 이동합니다.', 'login.php?action=login');
}
?>