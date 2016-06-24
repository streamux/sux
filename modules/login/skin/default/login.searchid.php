<? include "lib.php"; ?>

<!DOCTYPE">
<html>
<head>
	<title>아이디 찾기</title>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
	<link rel="stylesheet" type="text/css" href="css/css.css">
</head>

<body>


<!DOCTYPE html>
<html>
<head>
	<title>SUX 어드민</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=2.0">
	<script src="../../common/js/jquery.min.js"></script>
	<script src="../../common/js/jquery.tmpl.min.js"></script>
	<script src="../../common/js/jsux-1.0.0.min.js"></script>
	<script src="../../common/js/jsux.min.js"></script>
	<script type="text/javascript">
		var loginObj = loginObj || {};
		loginObj.memberList = <? echo ${strJson}; ?>;
	</script>
	<!--[if (gte IE 6)&(lte IE 8)]>
	  <script type="text/javascript" src="../../common/js/selectivizr-min.js"></script>
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="skin/default/css/common.css">
	<link rel="stylesheet" type="text/css" href="skin/default/css/login.search.css">
</head>
<body>
<div id="wrap">
	<div class="header">
		<div class="util"></div>
		<div class="gnb-box">
			<div class="logo">
				<img class="logo" src="skin/default/images/logo.png" alt="streamxux 로고">	
			</div>			
			<div class="gnb">
				
			</div>
		</div>	
	</div>
	<div class="container">		
		<div class="article-box ui-edgebox">			
			<h2 class="blind">아이디 찾기</h2>		
			<div class="login">
				<span class="title">아이디 찾기</span>
				<span class="subtitle">SUX Board 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>

				<form action="login.pass.php" name="musimsm" method="post" onSubmit="return jsux.fn.checkForm(this);">
				<div class="box ui-edgebox-2px">
					<div class="login-title">
						<img src="skin/default/images/icon_01.gif" title="">						
						<span>회원그룹</span>
						<select name="member" id="ljsMember">
							<!-- templete -->
						</select>
						<span class="link-searchinfo">
							<a href="login.php?action=searchId">아이디</a> | <a href="login.php?action=searchPwd">비밀번호 찾기</a>	
						</span>
					</div>
					<div class="login-body">
						<div class="panel-info">
							<ul>
								<li><span class="ui-label">이름</span><input type="text" name="check_name" maxlength="14" value=""></li>
								<li><span class="ui-label">E-Mail 주소</span><input type="text" name="check_email" maxlength="20"></li>
							</ul>				
						</div>
						<div class="panel-btn">
							<ul>
								<li><span>보내기</span></li>
								<li><span>취소</span></li>
							</ul>
							
							
						</div>
					</div>																	
				</div>
				<form>
				<div class="panel-notice">
					<ul>
						<li><span>위 사항을 입력해 주세요.</span></li>
						<li>기타 궁금한 사항이나 질문은 Q&amp;A 게시판을 이용해 주세요.</li>
					</ul>
				</div>		
			</div>			
		</div>		
	</div>
	<div class="footer">
		@StreamUX Corp
	</div>
</div>
<div class="ui-panel-msg"></div>

<script type="x-jquery-templete" id="ljsMember_tmpl">
	<option>${name}</option>
</script>

<script type="text/javascript" src="skin/default/js/login.searchid.js"></script>




<form name="musimm" method="post" action="" onSubmit="return contentc_check(this);">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td align="center" bgcolor="#EAEAEA"><table width="368"  border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td height="58" valign="top" style="background-image:url(images/search_bg_01.gif); background-repeat:repeat-x;"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td height="16" colspan="4"></td>
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
															<td>이름</td>
														</tr>
												</table></td>
												<td>&nbsp;<input name="check_name" type="text" size="8" maxlength="12"></td>
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
												<td align="left">위의 사항을 입력해 주시면 ID를 찾아드립니다.</td>
											</tr>
											<tr>
												<td align="left"><img src="images/search_icon_01.gif" width="3" height="3"></td>
												<td align="left">기타 궁금한 사항이나 질문사항은 관리자메일로</td>
											</tr>
											<tr>
												<td align="left"></td>
												<td align="left"> 문의하시기 바랍니다. </td>
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
												<td><a href="../board/lose_pass.php" target="_self"><img src="skin/default/images/search_bt_pass.gif" width="101" height="17" border="0"></a></td>
											</tr>
									</table></td>
								</tr>
						</table></td>
					</tr>
			</table></td>
		</tr>
	</table>
</form>

<script type="text/javascript">

function contentc_check(f) {

	names = f.check_name.value.length;

	if ( names < 1 ) {
			alert("이름을 입력 하세요.");
		f.check_name.focus();
		return (false);
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

<script> document.musimm.name.focus(); </script>
</body>
</html>