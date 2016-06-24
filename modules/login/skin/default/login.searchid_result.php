<? include "lib.php"; ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>아이디 찾기</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" type="text/css" href="css/css.css">
</head>

<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td align="center" bgcolor="#EAEAEA">
<?
	$query="select ljs_memberid from $member_table where name='$check_name' and jumin1='$jumin1' and jumin2='$jumin2'";
	$result=mysql_query($query);

	if (mysql_num_rows($result) > 0) {
		$row=mysql_fetch_array($result);
		$memberid=$row[ljs_memberid];
?>	  			<table width="368"  border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td height="58" valign="top" style="background-image:url(images/search_bg_01.gif); background-repeat:repeat-x;"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td height="16" colspan="3"></td>
								</tr>
								<tr>
					<td width="8" align="left"></td>
									<td align="left"><img src="images/search_icon.gif" width="21" height="25"><img src="images/search_tt_id.gif" width="103" height="25"></td>
									<td align="right"><a href="mailto:<? echo $admin_email; ?>">관리자메일</a></td>
									<td width="20"></td>
								</tr>
						</table></td>
					</tr>
					<tr>
						<td height="170" align="center" bgcolor="#FFFFFF"><table width="90%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td height="9"></td>
								</tr>
								<tr>
									<td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
											<tr align="left">
												<td width="15"><img src="images/search_icon_01.gif" width="3" height="3"></td>
												<td>회원님의 아이디는 &quot;<b><? echo $memberid; ?></b>&quot; 입니다. </td>
											</tr>
						<tr>
							<td height="9" colspan="2"></td>
						</tr>
											<tr align="left">
												<td><img src="images/search_icon_01.gif" width="3" height="3"></td>
												<td>비밀번호를 잊어버렸을 경우 비밀번호 찾기를</td>
											</tr>
											<tr align="left">
												<td></td>
												<td>이용해 주시기 바랍니다. </td>
											</tr>
						 <tr>
							<td height="9" colspan="2"></td>
						</tr>
											<tr align="left">
												<td><img src="images/search_icon_01.gif" width="3" height="3"></td>
												<td>기타 문의사항은 관리자메일로 문의해</td>
										</tr>
											<tr align="left">
												<td>&nbsp;</td>
												<td> 주시기 바랍니다. </td>
											</tr>
									</table></td>
								</tr>
								<tr>
									<td height="15"></td>
								</tr>
						</table></td>
					</tr>
					<tr>
						<td height="38" valign="top" style="background-image:url(images/search_bg_02.gif); background-repeat:repeat-x;"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td height="12"></td>
								</tr>
								<tr>
									<td align="center"><table border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td><a href="javascript:self.close();"><img src="images/search_bt_close.gif" width="54" height="17"></a></td>
												<td width="10"></td>
												<td><a href="../board/lose_pass.php" target="_self"><img src="images/search_bt_pass.gif" width="101" height="17" border="0"></a></td>
											</tr>
									</table></td>
								</tr>
						</table></td>
					</tr>
			</table></td>
		</tr>
	</table>
<?
	} else {
		echo ("	<script>
					alert('입력하신 정보와 일치하는 아이디가 존재하지 않습니다! 다시 입력해주세요.')
					history.go(-1)
				</script>");
		exit;
	}
?>
</body>
</html>