<?
include "lib.php";

if (eregi("php|php3|htm|html|js|exe|phtml|inc|jsp|asp|swf",$imgup_name)) {
echo ("
<script>
alert('실행파일(php,php3,htm,html,js,exe,phtml,inc,jsp,asp,swf...)은 등록 할 수 없습니다.')
history.go(-1)
</script>
");
exit;
}
if(ereg('@',$email)) {
	echo "";
} else {
 echo ("
	<script>
	alert('잘못된 E-mail 주소입니다.')
	history.go(-1)
	</script>
	");
	exit;
}
if ($ljs_mod=="writer" && $wall){
if($wall == $wallok) { 
$save_dir = "../$board";
if(is_uploaded_file($_FILES["imgup"]["tmp_name"])) {
$mktime=mktime();
$imgup_name=$mktime."_".$imgup_name;
$dest = $save_dir . "/" . $imgup_name;
if(!move_uploaded_file($imgup, $dest)) {
die("파일을 지정한 디렉토리에 저장하는데 실패했습니다.");      
}
} 
$queryy="select id from $board order by id desc limit 1";
$mysql_result=mysql_query($queryy);
$row=mysql_fetch_array($mysql_result);
$igroup=$row[id]+1; 

$dbinsert = "insert into $board values ('','$name','$pass','$storytitle','$storycomment','$email',now(),'$REMOTE_ADDR',0,'',$igroup,0,0,'$wallwd','$imgup_name','$imgup_size','$imgup_type','$type')";
$result=mysql_query($dbinsert);
echo ("<meta http-equiv='Refresh' content='0; URL=board_list.php?board=$board&board_grg=$board_grg&fmenu=$fmenu&fsubmenu=$fsubmenu'>");
} else { 
echo ("
<script>
alert('경고! 잘못된 등록키입니다.')
history.go(-1)
</script>
");
exit;
}
}else if ($ljs_mod=="reply" && $wall){
if($wall == $wallok) { 
$result=mysql_query("select id,igroup,space,ssunseo from $board where id='$id'");
$row=mysql_fetch_array($result);
$space=$row[space]+1;
$ssunseot=$row[ssunseo]+1;
$save_dir = "../$board";
if(is_uploaded_file($_FILES["imgup"]["tmp_name"])) {
$mktime=mktime();
$imgup_name=$mktime."_".$imgup_name;
$dest = $save_dir . "/" . $imgup_name;
if(!move_uploaded_file($imgup, $dest)) {
die("파일을 지정한 디렉토리에 저장하는데 실패했습니다.");      
}
} 
$dbinsert = "insert into $board values ('','$name','$pass','$storytitle','$storycomment','$email',now(),'$REMOTE_ADDR',0,'',$row[igroup],$space,$ssunseot,'$wallwd','$imgup_name','$imgup_size','$imgup_type','$type')";
$result=mysql_query($dbinsert);
echo ("<meta http-equiv='Refresh' content='0; URL=board_list.php?board=$board&board_grg=$board_grg&fmenu=$fmenu&fsubmenu=$fsubmenu'>");
}else {
echo ("
<script>
alert('경고! 잘못된 등록키입니다.')
history.go(-1)
</script>
");
exit;
}
}else if ($ljs_mod=="rewriter3"){
$result0=mysql_query("select pass,igroup,filename from $board where id=$id");
$row=mysql_fetch_array($result0);
if (($pass==$row[pass]) || ($pass=="$admin_pwd")){
$deljfilename=$row[filename];
if($deljfilename) {
$delfilename="../$board/$row[filename]";
if(!@unlink($delfilename)) {
	echo "파일삭제에 실패했습니다.";
} else {
	echo "파일 삭제에 성공했습니다.";
}
}
$save_dir = "../$board";
if(is_uploaded_file($_FILES["imgup"]["tmp_name"])) {
$mktime=mktime();
$imgup_name=$mktime."_".$imgup_name;
$dest = $save_dir . "/" . $imgup_name;
if(!move_uploaded_file($imgup, $dest)) {
die("파일을 지정한 디렉토리에 저장하는데 실패했습니다.");      
}
} 
$dbup = "update $board set name='$name',title='$storytitle',comment='$storycomment',email='$email', filename='$imgup_name',filesize='$imgup_size',filetype='$imgup_type',type='$type' where id=$id ";
$result0=mysql_query($dbup);
echo ("<meta http-equiv='Refresh' content='0; URL=board_read.php?id=$id&board=$board&board_grg=$board_grg&sid=$sid&igroup=$row[igroup]&fmenu=$fmenu&fsubmenu=$fsubmenu'>");
} else  {
echo ("
<script>
alert('비밀번호가 틀립니다!')
history.go(-1)
</script>
");
exit;
}
}
?>