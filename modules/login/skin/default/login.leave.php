<!DOCTYPE html>
<html>
<head>
	<title>로그인</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=2.0">
	<script src="../../common/js/jquery.min.js"></script>
	<script src="../../common/js/jquery.tmpl.min.js"></script>
	<script src="../../common/js/jsux-1.0.0.min.js"></script>
	<script src="../../common/js/jsux.min.js"></script>
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
			<h2 class="blind">회원 탈퇴</h2>		
			<div class="login">
				<span class="title">회원 탈퇴</span>
				<span class="subtitle">SMX 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>

				<form action="../member/member.del.delete.php" name="musimsm" method="post" onSubmit="return jsux.fn.checkForm(this);">
				<div class="box ui-edgebox-2px">
					<div class="login-title">
						<img src="skin/default/images/icon_01.gif" alt="">						
						<span>비밀번호 확인</span>
					</div>
					<div class="login-body">
						<div class="panel-info">
							<ul>
								<li><input type="hidden" name="member" value="<? echo ${member}; ?>"><span class="ui-label">아이디</span><span><? echo ${memberid}; ?></span><input type="hidden" name="memberid" value="<? echo ${memberid}; ?>"></li>
								<li><span class="ui-label">비밀번호</span><input type="password" name="pass" maxlength="20"class="input-pwd"></li>
							</ul>							
						</div><div class="panel-btn">
							<input type="image" name="imagefield" src="skin/default/images/btn_login.gif" alt="로그인버튼" class="login-btn">
						</div>					
					</div>																	
				</div>
				<form>
				<div class="panel-login-fail">
					<ul>
						<li><span>아이디와 비밀번호가 일치하지 않습니다.</span></li>
						<li><span>아이디와 비밀번호를 정확하게 입력해주세요.</span></li>
						<li>만일 회원가입을 하지 않고, 로그인을 하셨다면 회원가입을 먼저 해주세요.</li>
					</ul>
				</div>
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
