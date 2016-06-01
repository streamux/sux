<table width="<? echo $width; ?>" border="0" cellpadding="0" cellspacing="0" bgcolor="#CE0000">
	<tr>
		<td height="2"></td>
	</tr>
</table>
<table  width="<? echo $width; ?>" border="0" cellpadding="0" cellspacing="0">
	<tr><td width=100% height=37 align="left" valign="bottom">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="90" height="27" align="center"><img src="skin/sboard/img/tt_writer.gif" width="40" height="15"></td>
		<td width="4"><img src="skin/sboard/img/verti_ttline.gif" width="1" height="27"></td>
		<td align="left">&nbsp;&nbsp;<? echo $name; ?></td>
		<td width="4"><img src="skin/sboard/img/verti_ttline.gif" width="1" height="27"></td>
		<td width="90" align="center"><img src="skin/sboard/img/tt_counter.gif" width="40" height="15"></td>
		<td width="4"><img src="skin/sboard/img/verti_ttline.gif" width="1" height="27"></td>
		<td width="100" align="center"><? echo $row[see]; ?></td>
	</tr>
</table></td>
</tr><tr><td height="1" bgcolor="#D6D7D6"></td></tr>
<tr>
	<td align="left" valign="bottom"><table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="90" height="27" align="center"><img src="skin/sboard/img/tt_title.gif" width="40" height="15"></td>
				<td width="4"><img src="skin/sboard/img/verti_ttline.gif" width="1" height="27"></td>
				<td align="left">&nbsp;&nbsp;<? echo $storytitle; ?></td>
				<td width="4"><img src="skin/sboard/img/verti_ttline.gif" width="1" height="27"></td>
				<td width="90" align="center"><img src="skin/sboard/img/tt_date.gif" width="40" height="15"></td>
				<td width="4"><img src="skin/sboard/img/verti_ttline.gif" width="1" height="27"></td>
				<td width="100" align="center"><? echo $row[date]; ?></td>
			</tr>
		</table></td>
</tr>
<tr>
	<td height="1" bgcolor="#D6D7D6"></td>
</tr>
<tr>
	<td align="left">
		<table  border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="90" height="100" align="center" valign="middle"><img src="skin/sboard/img/tt_comment.gif" width="40" height="15"></td>
		<td width="1" bgcolor="#D6D7D6"></td>
		<td width="12" valign="top"><br></td>
		<td width="460" align="left" valign="top"><?
if ($fileupname) {
if ($download == 'y') { // 파일다운로드 설정
?>
			<a href="board_down.php?board=<? echo $board; ?>&fileupname=<? echo $fileupname; ?>&filepath=<? echo $filesize; ?>" class="darkblue"><? echo $fileupname; ?>&nbsp;&nbsp;<b>[다운로드]</b></a>
<?	
} else {
echo "<br>";
echo "<img src='../$board/$fileupname' width='450' border='0'>";
?>
<?
}
}
echo "<br>";
echo "$storycomment";
echo "<br>";
?>      </td>
	</tr>
	<tr>
		<td height="27" align="center" valign="middle">&nbsp;</td>
		<td bgcolor="#D6D7D6"></td>
		<td align="right"></td>
		<td align="right"><br>&nbsp;&nbsp;<? echo $row[date]; ?>&nbsp;l&nbsp;<a href=mailto:<? echo $email; ?>>e-mail<br>
			<br></td>
	</tr>
	<tr>
		<td height="1"bgcolor="#D6D7D6"></td>
		<td bgcolor="#D6D7D6"></td>
		<td colspan="2" bgcolor="#D6D7D6"></td>
	</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td align="right">&nbsp;</td>
		</tr>
</table>
<br></td>
</tr>
</table>
<!----------------- 꼬리글 ---------------->
<?
if(($tail == 'y')){  // 꼬리글 출력설정
?>
<table width="<? echo $width; ?>" border="0" cellpadding="0" cellspacing="0">
	<tr><td>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="white" bordercolorlight="#006600" bordercolordark="#006600">
<tr><td colspan=2 height=27 align=center bgcolor=#cccccc><b>꼬 리 글</b></td></tr>
<tr>
	<td colspan=2 height=5></td>
</tr>
<?
$result2=mysql_query("select * from $board_grg where storyid=$id order by id");
while ($row2=mysql_fetch_array($result2))
{
$day=$row2[date];
$nickname=htmlspecialchars($row2[nickname]);
$iyggrcomment= nl2br($row2[comment]);
$grgid=$row2[id];
?>
</table>
<table width="<? echo $width; ?>"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="12"></td>
		<td width="78" valign="top"><?
echo "$nickname";
?></td>
		<td width="12"></td>
		<td valign="top"><?
echo $iyggrcomment;
?></td>
		<td width="100" valign="top"><?
echo $day;
?></td>
		<td width="50" align="center" valign="top"><a href=board_grg_delpass.php?id=<? echo $id; ?>&board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&grgid=<? echo $grgid; ?>&igroup=<? echo $igroup; ?>&passover=<? echo $passover; ?>&fmenu=<? echo $fmenu; ?>&fsubmenu=<? echo $fsubmenu; ?>>[삭제]</a></td>
	</tr>
	<tr valign="middle">
		<td height="4" colspan="6"></td>
		</tr>
	<tr valign="middle">
		<td colspan="6"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td height="1" background="skin/sboard/img/hori_pointline.gif"></td>
			</tr>
		</table></td>
	</tr>
	<tr valign="middle">
		<td height="6" colspan="6"></td>
	</tr>
<?
}
?>
</table>
</td></tr></table>
<br>
<SCRIPT LANGUAGE="JavaScript">
<!--
function musimsl_check(f)
{
nameo = f.name.value.length;
passo = f.pass.value.length;
commento = f.comment.value.length;
if ( nameo < 1 ) {
	alert("이름을 입력하세요.");
	f.name.focus();
	return (false);
}else if ( passo < 1 ) {
	alert("비밀번호를 입력하세요.");
	f.pass.focus();
	return (false);
}else if ( commento < 1 ) {
	alert("내용을 입력하세요.");
	f.comment.focus();
	return (false);
}
return (true);
}
// --></SCRIPT>
<form action=board_grg_insert.php?id=<? echo $id; ?>&board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&igroup=<? echo $igroup; ?>&passover=<? echo $passover; ?>&sid=<? echo $sid; ?>&fmenu=<? echo $fmenu ?>&fsubmenu=<? echo $fsubmenu ?> method=post name=musimsl onSubmit="return musimsl_check(this);">
<input type=hidden name=iygmdgrg value=y>
<table width="<? echo $width; ?>"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="90" height="27" align="center"><img src="skin/sboard/img/tt_tail_write.gif" width="70" height="15"></td>
				<td width="4"><img src="skin/sboard/img/verti_ttline.gif" width="1" height="27"></td>
				<td align="left"><img src="skin/sboard/img/tt_name.gif" width="40" height="15">
		<INPUT type=text name=name size=10 maxlength=20 value="<? echo $ljs_nickname; ?>">&nbsp;&nbsp;&nbsp;<img src="skin/sboard/img/tt_pass.gif" width="57" height="15">&nbsp;
		<INPUT type=password name=pass size=8 maxlength=8 value="<? echo $ljs_pass1; ?>"></td>
				</tr>
		</table></td>
	</tr>
	<tr>
		<td height="1" bgcolor="#D6D7D6"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><table width="100%" border=0 cellpadding="0" cellspacing="0">      
				<TR>
					<TD width=90 height=20 align=center><img src="skin/sboard/img/tt_comment.gif" width="40" height="15"></TD>
					<TD height=20 align=right>
						<TEXTAREA name=comment cols=64 rows=5 style="line-height:130%;"></TEXTAREA>
					</TD>
				</TR>      
		</table></td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td align="right"><table border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td><input type="submit" name="Submit" value="등록하기"></td>
				<td width="20"></td>
				<td><input type="reset" name="Submit2" value="다시쓰기"></td>
			</tr>
		</table></td>
	</tr>
</table>
</form>
<?
}
?>
<!----------------- 꼬리글 출력 끝---------------->
<table width="<? echo $width; ?>"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
<?
if($s_mod==s_mode) {  //검색모드에서 보기를 클릭시
echo "<a href=board_search_list.php?board=$board&board_grg=$board_grg&find=$find&search=$search&fmenu=$fmenu&fsubmenu=$fsubmenu>";
echo "<img src='skin/sboard/img/btn_list.gif' width='51' height='23' border='0'>";
echo "</a>";
}else{
echo "<a href=board_list.php?board=$board&board_grg=$board_grg&fmenu=$fmenu&fsubmenu=$fsubmenu>";
echo "<img src='skin/sboard/img/btn_list.gif' width='51' height='23' border='0'>";
echo "</a>";
}
?>&nbsp;<a href="board_write.php?&board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&fmenu=<? echo $fmenu; ?>&fsubmenu=<? echo $fsubmenu; ?>"><img src="skin/sboard/img/btn_write.gif" width="62" height="23" border="0"></a>&nbsp;<a href="board_reply.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&id=<? echo $id; ?>&fmenu=<? echo $fmenu; ?>&fsubmenu=<? echo $fsubmenu; ?>&ljs_mod=reply"><img src="skin/sboard/img/btn_answer.gif" width="51" height="23" border="0"></a>&nbsp;<a href="board_rewrite.php?id=<? echo $id; ?>&board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&sid=<? echo $sid; ?>&fmenu=<? echo $fmenu; ?>&fsubmenu=<? echo $fsubmenu; ?>&ljs_mod=sujeong"><img src="skin/sboard/img/btn_edit.gif" border="0"></a>&nbsp;<a href="board_delpass.php?id=<? echo $id; ?>&board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&fmenu=<? echo $fmenu; ?>&fsubmenu=<? echo $fsubmenu; ?>"><img src="skin/sboard/img/btn_del.gif" width="51" height="23" border="0"></a></td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
</table>
<!----------------- 목록 출력 시작 ------------->
<?
if($s_mod){ // 검색모드에서 출력하기
	$option="where $find like '%$search%'";
}else{
	$option="";
}

$numresults=mysql_query("select id from $board $option ");
$numrows=mysql_num_rows($numresults);
$limit=10;  
if(!$passover){
	$passover=0;
}
?>
<table width="<? echo $width; ?>" height="2"  border="0" cellpadding="0" cellspacing="0" bgcolor="#CE0000">
	<tr>
		<td></td>
	</tr>
</table>
<table width="<? echo $width; ?>"  border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="38" valign="bottom"><table width="100%" height="27" border="0" cellpadding="0" cellspacing="0">
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
<!----------------- 글목록 깨짐방지 시작---------------->
<?
Function StrCut($string, $num){
 $cut_string = $string; 
 $cut = $num;
 if(strlen($string) > $cut AND $cut != "0"){ // 줄이고 싶은 값이 있을때
	for($i=0; $i<$cut-1; $i++){ // 자르고 싶은 전체값 -1까지 for문 실행
	 if(ord(substr($cut_string, $i, 1))>127) $i++; // 변수에 담긴 배열을 검사해서 반쪽보다 크면 i값을 증가한다.
	}
	$cut_string = sprintf("%s", substr($cut_string, 0, $i)."...");
 }else{
	$cut_string = $string;
 }
 return $cut_string;
}
?>
<!----------------- 글목록 깨짐방지 끝---------------->
<?
$result=mysql_query("select * from $board $option order by igroup desc,ssunseo asc limit $passover,$limit");
$numrows2=mysql_num_rows($result);
$a=$numrows-$passover;
while ($row=mysql_fetch_array($result))
{
$sid=$row[id];
$title= nl2br($row[title]);
$opkey=$row[opkey];
$day=$row[date];
$today=date("Y-m-d");
$string=$title;
// 글자수 컨트롤하기
if($day == $today && $opkey){
	$num=24;
}else if($day == $today || $opkey){
	$num=26;
}else{
	$num=34;
}
$title=StrCut($string, $num);
?><tr>
					<td width="48" height="27" align="center">
<?
echo $a;
$a--;
?></td>
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
echo "<IMG src=\"skin/sboard/img/gif.gif\" >&nbsp;";
}else if($type=="image/pjpeg"){
echo "<IMG src=\"skin/sboard/img/jpg.gif\" >&nbsp;";
}else if($type=="image/x-png"){
echo "<IMG src=\"skin/sboard/img/png.gif\" >&nbsp;";
}else if($type=="image/bmp"){
echo "<IMG src=\"skin/sboard/img/bmp.gif\" >&nbsp;";
}else if($type=="application/x-zip-compressed"){ 
echo "<IMG src=\"skin/sboard/img/down.gif\" >&nbsp;";
}else {
echo "<IMG src=\"skin/sboard/img/text.gif\" >&nbsp;";
}
}
?>
</td>
		<td>
<?
echo "<a href=board_read.php?board=$board&board_grg=$board_grg&id=$row[id]&igroup=$row[igroup]&passover=$passover&page=$page&sid=$sid&find=$find&search=$search&fmenu=$fmenu&fsubmenu=$fsubmenu&ljs_mod=r_mode&s_mod=$s_mod>";
echo "$title ";
echo "</a>";
?>
<?
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
echo "<IMG src=\"skin/sboard/img/new.gif\" >";
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
	echo "&nbsp;<IMG src=\"skin/sboard/img/icon_finish.gif\" >";
	break;
	case 'i';
	echo "&nbsp;<IMG src=\"skin/sboard/img/icon_ing.gif\" >";
	break;
	case 'c';
	echo "&nbsp;<IMG src=\"skin/sboard/img/icon_cost.gif\" >";
	break;
	case 'm';
	echo "&nbsp;<IMG src=\"skin/sboard/img/icon_mail.gif\" >";
	break;
	case 'n';
	echo "&nbsp;<IMG src=\"skin/sboard/img/icon_no_cost.gif\" >";
	break;
}
?></td>
		 </tr>
	 </table>
	</td>
	</tr>
</table></td>
					<td width="4"></td>
					<td width="90" align="center"><? echo $row[name]; ?></td>
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
if($a!==$underline){
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
		</table></td>
	</tr>
<!----------------- 목록 출력 끝 ------------->
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
		<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="10" height="36"></td>
				<td width="288" align="left"><? include "navi.php"; ?></td>
				<td align="right"><SCRIPT LANGUAGE="JavaScript">
<!--
function musimsgrg_check(f)
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
					<form action=board_search.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&sid=<? echo $sid; ?>&find=<? echo $find; ?>&search=<? echo $search; ?>&fmenu=<? echo $fmenu; ?>&fsubmenu=<? echo $fsubmenu; ?> method=post name=musimsgrg onSubmit="return musimsgrg_check(this);">
						<table border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><select name=find>
						<option value=title>제 목</option>
										<option value=name>이 름</option>                    
										<option value=comment>내 용</option>
									</select>
		&nbsp;</td>
								<td><input type=text name=search size=15>
		&nbsp;</td>
								<td><input name="imageField" type="image" src="skin/sboard/img/btn_search.gif" width="51" height="23" border="0"></td>
							</tr>
						</table>
				</form></td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td valign="bottom">
<?
if($s_mod==s_mode) {
echo "<a href=board_search_list.php?board=$board&board_grg=$board_grg&find=$find&search=$search&fmenu=$fmenu&fsubmenu=$fsubmenu>";
echo "<img src='skin/sboard/img/btn_list.gif' width='51' height='23' border='0'>";
echo "</a>";
}else{
echo "<a href=board_list.php?board=$board&board_grg=$board_grg&fmenu=$fmenu&fsubmenu=$fsubmenu>";
echo "<img src='skin/sboard/img/btn_list.gif' width='51' height='23' border='0'>";
echo "</a>";
}
?>
&nbsp;<img src="skin/sboard/img/btn_prev.gif" width="51" height="23">&nbsp;<img src="skin/sboard/img/btn_next.gif" width="51" height="23">&nbsp;<a href=board_write.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&id=<? echo $row[id]; ?>&igroup=<? echo $row[igroup]; ?>&passover=<? echo $passover; ?>&page=<? echo $page; ?>&sid=<? echo $sid; ?>&fmenu=<? echo $fmenu; ?>&fsubmenu=<? echo $fsubmenu; ?>&mode=<? echo w_mode; ?>><img src="skin/sboard/img/btn_write.gif" width="62" height="23" border="0"></a></td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
</table>
<!----------------- 관리자 잠금장치 시작---------------->
 <? 
if($setup == 'y') { // 관리자 잠금설정
if($HTTP_SESSION_VARS[grade] > 9){
?>
<table width="<? echo $width; ?>" border="0" cellpadding="0" cellspacing="0">
<form action=board_opkey.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&id=<? echo $id; ?>&fmenu=<? echo $fmenu; ?>&fsubmenu=<? echo $fsubmenu; ?> method=post  name=musimso>  
<input type=hidden name=ch value=y>	
	<tr><td height=2 bgcolor="#4EA2CF"></td></tr>
	<tr>
		<td height=1 bgcolor="#ACDBF7"></td>
	</tr>
	<tr>
		<td height=10></td>
	</tr>
	<tr>
		<td height=5><table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="100" height="27" align="center">진행상황</td>
					<td width="1"><img src="skin/sboard/img/verti_ttline.gif" width="1" height="27"></td>
					<td align="left">
						<TABLE border="0" cellpadding="0" cellspacing="0">
							<TR>
					<td width="20"></td>
								<TD height=20 align=left>
									<input type="radio" name="opkey" value="f" checked>진행완료
									<input type="radio" name="opkey" value="i">진행중</TD>
								</TR>
						</TABLE></td>
				</tr>
		<tr>
			 <td height="1" colspan="3"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
						 <tr>
							 <td height="1" background="skin/sboard/img/hori_pointline.gif"></td>
						 </tr>
					 </table></td>
		</tr>
				<tr>
					<td height="27" align="center">입금상황</td>
					<td width="1"><img src="skin/sboard/img/verti_ttline.gif" width="1" height="27"></td>
					<td align="left"><TABLE border="0" cellpadding="0" cellspacing="0">
						<TR>
							<td width="20"></td>
							<TD height=20 align=left>
								<input type="radio" name="opkey" value="c">입금완료
								<input type="radio" name="opkey" value="n">미입금</TD>
							</TR>
					</TABLE></td>
				</tr>
		<tr>
			 <td height="1" colspan="3"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
						 <tr>
							 <td height="1" background="skin/sboard/img/hori_pointline.gif"></td>
						 </tr>
					 </table></td>
		</tr>
				<tr>
					<td height="27" align="center">메일발송</td>
					<td width="1"><img src="skin/sboard/img/verti_ttline.gif" width="1" height="27"></td>
					<td align="left"><TABLE border="0" cellpadding="0" cellspacing="0">
						<TR>
							<td width="20"></td>
							<TD height=20 align=left>
								<input type="radio" name="opkey" value="m">메일발송</TD>
							</TR>
					</TABLE></td>
				</tr>
		<tr>
			 <td height="1" colspan="3"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
						 <tr>
							 <td height="1" background="skin/sboard/img/hori_pointline.gif"></td>
						 </tr>
					 </table></td>
		</tr>
				<tr>
					<td height="27" align="center">초기화</td>
					<td width="1"><img src="skin/sboard/img/verti_ttline.gif" width="1" height="27"></td>
					<td align="left"><TABLE border="0" cellpadding="0" cellspacing="0">
						<TR>
							<td width="20"></td>
							<TD height=20 align=left>
								<input type="radio" name="opkey" value="">초기화</TD>
							</TR>
					</TABLE></td>
				</tr>
		<tr>
			 <td height="1" colspan="3"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
						 <tr>
							 <td height="1" background="skin/sboard/img/hori_pointline.gif"></td>
						 </tr>
					 </table></td>
		</tr>
				<tr>
					<td height="27" align="center">입력버튼</td>
					<td width="1"><img src="skin/sboard/img/verti_ttline.gif" width="1" height="27"></td>
					<td align="left">            <TABLE border="0" cellpadding="0" cellspacing="0">
							<TR>
								<td width="20"></td>
								<TD height=20 align=left>
									<INPUT type=submit name=submit24 size=10 value=" 보내기 "></TD>
							</TR>
						</TABLE></td>
				</tr>
			</table></td>
	</tr>
	<tr>
		<td height=1 bgcolor="#D6D7D6"></td>
	</tr>
	<tr>
		<td height=30>&nbsp;&nbsp;&nbsp;※ 해당버튼을 선택하여 진행상황을 표시할 수 있습니다.</td>
	</tr>
	<tr>
		<td height=2 bgcolor="#D6D7D6"></td>
	</tr>
</form></table>
<?
}
}
?>
<!----------------- 관리자 잠금장치 끝---------------->