<?
include "../other/login_top.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function musimsm_check(f)
{
admin_id = f.admin_id.value.length;
admin_pass = f.admin_pass.value.length;
if ( admin_id < 1 ) {
		alert("아이디 입력 하세요.");
	f.admin_id.focus();
	return (false);
}
if ( admin_pass < 1 ) {
		alert("비밀번호를 입력 하세요.");
	f.admin_pass.focus();
	return (false);
}
	return (true);
}
// --></SCRIPT>
<link href="../inc/smx_css.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="38"></td>
	</tr>
	<tr>
		<td align="center">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="60" align="center"><img src="m_skin/img/m_tt_admin.gif" width="292" height="60"></td>
	</tr>
	<tr>
		<td height="20"></td>
	</tr>
	<tr>
		<td align="center">
			<table width="292" border="0" cellspacing="0" cellpadding="0">
			<form action=admin2.php?fmenu=<? echo $fmenu; ?>&fsubmenu=<? echo $fsubmenu; ?> name=musimsm method=post onSubmit="return musimsm_check(this);">
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
														<td><img src="m_skin/img/m_tt_box_tt_03.gif" width="79" height="14"></td>
														<td align="right"><a href="#">아이디</a>/<a href="#">비번찾기</a></td>
													</tr>
											</table></td>
										</tr>
										<tr>
											<td height="6"></td>
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
																	<td align="left">아이디</td>
																	<td></td>
																	<td><INPUT type=text name=admin_id value='아이디 입력' size=12 maxlength=14 ></td>
																</tr>
																<tr>
																	<td height="6"></td>
																	<td></td>
																	<td></td>
																</tr>
																<tr>
																	<td align="left">비밀번호</td>
																	<td></td>
																	<td><input name=admin_pass type=password size="12" maxlength="14"></td>
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
		</td>
	</tr>
	<tr>
		<td height="20"></td>
	</tr>
	<tr>
		<td align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td height="1" colspan="5" bgcolor="#EAEAEA"></td>
			</tr>
			<tr>
				<td height="9" colspan="5"></td>
			</tr>
			<tr>
				<td width="3%" height="40"></td>
				<td width="47%" align="left" valign="top"><b>주의사항</b><br>
					비밀번호가 노출되지 않도록 세심한 주의를<br>기울여 주세요.</td>
				<td width="0%" bgcolor="#EAEAEA"></td>
				<td width="3%"></td>
				<td width="47%" align="left" valign="top"><b>서비스 이용안내</b><br>
					서비스를 이용하시려면 먼저 로그인을<br>해주세요.</td>
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
		</td>
	</tr>
</table>
<script>document.musimsm.admin_pass.focus();</script>
<?
include "../other/bottom.php";
?>