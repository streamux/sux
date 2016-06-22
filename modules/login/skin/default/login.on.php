<!DOCTYPE html>
<html>
<head>
	<title>SUX 어드민</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=2.0">
	<script src="../../common/js/jquery.min.js"></script>
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
				<img class="logo" src="tpl/images/logo.png" alt="streamxux 로고">	
			</div>			
			<div class="gnb">
				
			</div>
		</div>	
	</div>
	<div class="container">		
		<div class="article-box ui-edgebox">			
			<h2 class="blind">회원정보</h2>		
			<div class="login">
				<span class="title">회원정보</span>
				<span class="subtitle">SMX 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>
				<div class="box ui-edgebox-2px">
					<div class="login-title">
						<img src="tpl/images/icon_01.gif" alt="">
						<span>회원정보수정 | 회원탈퇴</span>
					</div>
					<div class="login-body">
						<div class="panel-info">
							<ul>
								<li><span class="ui-label">이름</span><span class="ui-value">'<? echo ${ljs_name}; ?></span>' 님</li>
								<li><span class="ui-label">적립포인트</span><span class="ui-value">'<? echo ${mypoint}; ?></span>' 포인트</li>
								<li><span class="ui-label">방문횟수</span><span class="ui-value">'<? echo ${hit}; ?></span>'번째 방문</li>
							</ul>
						</div><div class="panel-btn">
							<a href="logout.php"><img src="skin/default/images/m_bt_out.gif"></a>
						</div>
					</div>																	
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

<script type="text/javascript" src="./tpl/js/login.js"></script>
