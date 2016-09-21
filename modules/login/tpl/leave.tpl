{include file="$headerPath"}
<div class="wrapper">
	<div class="header">
		<div class="util"></div>
		<h1 class="logo">
			<img class="logo" src="tpl/images/logo.png" alt="streamxux">	
		</h1>	
	</div>
	<div class="container">		
		<div class="article-box ui-edgebox">			
			<h2 class="blind">회원 탈퇴</h2>		
			<div class="login">
				<span class="title">회원 탈퇴</span>
				<span class="subtitle">SMX 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>

				<form name="loginleave">
				<div class="box ui-edgebox-2px">
					<div class="login-title">
						<img src="tpl/images/icon_01.gif" alt="">						
						<span>비밀번호 확인</span>
					</div>
					<div class="leave-body">
						<div class="panel-info">
							<ul>
								<li><input type="hidden" name="member" value="{$documentData.sessions.ljs_member}"><span class="ui-label">아이디</span><span>{$documentData.sessions.ljs_memberid}</span><input type="hidden" name="memberid" value="{$documentData.sessions.ljs_memberid}"></li>
								<li><span class="ui-label">비밀번호</span><input type="password" name="pass" maxlength="20"class="input-pwd"></li>
							</ul>							
						</div>
						<div class="panel-btn">
							<ul>
								<li data-id="send">보내기</li>
								<li data-id="cancel">취소</li>
							</ul>
						</div>				
					</div>																	
				</div>
				</form>
				<div class="panel-fail">
					<ul>
						<li><span>아이디와 비밀번호가 일치하지 않습니다.</span></li>
						<li><span>아이디와 비밀번호를 정확하게 입력해주세요.</span></li>
						<li>만일 회원가입을 하지 않고, 로그인을 하셨다면 회원가입을 먼저 해주세요.</li>
					</ul>
				</div>
				<div class="panel-notice">
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
		Copyright @ STREAMUX Corp
	</div>
</div>
<div class="ui-panel-msg"></div>

<script type="x-jquery-templete" id="ljsMember_tmpl">
	<option>{literal}${label}{/literal}</option>
</script>

{include file="$footerPath"}
