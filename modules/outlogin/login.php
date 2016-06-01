<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<SCRIPT LANGUAGE="JavaScript">
<!--
function musimo_check(f)
{
memberid = f.memberid.value.length;
pass = f.pass.value.length;
if ( memberid < 1 ) {
		alert("아이디 입력 하세요.");
	f.memberid.focus();
	return (false);
}
if ( pass < 1 ) {
		alert("비밀번호를 입력 하세요.");
	f.pass.focus();
	return (false);
}
	return (true);
}

function lose_pass(){
	window.open("../board/lose_pass.php","_box","width=380, height=262, top=200, left=250,scrollbars=no");
}
// --></SCRIPT>
</head>

<?
if (!$HTTP_SESSION_VARS[ljs_memberid] || !$HTTP_SESSION_VARS[ljs_pass1])
{

?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<form action=../board/login_find.php?page=<? echo $page; ?> method=post  name=moosimo onSubmit="return musimo_check(this);">
	<tr>
		<td height="6"></td>
	</tr><?
$control_table=control_mbox;
$result=mysql_query("select name from $control_table order by id asc limit 0,1");
$rows=mysql_fetch_array($result);
$cm_name=$rows[name];
?>
	<tr>
		<td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="6"></td>
				<td width="19"><img src="../board/outlogin/img/outlogin_id.gif" width="19" height="14"></td>
				<td width="85"><input name="memberid" type="text" size="12" maxlength="12" style="width:85">
		<input name="member_table" type="hidden" value="<? echo $cm_name; ?>"></td>
				<td width="12" rowspan="3" align="left"></td>
				<td rowspan="3" align="left"><input name="imageField" type="image" src="../board/outlogin/img/outlogin_bt.gif" width="51" height="44" border="0"></td>
			</tr>
			<tr>
				<td height="2"></td>
		<td></td>
				<td></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><img src="../board/outlogin/img/outlogin_pw.gif" width="19" height="14"></td>
				<td><input name="pass" type="password" size="12" maxlength="12" style="width:85"></td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td height="11"></td>
	</tr>
	<tr>
		<td align="left"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="6"></td>
				<td align="left"><a href="javascript:lose_pass();"><img src="../board/outlogin/img/outlogin_search.gif" width="89" height="15"></a><a href="javascript:onMultiLink('menu84');"><img src="../board/outlogin/img/outlogin_member.gif" width="75" height="15"></a></td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td height="13"></td>
	</tr>
</form>
</table>
<?
}else {
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="6"></td>
	</tr>
	<tr>
		<td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="6"></td>
					<td width="44" align="left"><img src="../board/outlogin/img/outlogout_name.gif" width="25" height="14"></td>
					<td>: <?
echo $HTTP_SESSION_VARS[ljs_name];
echo "&nbsp;";
echo "님";
?></td>
					<td width="12" rowspan="5" align="left"></td>
					<td rowspan="5" align="left"><a href="../board/logout.php"><img src="../board/outlogin/img/outlogout_bt.gif" width="51" height="44" border="0"></a></td>
				</tr>
				<tr>
					<td></td>
					<td><img src="../board/outlogin/img/outlogout_point.gif" width="32" height="14"></td>
					<td>: <?
$result=mysql_query("select * from $member_table where ljs_memberid='$ljs_memberid' ");
$row=mysql_fetch_array($result);
$hit=$row[hit];
$point2=$row[point];
echo "<font color=red>".number_format($point2)."&nbsp;<b>P</b></font>";
?></td>
				</tr>
				<tr>
					<td></td>
					<td><img src="../board/outlogin/img/outlogout_hit.gif" width="44" height="14"></td>
					<td>:
					<?
echo $hit; 
echo "&nbsp;번째";
?></td>
				</tr>
		</table></td>
	</tr>
	<tr>
		<td height="11"></td>
	</tr>
	<tr>
		<td align="left"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="6"></td>
				<td align="left"><a href="javascript:onMultiLink('menu81');"><img src="../board/outlogin/img/outlogin_info.gif" width="89" height="15"></a></td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td height="13"></td>
	</tr>
</table>
<?
}
?>
<script>document.moosimo.memberid.focus();</script>
<body>
</body>
</html>
