<?
include "../lib.php";

$member = $_POST['member'];
$memberid = trim($_POST['memberid']);
$pass = substr(md5(trim($_POST['pass'])),0,8);

$result = mysql_query("select * from $member where ljs_memberid='$memberid'");
$numrows = mysql_num_rows($result);

if ($numrows > 0) {
	$rows = mysql_fetch_array($result);

	if ($rows[ljs_pass1] == $pass) {

		$result = mysql_query("delete from $member where ljs_memberid='$memberid'");

		if ($result) {
			$msg = "탈퇴처리 되었습니다.";
		}
	} else {
		$msg = "비밀번호가 잘못되었습니다.";
	}
} else {
	$msg = "아이디가 존재하지 않습니다.";
}

echo 	"<script>
			alert('$msg');
			location.href='../login/login.php?action=logout';
		</script>";
		
mysql_close();
?>
