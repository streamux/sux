<? include "lib.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>비밀번호 찾기</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" type="text/css" href="css/css.css">
<SCRIPT LANGUAGE="JavaScript">
<!--
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

if(jumin_total.length < 13){
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
}else if (jumin_total.substring(6,7) > 2 ||  jumin_total.substring(6,7) < 1){
	alert("잘못된 주민등록번호입니다.");
	f.jumin1.focus(); 
	return false;
}
	return (true);
}

function jmcheck() {
	var str = document.musimm.jumin1.value.length;
	if(str == 6)
		document.musimm.jumin2.focus();
}
// --></SCRIPT>
</head>

<body>
<?
if(!$memberid){
?>
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
<?
}else{
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center" bgcolor="#EAEAEA"><?
$query="select * from $member_table where ljs_memberid='$memberid' and jumin1='$jumin1' and jumin2='$jumin2'";
$result=mysql_query($query);
if(mysql_num_rows($result) > 0) {
$row=mysql_fetch_array($result);
$memberid=$row[ljs_memberid];
$name=$row[name];

// 임시비밀번호 생성 시작
for($i=1; $i<=8; $i++){ 
$numbers.=rand(0,9);
}
$password=substr(md5($numbers),0,8);
$pwd1=substr(md5($password),0,8);

$dbup = "update $member_table set ljs_pass1='$pwd1', ljs_pass2='$pwd1' where ljs_memberid='$memberid'";
$result1=mysql_query($dbup);
$email=$row[email];
$subject = "[스트림엠엑스]문의하신 내용의 답변입니다.";
$additional_headers = "From: $admin_name <$admin_email>\n";
$additional_headers .= "Reply-To : email@email.com\n";
$additional_headers .= "Content-Type: text/html;charset=EUC-KR\n";
$contents = "
<HTML>
<head>
<title>스트림엠엑스</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=euc-kr\">
<style type='text/css'>
<!--
p,br,body,table,td,input,form,textarea { font-family: 돋움; color: #000000; font-size: 9pt; }
img { border: 0px; }
//-->
</style>
</head>
<BODY>
<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
	<tr>
		<td align=\"center\">
<table  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
	<tr>
		<td><a href=\"$yourhome\"><img src=\"$yourhome/board/mail/img/logo.gif\" width=\"211\" height=\"70\"></a></td>
	</tr>
	<tr>
		<td><img src=\"$yourhome/board/mail/img/box_01.gif\" width=\"626\" height=\"6\"></td>
	</tr>
	<tr>
		<td align=\"center\" style=\"background-image: url($yourhome/board/mail/img/box_02.gif); background-repeat:repeat-y;\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
			<tr>
				<td><img src=\"$yourhome/board/mail/img/search_banner.gif\" width=\"614\" height=\"143\" border=\"0\" usemap=\"#Map\"></td>
			</tr>
			<tr>
				<td height=\"18\">&nbsp;</td>
			</tr>
			<tr>
				<td><b>$name</b> 회원님 <b><font color=\"#F28000\">스트림엠엑스</font></b>를 이용해 주셔서 감사합니다.<br>
					<b>STREAMMX.COM</b>을 통해 최선의 서비스를 제공해 드리도록 노력하겠습니다.</td>
			</tr>
			<tr>
				<td height=\"18\">&nbsp;</td>
			</tr>
			<tr>
				<td><img src=\"$yourhome/board/mail/img/icon_01.gif\" width=\"14\" height=\"13\" align=\"absmiddle\"> <b><font color=\"#2979BD\">등록된 회원정보</font></b></td>
			</tr>
			<tr>
				<td height=\"15\">&nbsp;</td>
			</tr>
			<tr>
				<td height=\"18\" align=\"left\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
						<td><img src=\"$yourhome/board/mail/img/contants_box_01.gif\" width=\"580\" height=\"8\"></td>
					</tr>
					<tr>
						<td style=\"background-image:url($yourhome/board/mail/img/contants_box_02.gif); background-repeat:repeat-y;\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
								<td width=\"20\">&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
									<tr>
										<td><b>이름</b></td>
										<td>&nbsp;</td>
										<td>:</td>
										<td>&nbsp;</td>
					<td>$name</td>
									</tr>
									<tr>
										<td><b>아이디</b></td>
										<td>&nbsp;</td>
										<td>:</td>
										<td>&nbsp;</td>
										<td>$memberid</td>
									</tr>
									<tr>
										<td><b>임시비밀번호</b></td>
										<td>&nbsp;</td>
										<td>:</td>
										<td>&nbsp;</td>
										<td>$password</td>
									</tr>
								</table></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
						</table></td>
					</tr>
					<tr>
						<td><img src=\"$yourhome/board/mail/img/contants_box_03.gif\" width=\"580\" height=\"8\"></td>
					</tr>
				</table></td>
			</tr>
			<tr>
				<td height=\"10\">&nbsp;</td>
			</tr>
			<tr>
				<td><img src=\"$yourhome/board/mail/img/icon_02.gif\" width=\"3\" height=\"5\" align=\"absmiddle\"> 가입한 회원정보 중 수정할 내용이 있으면<font color=\"#2979BD\"><a href=\"$yourhome/board/info_bg.php?navi01=회원정보&navi02=회원정보수정&fmenu=8&fsubmenu=1&pageviewname=memberinfo\">[회원정보수정]</a></font> 메뉴를 이용해 주세요.</td>
			</tr>
		<tr>
				<td><img src=\"$yourhome/board/mail/img/icon_02.gif\" width=\"3\" height=\"5\" align=\"absmiddle\"> <font color=\"#FF0000\">본 메일은 확인 후 바로 삭제해주세요!!!</font></td>
			</tr>
			<tr>
				<td height=\"28\">&nbsp;</td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td><img src=\"$yourhome/board/mail/img/box_03.gif\" width=\"626\" height=\"6\"></td>
	</tr>
</table>
		</td>
	</tr>
</table>
<map name=\"Map\">
	<area shape=\"rect\" coords=\"177,6,234,27\" href=\"$yourhome/01_intro/menu_011.php?navi01=회사소개&navi02=인사말&fmenu=1&fsubmenu=1&pageviewname=intro\">
	<area shape=\"rect\" coords=\"238,6,292,27\" href=\"$yourhome/02_recture/menu_021.php?navi01=강의안내&navi02=강의시간표&fmenu=2&fsubmenu=1&pageviewname=recture\">
	<area shape=\"rect\" coords=\"299,6,353,27\" href=\"$yourhome/03_entrance/menu_031.php?navi01=입시정보&navi02=입시일정&fmenu=3&fsubmenu=1&pageviewname=entrance\">
	<area shape=\"rect\" coords=\"358,6,411,27\"   href=\"$yourhome/04_training/menu_041.php?navi01=실기정보&navi02=실기고사구분&fmenu=4&fsubmenu=1&pageviewname=training\">
	<area shape=\"rect\" coords=\"416,6,497,27\" href=\"$yourhome/05_apointment/menu_051.php?navi01=편입및임용실기&navi02=편입실기&fmenu=5&fsubmenu=1&pageviewname=apointment\">
	<area shape=\"rect\" coords=\"503,6,550,27\" href=\"$yourhome/board/board_list.php?board=b_consultation&board_grg=b_consultation_grg&navi01=상담실&navi02=진학상담&fmenu=6&fsubmenu=1&pageviewname=consultation\">
	<area shape=\"rect\" coords=\"553,6,604,27\" href=\"$yourhome/board/board_list.php?board=b_notice&board_grg=b_notice_grg&navi01=커뮤니티&navi02=공지사항&fmenu=7&fsubmenu=1&pageviewname=community\">
</map>
</BODY>
</HTML>
";
mail($admin_email, $subject, $contents, $additional_headers);
mail($email, $subject, $contents, $additional_headers);
mysql_close();
?>
			<table width="368"  border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td height="58" valign="top" style="background-image:url(images/search_bg_01.gif); background-repeat:repeat-x;"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td height="16" colspan="4"></td>
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
									<td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
										<tr align="left">
											<td width="15"><img src="images/search_icon_01.gif" width="3" height="3"></td>
											<td>회원님께서 가입시 등록한 이메일주소로 비밀번호가</td>
										</tr>
					<tr align="left">
											<td width="15">&nbsp;</td>
											<td>발송되었습니다.</td>
										</tr>
						 <tr>
								<td height="9" colspan="2"></td>
						</tr>
										<tr align="left">
											<td><img src="images/search_icon_01.gif" width="3" height="3"></td>
											<td>발송된 메일주소 : <b><? echo $email; ?></b></td>
										</tr>
										<tr align="left">
											<td>&nbsp;</td>
											<td>만약 기존메일이 사용 할 수 없는 상태이시면  </td>
										</tr>
										<tr align="left">
											<td>&nbsp;</td>
											<td> 관리자메일로 문의해 주시기 바랍니다. </td>
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
												<td><a href="../board/lose_id.php" target="_self"><img src="images/search_bt_id.gif" width="65" height="17" border="0"></a></td>
										</tr>
									</table></td>
								</tr>
						</table></td>
					</tr>
		</table></td></tr>
</table>
<?
}else{
echo ("
<script>
alert('입력하신 정보와 일치하는 아이디가 존재하지 않습니다! 다시 입력해주세요.')
history.go(-1)
</script>
");
exit;
}
}
?>
</body>
</html>

</body>
</html>
