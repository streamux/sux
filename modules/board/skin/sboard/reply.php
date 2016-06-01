<SCRIPT LANGUAGE="JavaScript">
<!--
function musimw_check(f)
{
pass = f.pass.value.length;
storytitle = f.storytitle.value.length;
email = f.email.value.length;
storycomment = f.storycomment.value.length;
wall = f.wall.value.length;
if ( pass < 1 ) {
	alert("비밀번호를 입력하세요.");
	f.pass.focus();
	return (false);
}
if ( storytitle < 1 ) {
	alert("제목을 입력하세요.");
	f.storytitle.focus();
	return (false);
}
if ( storytitle > 60 ) {
	alert("제목은 최대 60바이트까지 허용합니다.");
	f.storytitle.focus();
	return (false);
}
if ( email < 1 ) {
	alert("이메일 주소를 입력하세요.");
	f.email.focus();
	return (false);
}
if ( storycomment < 1 ) {
	alert("내용을 입력하세요.");
	f.storycomment.focus();
	return (false);
}
if ( wall < 1 ) {
	alert("붉은글씨를 입력하세요.");
	f.wall.focus();
	return (false);
}
return (true);
}
// --></SCRIPT>
<form action=board_insert.php?id=<? echo $id; ?>&board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&ljs_mod=<? echo $ljs_mod; ?>&fmenu=<? echo $fmenu; ?>&fsubmenu=<? echo $fsubmenu; ?> method=post  name=musimw enctype=multipart/form-data onSubmit="return musimw_check(this);"> 
<?
if ($ljs_mod == "reply")
{
$result=mysql_query("select * from $board where id=$id");
$row=mysql_fetch_array($result);
$storycomment= nl2br($row[comment]);
$name=$row[name];
$email=$row[email];
$storytitle=$row[title];
$storytitle=substr(htmlspecialchars($storytitle),0,40);
$fileupname=$row[filename];
$type=$row[type];
if($admin_type == 'all'){
	if($type=='html'){
		$storycomment= $row[comment];
	}else if($type == 'text'){
		$storycomment= nl2br($row[comment]);
	}
}else if($admin_type == 'html') {
	$storycomment= $row[comment];
}else{
	$storycomment= nl2br($row[comment]);
}
?>
<table width="<? echo $width; ?>" border="0" cellpadding="0" cellspacing="0" bgcolor="#CE0000">
	<tr>
		<td  height="2"></td>
	</tr>
</table>
<table  width="<? echo $width; ?>" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width=100% height=37 valign="bottom">
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
	</tr>
	<tr>
		<td height="1" bgcolor="#D6D7D6"></td>
	</tr>
	<tr>
		<td valign="bottom"><table width="100%" border="0" cellpadding="0" cellspacing="0">
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
		<td>
			<table width="100%"  border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="90" height="100" align="center" valign="middle"> <img src="skin/sboard/img/tt_comment.gif" width="40" height="15"></td>
					<td width="1" bgcolor="#D6D7D6"></td>
					<td width="12" valign="top"><br></td>
					<td align="left" valign="top"><?
if ($fileupname) {
if ($download == 'y') { // 파일다운로드 설정
?>              <a href="board_down.php?board=<? echo $board; ?>&fileupname=<? echo $fileupname; ?>&filepath=<? echo $filesize; ?>')" class="darkblue"><? echo $fileupname; ?>&nbsp;&nbsp;<b>[다운로드]</b></a>
<?
} else {
echo "<br>";
echo "<img src='../$board/$fileupname' width='450' border='0'>";
?>
<?
}
}
echo "<br>";
echo $storycomment;
echo "<br>";
?>
					</td>
				</tr>
				<tr>
					<td height="27" align="center" valign="middle">&nbsp;</td>
					<td bgcolor="#D6D7D6"></td>
					<td align="right"></td>
					<td align="right"><br>&nbsp;&nbsp;<? echo $row[date]; ?>&nbsp;/&nbsp;<a href=mailto:<? echo $email; ?>>e-mail<br>
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
					<td height="2"></td>
				</tr>
			</table></td>
	</tr>
</table>
<?
}
?>
<table width="<? echo $width; ?>" height="3"  border="0" cellpadding="0" cellspacing="0" bgcolor="#D6D7D6">
	<tr>
		<td></td>
	</tr>
</table>
<table  width="<? echo $width; ?>" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width=100% height=37 valign="bottom">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="90" height="27" align="center"><img src="skin/sboard/img/tt_name.gif" width="40" height="15"></td>
					<td align="left">
						<input type=text name=name size=14 maxlength=20 value=<? echo $ljs_name; ?>>
			<input type=hidden name=ljs_mod value="reply"></td>
					<td width="90" align="center"><img src="skin/sboard/img/tt_pass.gif" width="57" height="15"></td>
					<td align="left"><input type=password name=pass size=14 maxlength=10 value=<? echo $ljs_pass1; ?>></td>
				</tr>
		</table></td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td valign="bottom"><table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="90" height="27" align="center"><img src="skin/sboard/img/tt_title.gif" width="40" height="15"></td>
					<td align="left"><input type=text name=storytitle size=65 maxlength=50><input type=hidden name=stwrite size=60 maxlength=60 value="<? echo $stwrite; ?>"></td>
				</tr>
		</table></td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
			<td valign="bottom"><table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="90" height="27" align="center"><img src="skin/sboard/img/tt_email.gif" width="40" height="15"></td>
						<td><input type=text name=email size=30 maxlength=28 value=<? echo $ljs_email; ?>></td>
			<td width="10"></td>
			<td><font color="FF0000"><? if($setup == 'y'){
				echo "※필수입력 사항입니다.";
				} ?></font></td>
					</tr>
			</table></td>
		</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td><table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="90" height="27" align="center"></td>
					<td><input name="type" type="radio" value="html" <? if($admin_type == 'html') echo "checked"; ?>>
						<strong>HTML</strong>&nbsp;&nbsp;<input name="type" type="radio" value="text" <? if($admin_type == 'text' || $admin_type == 'all') echo "checked"; ?>>
						<strong>TEXT</strong></td>
					<td width="10"></td>
					<td>※ 형식을 선택해주세요. </td>
				</tr>
			</table></td>
		</tr>
	<tr>
		<td height="5"></td>
		</tr>
		<tr>
		<td>
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="90" align="center"><img src="skin/sboard/img/tt_comment.gif" width="40" height="15"></td>
					<td>
						<textarea name=storycomment cols=64 rows=14></textarea></td>
				</tr>
		</table></td>
	</tr>
	<tr>
		<td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="90" height="10"></td>
					<td></td>
				</tr>
				<tr>
					<td align="center"><img src="skin/sboard/img/tt_adfile.gif" width="57" height="15"></td>
					<td><input type=file name=imgup size=40>
				</tr>
				<tr>
					<td></td>
					<td>php,php3,htm,html,js,exe,phtml,inc,jsp,asp,swf 등의<br>
						실행파일은 업로드 할 수 없습니다.</td>
				</tr>
				<tr>
					<td align="center"><img src="skin/sboard/img/tt_adkey.gif" width="44" height="15"></td>
					<td><input type=text name=wall size=16 maxlength=20></td>
				</tr>
				<tr>
					<td align="center"></td>
					<td>프로그램 등록을 방지하기 위해 붉은 글씨를 입력하세요.(미입력시 등록 안됨)<br>
							<? 
$result=mysql_query("select wall from $board order by id desc limit 1");
$row=mysql_fetch_array($result);
if($row[wall] == 'a') {
echo "<font color=red size=3><b>나라사랑</b></font>";
?>
							<input type=hidden name=wallok value="나라사랑">
							<input type=hidden name=wallwd value="b">
							<?
} else if($row[wall] == 'b') {
echo "<font color=red size=3><b>조국사랑</b></font>";
?>
							<input type=hidden name=wallok value="조국사랑">
							<input type=hidden name=wallwd value="a">
							<?
}
?></td>
				</tr>
				<tr>
					<td height="5"></td>
					<td></td>
				</tr>
				<tr>
					<td height="1" colspan="2" bgcolor="#D6D7D6"></td>
				</tr>
				<tr>
					<td height="5"></td>
					<td height="5"></td>
				</tr>
				<tr>
					<td align="center"></td>
					<td align="right"><table  border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><input name="imageField" type="image" src="skin/sboard/img/btn_confirm.gif" width="51" height="23" border="0"></td>
								<td width="10"></td>
								<td><a href="#" onclick="history.back()"><img src="skin/sboard/img/btn_cancel.gif" width="51" height="23" border="0"></a></td>
							</tr>
					</table></td>
				</tr>
		</table></td>
	</tr>
</table>
	<script>
document.musimw.name.focus();
	</script>
</form>
