<?
include "../lib.php";

$id = $_REQUEST[id];
$board = $_REQUEST[board];
$pass = trim($_POST[pass]);

$result=mysql_query("select pass,filename from $board where id=$id");
$row=mysql_fetch_array($result);
$rowpass = trim($row[pass]);
$deljfilename = $row[filename];

if ($pass == $rowpass || $pass== $admin_pwd) {

	if($deljfilename) {
		$delfilename="../$board/$row[filename]";

		if(!@unlink($delfilename)) {
			echo "파일삭제를 실패하였습니다.";
		} else {
			echo "파일삭제를 성공하였습니다.";
		}
	}

	$dbdel = "delete from $board where id=$id ";
	$result=mysql_query($dbdel);
} else  {
	echo ("	<script>
				alert('비밀번호가 틀립니다!')
				history.go(-1)
			</script>");
	exit;
}
echo ("<meta http-equiv='Refresh' content='0; URL=board.list.php?board=$board&board_grg=$board_grg'>");
mysql_close();
?>