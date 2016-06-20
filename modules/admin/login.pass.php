<meta charset="utf-8" />

<?
session_start();

include "../lib.php";

$user_id = $_POST[user_id];
$user_pass = $_POST[user_pass];

$msg = "";

if ($admin_id != $user_id) {
	$msg = "관리자 아이디를 다시 확인하세요.";
} else if ($admin_pwd != $user_pass) {
	$msg = "관리자 비밀번호를 다시 확인하세요.";
} 

if ($msg) {
	echo ("	<script>
				alert('${msg}');
				history.go(-1);
			</script>");
	exit;
}

$admin_ok = md5($admin_id);
$_SESSION[admin_ok] = $admin_ok;
echo ("<meta http-equiv='Refresh' content='0; URL=main.php'>");

mysql_close();
?>
