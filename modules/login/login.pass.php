<?
session_start();

include "../lib.php";

$member = trim($_POST['member']);
$memberid = trim($_POST['memberid']);
$pass = trim($_POST['pass']);

$msg = "";

if (!$memberid) {
	$msg = "아이디를 입력하세요.";
} else if (!$pass) {
	$msg = "비밀번호를 입력하세요.";
} 

if ($msg) {
	echo ("	<script>
				alert('${msg}');
				history.go(-1);
			</script>");
	exit;
}

$pass = substr(md5($pass),0,8);
$queryy = "select * from $member where ljs_memberid='$memberid' and ljs_pass1='$pass' ";
$result = mysql_query($queryy);
$num = mysql_num_rows($result);

if ($num) {
	$row = mysql_fetch_array($result);
	$ljs_memberid = $row['ljs_memberid'];
	$ljs_pass1 = $row['ljs_pass1'];
	$ljs_name = $row['name'];
	$ljs_conpanyname = $row['conpany'];

	if ($ljs_conpanyname) {
		$ljs_name = $ljs_conpanyname;
	}

	$ljs_email = $row['email'];
	$ljs_writer = $row['writer'];
	$ljs_hit = $row['hit'];
	$ljs_point = $row['point'];
	$grade = $row['grade'];
	$automod1 = "yes";
	$chatip = $REMOTE_ADDR;	

	$result = mysql_query("select hit from $member where ljs_memberid='$ljs_memberid' ");
	$row = mysql_fetch_array($result);
	$hit = $row['hit']+1;
	$sql = mysql_query("update $member set hit=$hit where ljs_memberid='$ljs_memberid' ");

	$_SESSION['ljs_member'] = $member;
	$_SESSION['ljs_memberid'] = $ljs_memberid;
	$_SESSION['ljs_pass1'] = $ljs_pass1;
	$_SESSION['ljs_name'] = $ljs_name;
	$_SESSION['ljs_email'] = $ljs_email;
	$_SESSION['ljs_writer'] = $ljs_writer;
	$_SESSION['ljs_hit'] = $hit;
	$_SESSION['ljs_point'] = $ljs_point;
	$_SESSION['grade'] = $grade;
	$_SESSION['automod1'] = $automod1;
	$_SESSION['chatip'] = $chatip;
	
	if ($ljs_mod == "r_mode") {
		echo ("<meta http-equiv='Refresh' content='0; URL=board.read.php?board=$board&board_grg=$board_grg&id=$id&igroup=$igroup&passover=$passover&page=$page&sid=$sid&find=$find&search=$search&s_mod=$s_mod'>");
	} else if ($ljs_mod == "writer"){
		echo ("<meta http-equiv='Refresh' content='0; URL=board.write.php?board=$board&board_grg=$board_grg&id=$id&igroup=$igroup&passover=$passover&page=$page&sid=$sid'>");
	} else {
		echo ("<meta http-equiv='Refresh' content='0; URL=login.php?action=login'>");
	}
} else {
	echo ("<meta http-equiv='Refresh' content='0; URL=login.php?action=fail'>");
}

mysql_close();
?>