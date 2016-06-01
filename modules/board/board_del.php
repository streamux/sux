<?
include "lib.php";
$result=mysql_query("select pass,filename from $board where id=$id");
$row=mysql_fetch_array($result);
if (($pass==$row[pass]) || ($pass=="$admin_pwd"))
{
$deljfilename=$row[filename];
if($deljfilename) {
$delfilename="../$board/$row[filename]";
if(!@unlink($delfilename)) {
	echo "파일삭제 실패";
} else {
	echo "파일 삭제 성공";
}
}
$dbdel = "delete from $board where id=$id ";
$result=mysql_query($dbdel);
} else  {
echo ("
<script>
alert('비밀번호가 틀립니다!')
history.go(-1)
</script>
");
exit;
}
echo ("<meta http-equiv='Refresh' content='0; URL=board_list.php?board=$board&board_grg=$board_grg&fmenu=$fmenu&fsubmenu=$fsubmenu'>");
?>