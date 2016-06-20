<?
include "../lib.php";

$grgid = $_REQUEST[grgid];
$board_grg = $_REQUEST[board_grg];
$pass = $_REQUEST[pass];

$result=mysql_query("select pass from $board_grg where id=$grgid");
$row=mysql_fetch_array($result);

if ($pass == $row[pass] || $pass=="$admin_pwd") {
	$queryy="delete from $board_grg where id='$grgid'";
	$result=mysql_query($queryy);
	echo "삭제되었습니다!";
	echo ("<meta http-equiv='Refresh' content='0; URL=board.read.php?id=$id&sid=$id&board=$board&board_grg=$board_grg&igroup=$igroup&passover=$passover'>");
} else  {
	echo (" <script>
				alert('비밀번호가 틀립니다!')
				history.go(-1)
			</script>");
	exit;
}
?>