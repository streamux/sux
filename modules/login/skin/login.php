<? include "../other/login_top.php"; ?>
<? include "lib.php"; ?>

<SCRIPT LANGUAGE="JavaScript">
<!--
function musimm_check(f)
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
// --></SCRIPT>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="60" align="center">
<?
if (!$HTTP_SESSION_VARS[ljs_memberid] || !$HTTP_SESSION_VARS[ljs_pass1])
{
?><img src="m_skin/img/m_tt_login.gif" width="292" height="60"></td>
<?
}else {
?><img src="m_skin/img/m_tt_info.gif" width="292" height="60"></td>
<?
}
?></tr>
	<tr>
		<td height="20"></td>
	</tr>
	<tr>
		<td align="center">
<?
if (!$HTTP_SESSION_VARS[ljs_memberid] || !$HTTP_SESSION_VARS[ljs_pass1])
{
?><table width="292" border="0" cellspacing="0" cellpadding="0">
		<form action=login_find.php?page=<? echo $page; ?> method=post  name=moosim onSubmit="return musimm_check(this);">
			<tr>
				<td colspan="5"><img src="m_skin/img/m_tt_box_01.gif" width="292" height="14"></td>
			</tr>
			<tr>
				<td width="292"><table width="292" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="3" bgcolor="#DEDFDE"></td>
						<td width="9"></td>
						<td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td width="16"><img src="m_skin/img/icon_01.gif" width="16" height="14"></td>
										<td><img src="m_skin/img/m_tt_box_tt_01.gif" width="79" height="14"></td>
										<td align="right"><a href='stipulation.php?fmenu=<? echo $fmenu; ?>&fsubmenu=<? echo $fsubmenu; ?>'>회원가입</a> l 아이디</td>
									</tr>
								</table></td>
							</tr>
							<tr>
								<td height="8"></td>
							</tr>
							<tr>
								<td height="1" background="m_skin/img/m_pointline.gif"></td>
							</tr>
							<tr>
								<td height="6"></td>
							</tr>
							<tr>
								<td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
						 <tr>
											<td width="5"></td>
											<td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="53" height="7"></td>
														<td width="10"></td>
														<td></td>
													</tr>
													<tr>
														<td align="right">아이디</td>
														<td></td>
														<td><INPUT type=text name=memberid size=8 maxlength=10 value="<? echo $ljs_memberid; ?>"></td>
													</tr>
													<tr>
														<td height="6"></td>
														<td></td>
														<td></td>
													</tr>
													<tr>
														<td align="right">비밀번호</td>
														<td></td>
														<td><INPUT type=password name=pass size=7 maxlength=10></td>
													</tr>
													<tr>
														<td height="8"></td>
														<td></td>
														<td></td>
													</tr>
											</table></td>
											<td width="61"><input name="imageField" type="image" src="m_skin/img/m_bt_login.gif" width="61" height="57" border="0"></td>
										</tr>
									</table></td>
							</tr>
						</table></td>
						<td width="9"></td>
						<td width="3" bgcolor="#DEDFDE"></td>
					</tr>
				</table></td>
			</tr>
			<tr>
				<td colspan="5"><img src="m_skin/img/m_tt_box_02.gif" width="292" height="14"></td>
			</tr>
		</form>
		</table>
<?
}else {
?><table width="292" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td colspan="5"><img src="m_skin/img/m_tt_box_01.gif" width="292" height="14"></td>
				</tr>
				<tr>
					<td width="292"><table width="292" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="3" bgcolor="#DEDFDE"></td>
								<td width="9"></td>
								<td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="16"><img src="m_skin/img/icon_01.gif" width="16" height="14"></td>
														<td align="left"><img src="m_skin/img/m_tt_box_tt_02.gif" width="79" height="14"></td>
														<td align="right">정보변경 l 회원탈퇴 </td>
													</tr>
											</table></td>
										</tr>
										<tr>
											<td height="8"></td>
										</tr>
										<tr>
											<td height="1" background="m_skin/img/m_pointline.gif"></td>
										</tr>
										<tr>
											<td height="6"></td>
										</tr>
										<tr>
											<td><table width="266"  border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20"></td>
														<td width="185" align="left"><table  border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="70" height="7"></td>
																	<td width="10"></td>
																	<td width="95"></td>
																</tr>
																<tr>
																	<td height="25" align="left">이름</td>
																	<td>:</td>
																	<td><?
echo $HTTP_SESSION_VARS[ljs_name];
echo "&nbsp;";
echo "님";
?></td>
																</tr>
																<tr>
																	<td height="1" bgcolor="#D3D3D3"></td>
																	<td colspan="2" bgcolor="#EFEFEF"></td>
																</tr>
																<tr>
																	<td height="25" align="left">적립금</td>
																	<td align="left">:</td>
																	<td><?
$result=mysql_query("select * from $member where ljs_memberid='$ljs_memberid' ");
$row=mysql_fetch_array($result);
$hit=$row[hit];
$point2=$row[point];
echo "<font color=red>적립금 : ".number_format($point2)."&nbsp;원</font><br>";
?></td>
																</tr>
																<tr>
																	<td height="1" bgcolor="#D3D3D3"></td>
																	<td colspan="2" bgcolor="#EFEFEF"></td>
																</tr>
																<tr>
																	<td height="25" align="left">방문횟수</td>
																	<td>:</td>
																	<td><?
echo $hit; 
echo "번째 방문";
?></td>
																</tr>
																<tr>
																	<td height="1" align="right" bgcolor="#D3D3D3"></td>
																	<td colspan="2" bgcolor="#EFEFEF"></td>
																</tr>
														</table></td>
														<td width="61"><a href='logout.php'><img src="m_skin/img/m_bt_out.gif" width="61" height="57" border="0"></a></td>
													</tr>
											</table></td>
										</tr>
								</table></td>
								<td width="9"></td>
								<td width="3" bgcolor="#DEDFDE"></td>
							</tr>
					</table></td>
				</tr>
				<tr>
					<td colspan="5"><img src="m_skin/img/m_tt_box_02.gif" width="292" height="14"></td>
				</tr>
			</table>
<?
}
?></td>
	</tr>
	<tr>
		<td height="25"></td>
	</tr>
	<tr>
		<td align="center"><table width="90%"  border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td height="1" colspan="5" bgcolor="#EAEAEA"></td>
			</tr>
			<tr>
				<td height="9" colspan="5"></td>
			</tr>
			<tr>
				<td width="3%"></td>
				<td width="47%" align="left" valign="top">          주의사항<br>
					비밀번호가 노출되지 않도록 세심한 주의를<br>
					기울여 주세요. </td>
				<td width="1" height="54" bgcolor="#EAEAEA"></td>
				<td width="3%"></td>
				<td width="47%" align="left" valign="top">          서비스 이용안내<br>
					서비스를 이용하시려면 먼저 로그인을<br>
					해주세요. <a href="#">회원가입 바로가기</a> </td>
			</tr>
			<tr>
				<td height="9" colspan="5"></td>
			</tr>
			<tr>
				<td height="1" colspan="5" bgcolor="#EAEAEA"></td>
			</tr>
		</table></td>
	</tr>
</table>
<? include "../other/bottom.php"; ?>
