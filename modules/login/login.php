<?
session_start();
include "../lib.php";

$action = trim($_REQUEST['action']);

$loginModel = new LoginModel();
$loginView = new LoginView($loginModel);

$query = array();
$query['select'] = 'name';
$query['from'] = $member_group;
$query['orderBy'] = 'id asc';

$loginModel->select($query);

if (isset($action) && $action) {

	$loginView->{$action}();
} else {
	echo ("	<script>
				alert('login.php?action= 파라미터 값을 확인해주세요.\\n로그인 메인으로 이동합니다.');
				location.href='login.php?action=login';
			</script>");
}
?>