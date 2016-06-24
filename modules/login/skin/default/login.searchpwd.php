<? include "lib.php"; ?>

<!DOCTYPE HTML>
<html>
<head>
<title>비밀번호 찾기</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" type="text/css" href="css/css.css">

<script type="text/javascript">

	function contentc_check(f) {

	memberid = f.memberid.value.length;

	if ( memberid < 1 ) {
			alert("이름을 입력 하세요.");
		f.memberid.focus();
		return (false);
	}

	var jumin_check = "234567892345";
	var jumin_total = f.jumin1.value + f.jumin2.value;
	var juminid = 0;

	if (jumin_total.length < 13){
		alert("잘못된 주민등록번호입니다.");
		f.jumin1.focus();
		return false;
	}

	for (var i=0; i<12; i++){
		var ch1=jumin_check.substring(i,i+1);
		var ch2=jumin_total.substring(i,i+1);
		juminid = juminid + ch1 * ch2;
	}

	var check_field = (11 - (juminid % 11)) % 10;

	if (check_field != jumin_total.substring(12,13)){
		alert("잘못된 주민등록번호입니다.");
		f.jumin1.value="";
		f.jumin2.value="";
			f.jumin1.focus();
		return false;
	} else if (jumin_total.substring(6,7) > 2 ||  jumin_total.substring(6,7) < 1){
		alert("잘못된 주민등록번호입니다.");
		f.jumin1.focus(); 
		return false;
	}
	return (true);
}

	function jmcheck() {
		var str = document.musimm.jumin1.value.length;
		if(str == 6) {			
			document.musimm.jumin2.focus();
		}
}
</script>
</head>

<body>
<form name="musimm" method="post" action="" onSubmit="return contentc_check(this);">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td align="center" bgcolor="#EAEAEA"><table width="368"  border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td height="58" valign="top" style="background-image:url(images/search_bg_01.gif); background-repeat:repeat-x;"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td height="16" colspan="3"></td>
								</tr>
								<tr>
					<td width="8" align="left"></td>
									<td align="left"><img src="images/search_icon.gif" width="21" height="25"><img src="images/search_tt_pass.gif" width="103" height="25"></td>
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
									<td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="BDBDBD">
							<tr align="left" bgcolor="#FFFFFF">
							<td colspan="2"><table border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="14"></td>
														<td><img src="images/search_icon_02.gif" width="3" height="5"></td>
														<td width="8"></td>
														<td><table border="0" cellspacing="0" cellpadding="0">
															<tr>
																<?
$member_table=control_mbox;
$result=mysql_query("select name from $member_table order by id asc limit 0,2");
$check_num = 1;
while($rows=mysql_fetch_array($result)){
$cm_name=$rows[name];
$lm_name=strtoupper($cm_name);
?>
																<td><? echo $lm_name; ?>&nbsp;회원</td>
																<td width="4"></td>
																<td><input name="member_table" type="radio" value="<? echo $cm_name; ?>" <? if($check_num == 1) echo "checked"; ?>></td>
																<td width="10"></td>
																<?
$check_num ++;
}
?>
															</tr>
														</table></td>
													</tr>
												</table></td>
						</tr>
											<tr align="left" bgcolor="#FFFFFF">
												<td width="116" height="26"><table border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="14"></td>
															<td><img src="images/search_icon_02.gif" width="3" height="5"></td>
															<td width="8"></td>
															<td>아이디</td>
														</tr>
												</table></td>
												<td>&nbsp;<input name="memberid" type="text" size="8" maxlength="12"></td>
											</tr>
											<tr align="left" bgcolor="#FFFFFF">
												<td height="26"><table border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="14"></td>
															<td><img src="images/search_icon_02.gif" width="3" height="5"></td>
															<td width="8"></td>
															<td>주민등록번호</td>
														</tr>
												</table></td>
												<td>&nbsp;<input name="jumin1" type="text" size="8" OnKeyUp="jmcheck();" maxlength="6"> 
													- 
													<input name="jumin2" type="text" size="8" maxlength="7"></td>
											</tr>
									</table></td>
								</tr>
								<tr>
									<td height="16"></td>
								</tr>
								<tr>
									<td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td width="15" align="left"><img src="images/search_icon_01.gif" width="3" height="3"></td>
												<td align="left">위의 사항을 입력해 주시면 Password를 찾아드립니다.</td>
											</tr>
											<tr>
												<td align="left"><img src="images/search_icon_01.gif" width="3" height="3"></td>
												<td align="left">기타 궁금한 사항이나 질문사항은 관리자메일로</td>
											</tr>
											<tr>
												<td align="left"></td>
												<td align="left">  문의하시기 바랍니다. </td>
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
												<td><input name="imageField" type="image" src="images/search_bt_confirm.gif" width="54" height="17" border="0"></td>
												<td width="10"></td>
												<td><a href="../board/lose_id.php" target="_self"><img src="images/search_bt_id.gif" width="65" height="17" border="0"></a></td>
											</tr>
									</table></td>
								</tr>
						</table></td>
					</tr>
			</table></td>
		</tr>
	</table>
</form>
<script> document.musimm.name.focus(); </script>

</body>
</html>