<meta charset="utf-8" />

<?
session_start();

include "../lib.php";

$admin_pass = $_POST['admin_pass'];

if ($admin_pass == $admin_pwd) {

	$admin_ok=md5("$admin_name");
	$_SESSION['admin_ok'] = $admin_ok;
	echo ("<meta http-equiv='Refresh' content='0; URL=main.php'>");
}else{
	echo ("	<script>
				alert('관리자 비밀번호를 입력해주세요!')
				history.go(-1)
			</script>");
	exit;
}
?>
