{include file="$skinDir/_header.tpl" title="비밀번호 찾기 결과 - StreamUX"}
<div class="wrapper">
	<div class="header">
		<div class="util"></div>
		<h1 class="logo">
			<img src="tpl/images/logo.png" alt="streamxux">
		</h1>
	</div>
	<div class="container">		
		<div class="article-box ui-edgebox">	
			<div class="login">
				<h1 class="title">비밀번호 찾기 결과</h1>
				<span class="subtitle">SUX Board 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>
				
				<div class="box ui-edgebox-2px">
					<div class="leave-header">
						<img src="tpl/images/icon_01.gif" title="">						
						<span>조회 결과</span>
						<span class="link-searchinfo">
							<a href="login.php?action=searchid">아이디</a> | <a href="login.php?action=searchpwd">비밀번호 찾기</a>	
						</span>
					</div>
					<div class="leave-body">
						<div class="panel-info-result">
							<ul>
								<li>
									{$documentData.user_name}님의 이메일 주소 '<span>{$documentData.user_email}</span>' (으)로 비밀번호가 발송되었습니다.
								</li>
							</ul>				
						</div>
						<div class="panel-btn">
							<ul>
								<li data-id="confirm">확인</li>
							</ul>							
						</div>
					</div>																	
				</div>
				<div class="panel-notice">
					<ul>
						<li>기타 궁금한 사항이나 질문은 Q&amp;A 게시판을 이용해 주세요.</li>
					</ul>
				</div>		
			</div>			
		</div>		
	</div>
	<div class="footer">
		{include file="$copyrightPath"}
	</div>
</div>
<div class="ui-panel-msg"></div>
{include file="$skinDir/_footer.tpl"}
