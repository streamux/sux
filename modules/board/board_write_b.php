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
if ( storytitle > 30 ) {
	alert("제목은 최대 30바이트까지 허용합니다.");
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
<form action=board_insert.php?id=<? echo $id; ?>&board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&fmenu=<? echo $fmenu; ?>&fsubmenu=<? echo $fsubmenu; ?> method=post  name=musimw enctype=multipart/form-data onSubmit="return musimw_check(this);">
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
						<td width="90" height="27" align="center"><img src="skin/img/tt_name.gif" width="40" height="15"></td>
						<td>
				<input type=text name=name size=14 maxlength=20 value=<? echo $ljs_nickname; ?>>
				<input type=hidden name=ljs_mod value="writer"></td>
						<td width="90" align="center"><img src="skin/img/tt_pass.gif" width="57" height="15"></td>
						<td>
							<input type=password name=pass size=14 maxlength=10 value=<? echo $ljs_pass1; ?>></td>
					</tr>
			</table></td>
		</tr>
		<tr>
			<td height="5"></td>
		</tr>
		<tr>
			<td valign="bottom"><table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="90" height="27" align="center"><img src="skin/img/tt_title.gif" width="40" height="15"></td>
						<td>
						<input type=text name=storytitle size=65 maxlength=50></td>
					</tr>
			</table></td>
		</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
			<td><table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="90" height="27" align="center"><img src="skin/img/tt_email.gif" width="40" height="15"></td>
						<td><input type=text name=email size=30 maxlength=28 value="<? echo $ljs_email; ?>"></td>
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
			<td>
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="90" align="center"><img src="skin/img/tt_comment.gif" width="40" height="15"></td>
						<td>			<textarea name=storycomment cols=64 rows=14></textarea></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="90" height="10"></td>
					<td></td>
				</tr>
				<tr>
					<td align="center"><img src="skin/img/tt_adfile.gif" width="57" height="15"></td>
					<td><input type=file name=imgup size=40></tr>
				<tr>
					<td></td>
					<td>php,php3,htm,html,js,exe,phtml,inc,jsp,asp,swf 등의<br>
실행파일은 업로드 할 수 없습니다.</td>
				</tr>
				<tr>
					<td align="center"><img src="skin/img/tt_adkey.gif" width="44" height="15"></td>
					<td><input type=text name=wall size=16 maxlength=20></td>
				</tr>
				<tr>
					<td align="center"></td>
					<td>프로그램 등록을 방지하기 위해 붉은 글씨를 입력하세요.(미입력시 등록 안됨)<br>
						<? 
$result=mysql_query("select wall from $board where space=0 order by id desc limit 1");
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
							<td><input name="imageField" type="image" src="skin/img/btn_confirm.gif" width="51" height="23" border="0"></td>
							<td width="10"></td>
							<td><a href="#" onclick="history.back()"><img src="skin/img/btn_cancel.gif" width="51" height="23" border="0"></a></td>
						</tr>
					</table></td>
				</tr>
			</table></td>
		</tr>
	</table>  
</form>
<script>
document.musimw.name.focus();
</script>
