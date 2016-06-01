<?
$numresults=mysql_query("select id from $board");
$numrows=mysql_num_rows($numresults);
$limit=10;    
if (!$passover) {
	 $passover=0;
}
?>
<table width="<? echo $width; ?>"  border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="2" bgcolor="#CE0000"></td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td><table width="100%" height="27" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="48" height="27" align="center"><img src="skin/sboard/img/tt_num.gif" width="40" height="15"></td>
				<td width="4"><img src="skin/sboard/img/verti_ttline.gif" width="1" height="27"></td>
				<td align="center"><img src="skin/sboard/img/tt_title.gif" width="40" height="15"></td>
				<td width="4"><img src="skin/sboard/img/verti_ttline.gif" width="1" height="27"></td>
				<td width="90" align="center"><img src="skin/sboard/img/tt_writer.gif" width="40" height="15"></td>
				<td width="4"><img src="skin/sboard/img/verti_ttline.gif" width="1" height="27"></td>
				<td width="90" align="center"><img src="skin/sboard/img/tt_date.gif" width="40" height="15"></td>
				<td width="4"><img src="skin/sboard/img/verti_ttline.gif" width="1" height="27"></td>
				<td width="70" align="center"><img src="skin/sboard/img/tt_counter.gif" width="40" height="15"></td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td height="1" bgcolor="#D6D7D6"></td>
	</tr>
	<tr>
		<td>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
<?
// 글자수 깨짐방지 함수
Function StrCut($string, $num){
 $cut_string = $string; 
 $cut = $num;
 if(strlen($string) > $cut AND $cut != "0"){ // 줄이고 싶은 값이 있을때
	for($i=0; $i<$cut-1; $i++){ // 자르고 싶은 전체값 -1까지 for문 실행
	 if(ord(substr($cut_string, $i, 1))>127) $i++; // 변수에 담긴 배열을 검사해서 반쪽보다 크면 i값을 증가한다.
	}
	$cut_string = sprintf("%s", substr($cut_string, 0, $i)."..."); // cut_string 값을 받아서 문자열로 출력.
 }else{
	$cut_string = $string;
 }
 return $cut_string;
}
// 글자수 깨짐방지 함수 끝

$result=mysql_query("select * from $board order by igroup desc,ssunseo asc limit $passover,$limit");
$numrows2=mysql_num_rows($result);
$a=$numrows-$passover;
while ($row=mysql_fetch_array($result))
{
$sid=$row[id];
$title=nl2br($row[title]);
$opkey=$row[opkey];
$day=$row[date];
$today=date("Y-m-d");
$string=$title;

// 글자수 컨트롤하기
if($day == $today && $opkey){
	$num=20;
}else if($day == $today || $opkey){
	$num=28;
}else{
	$num=34;
}
$title=StrCut($string, $num);
?>
				<tr>
					<td width="48" height="27" align="center">
<?
echo $a;
$a--;
?>
</td>
					<td width="4"></td>
					<td align="left"><table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td><table border="0" cellpadding="0" cellspacing="0">
						 <tr>
							<td>
<?
$space = $row[space];
if($space){
for($i=0; $i<$space; $i++){
echo "&nbsp;&nbsp;";
}
?>              </td>
								<td>
<?
}
if($space)
{
echo "<img src=\"skin/sboard/img/icon_answer.gif\">&nbsp";
}else{
echo "<img src=\"skin/sboard/img/text.gif\">&nbsp";
}
?></td>
		<td>
<?
$type=$row[filetype];
if($row[filename]){
if ($type=="image/gif"){
echo "<IMG src=\"skin/sboard/img/gif.gif\">&nbsp;";
}else if($type=="image/pjpeg"){
echo "<IMG src=\"skin/sboard/img/jpg.gif\">&nbsp;";
}else if($type=="image/x-png"){
echo "<IMG src=\"skin/sboard/img/png.gif\">&nbsp;";
}else if($type=="image/bmp"){
echo "<IMG src=\"skin/sboard/img/bmp.gif\">&nbsp;";
}else if($type=="application/x-zip-compressed"){ 
echo "<IMG src=\"skin/sboard/img/down.gif\">&nbsp;";
}else {
echo "<IMG src=\"skin/sboard/img/text.gif\">&nbsp;";
}
}
?>
</td>
		<td>
<?
	echo "<a href=board_read.php?board=$board&board_grg=$board_grg&id=$row[id]&igroup=$row[igroup]&passover=$passover&page=$page&sid=$sid&fmenu=$fmenu&fsubmenu=$fsubmenu&ljs_mod=r_mode>";
	echo "$title ";
	echo "</a>";

$grgresult=mysql_query("select id from $board_grg where storyid=$sid");
$grgnums=mysql_num_rows($grgresult);
if($grgnums)
{
echo "(";
echo $grgnums;
echo ")";
}
?></td>
		<td align="right">
<?
if($day == $today){
echo "&nbsp;<IMG src=\"skin/sboard/img/new.gif\">";
}
?></td>
		<td width="4"></td>
	</tr>
</table>
	 </td>
		<td align="right"><table cellpadding="0" cellspacing="0">
		 <tr>
			 <td>
<?
switch ($opkey) {
	case 'f';
	echo "&nbsp;<IMG src=\"skin/sboard/img/icon_finish.gif\">";
	break;
	case 'i';
	echo "&nbsp;<IMG src=\"skin/sboard/img/icon_ing.gif\">";
	break;
	case 'c';
	echo "&nbsp;<IMG src=\"skin/sboard/img/icon_cost.gif\">";
	break;
	case 'm';
	echo "&nbsp;<IMG src=\"skin/sboard/img/icon_mail.gif\">";
	break;
	case 'n';
	echo "&nbsp;<IMG src=\"skin/sboard/img/icon_no_cost.gif\">";
	break;
}
?></td>
		 </tr>
	 </table>
	</td>
	</tr>
</table></td>
					<td width="4"></td>
					<td width="90" align="center"><?echo $row[name]; ?></td>
					<td width="4"></td>
					<td width="90" align="center">
<?
echo $day;
?>
</td>
					<td width="4"></td>
					<td width="70" align="center">
<?
echo $row[see];
?>
</td>
				</tr>
<?
$underline=($numrows-$passover)-$numrows2;
if($a > $underline ){
?>
				<tr>
					<td height="1" colspan="9"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td height="1" background="skin/sboard/img/hori_pointline.gif"></td>
						</tr>
					</table></td>
				</tr>
<?
}
}
?>
			</table>
</td>
	</tr>
	<tr>
		<td height="2"></td>
	</tr>
	<tr>
		<td height="1" bgcolor="#D6D7D6"></td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="16"><table width=100% border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="10" height="36"></td>
				<td width="288" align="left"><? include "navi.php"; ?></td>
				<td align="right"><SCRIPT LANGUAGE="JavaScript">
<!--
function musimsl_check(f)
{
searcho = f.search.value.length;
if ( searcho < 1 ) {
	alert("검색어를 입력하세요.");
	f.search.focus();
	return (false);
}
return (true);
}
// --></SCRIPT>
						<form action=board_search.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&sid=<? echo $sid; ?>&find=<? echo $find; ?>&search=<? echo $search; ?>&fmenu=<? echo $fmenu; ?>&fsubmenu=<? echo $fsubmenu; ?> method=post name=musimsl onSubmit="return musimsl_check(this);">
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><select name=find>
							<option value='title'>제 목</option>
											<option value='name'>이 름</option>
											<option value='comment'>내 용</option>
										</select>&nbsp;</td>
									<td><input type=text name=search size=15>&nbsp;</td>
									<td><input name="imageField" type="image" src="skin/sboard/img/btn_search.gif" width="51" height="23" border="0"></td>
								</tr>
							</table>
				</form>
					</td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td><a href=board_list.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&fmenu=<? echo $fmenu; ?>&fsubmenu=<? echo $fsubmenu; ?>><img src="skin/sboard/img/btn_list.gif" width="51" height="23" border="0"></a>&nbsp;<img src="skin/sboard/img/btn_prev.gif" width="51" height="23">&nbsp;<img src="skin/sboard/img/btn_next.gif" width="51" height="23">&nbsp;<a href=board_write.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&id=<? echo $row[id]; ?>&igroup=<? echo $row[igroup]; ?>&passover=<? echo $passover; ?>&page=<? echo $page; ?>&sid=<? echo $sid; ?>&fmenu=<? echo $fmenu; ?>&fsubmenu=<? echo $fsubmenu; ?>&ljs_mod=<? echo writer; ?>><img src="skin/sboard/img/btn_write.gif" width="62" height="23" border="0"></a></td>
	</tr>
</table>
