<SCRIPT LANGUAGE="JavaScript">
<!--
function musimw_check(f)
{
passo = f.pass.value.length;
storytitleo = f.storytitle.value.length;
emailo = f.email.value.length;
storycommento = f.storycomment.value.length;
if ( passo < 1 ) {
	alert("비밀번호를 입력하세요.");
	f.pass.focus();
	return (false);
}
if ( storytitleo < 1 ) {
	alert("제목을 입력하세요.");
	f.storytitle.focus();
	return (false);
}
if ( storytitleo > 60 ) {
	alert("제목은 최대 60바이트까지 허용합니다.");
	f.storytitle.focus();
	return (false);
}
if ( emailo < 1 ) {
	alert("이메일 주소를 입력하세요.");
	f.email.focus();
	return (false);
}
if ( storycommento < 1 ) {
	alert("내용을 입력하세요.");
	f.storycomment.focus();
	return (false);
}
return (true);
}
// --></SCRIPT>
<form action=board_insert.php?id=<? echo $id; ?>&board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&ljs_mod=<? echo $ljs_mod; ?>&&fmenu=<? echo $fmenu; ?>&fsubmenu=<? echo $fsubmenu; ?> method=post  name=musimw enctype=multipart/form-data onSubmit="return musimw_check(this);">
	<table width="<? echo $width; ?>" border="0" cellpadding="0" cellspacing="0" bgcolor="#CE0000">
		<tr>
			<td height="2"></td>
		</tr>
	</table>
<?
$result=mysql_query("select * from $board where id=$id");
$row=mysql_fetch_array($result);
$storycomment=htmlspecialchars($row[comment]);
$name=htmlspecialchars($row[name]);
$storytitle=nl2br($row[title]);
$email=$row[email];
?>
	<table  width="<? echo $width; ?>" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width=100% height=37 valign="bottom">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="90" height="27" align="center"><img src="skin/sboard/img/tt_name.gif" width="40" height="15"></td>
						<td>
				<input type=text name=name size=14 maxlength=20 value=<? echo $name; ?>>
				<input type=hidden name=ljs_mod value="rewriter3"></td>
						<td width="90" align="center"><img src="skin/sboard/img/tt_pass.gif" width="57" height="15"></td>
						<td>
							<input type=password name=pass size=14 maxlength=10></td>
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
						<td>
						<INPUT type=text name=storytitle size=60 maxlength=60 value="<? echo $storytitle; ?>"></td>
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
						<td><input type=text name=email size=30 maxlength=28 value="<? echo $email; ?>"></td>
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
						<td width="90" align="center"><img src="skin/sboard/img/tt_comment.gif" width="40" height="15"></td>
						<td><textarea name=storycomment cols=64 rows=14><? echo $storycomment; ?></textarea></td>
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
					<td align="center"><img src="skin/sboard/img/tt_adfile.gif" width="57" height="15"></td>
					<td><input type=file name=imgup size=40></tr>
				<tr>
					<td></td>
					<td>php,php3,htm,html,js,exe,phtml,inc,jsp,asp,swf 등의<br>
실행파일은 업로드 할 수 없습니다.</td>
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
</form>
<script>
document.musimw.pass.focus();
</script>
