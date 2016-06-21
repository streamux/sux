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
	<link rel="stylesheet" type="text/css" href="skin/default/css/login.css">
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
			<h2 class="blind">회원 로그인</h2>		
			<div class="login">
				<span class="title">회원 로그인</span>
				<span class="subtitle">SMX 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>

				<form action="login.pass.php" name="musimsm" method="post" onSubmit="return jsux.fn.checkForm(this);">
				<div class="box ui-edgebox-2px">
					<div class="login-title">
						<img src="skin/default/images/icon_01.gif" alt="">						
						<span>회원그룹</span>
						<select name="ljs_member" id="ljsMember">
							<!-- templete -->
						</select>
						<span class="link-searchinfo">로그인 아이디 | 비번찾기</span>
					</div>
					<div class="login-body">
						<table summary="로그인을 할 수 있습니다.">
							<caption class="hide">회원 로그인</caption>
							<tbody>
								<tr>
									<td>아이디</td>
									<td><input type="text" name="memberid" maxlength="14" value=""class="input-id"></td>
									<td rowspan="2"><input type="image" name="imagefield" src="skin/default/images/btn_login.gif" alt="로그인버튼" class="login-btn"></td>
								</tr>
								<tr>
									<td>비밀번호</td>
									<td><input type="password" name="pass" maxlength="20"class="input-pwd"></td>
								</tr>
							</tbody>
						</table>						
					</div>																	
				</div>
				<form>

				<div class="notice">
					<dl>
						<dt>주의사항</dt>
						<dd>비밀번호가 노출되지 않도록 세심한 주의를 기울여 주세요.</dd>
					</dl>
					<dl>
						<dt>서비스 이용안내</dt>
						<dd>서비스를 이용하시려면 먼저 로그인을 해주세요.</dd>
					</dl>
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
	<option>${label}</option>
</script>

<script type="text/javascript" src="skin/default/js/login.js"></script>
