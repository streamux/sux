{assign var=groupData value=$documentData.group}
{assign var=contentData value=$documentData.contents}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="게시물 삭제 - StreamUX"}
<div class="container">		
	<div class="article-box ui-edgebox">	
		<div class="login">
			<h1 class="title">게시물 삭제 비밀번호 인증</h1>
			<span class="subtitle">SMX 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>

			<form action="board.php?board={$requestData.board}&board_grg={$requestData.board_grg}&id={$requestData.id}&action=recordDelete" method="post" name="f_board_delpass" onSubmit="return jsux.fn.delete.checkDocumentForm(this);">
			<div class="box ui-edgebox-2px">
				<div class="login-title">
					<img src="{$skinPathList.dir}/images/icon_01.gif" title="" alt="">			
					<span class="link-searchinfo">
						<a href="../login/login.php?action=searchid">아이디</a> | <a href="../login/login.php?action=searchpwd">비밀번호 찾기</a>
					</span>
				</div>
				<div class="login-body">
					<div class="panel-info">
						<ul>
							<li><span class="ui-label">이름</span>{$contentData.name}<input type="hidden" name="name" maxlength="14" value="{$contentData.name}"class="input-id"></li>
							<li><span class="ui-label">비밀번호</span><input type="password" name="pass" maxlength="20"class="input-pwd"></li>
						</ul>							
					</div>
					<div class="panel-btn">
						<ul>
							<li data-id="send">삭제</li>
							<li data-id="cancel">취소</li>
						</ul>							
					</div>			
				</div>																	
			</div>
			</form>
			<div class="panel-login-fail">
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
				</dl><dl>
					<dt>서비스 이용안내</dt>
					<dd>서비스를 이용하시려면 먼저 로그인을 해주세요.</dd>
				</dl>
			</div>					
		</div>			
	</div>		
</div>
{include file="$footerPath"}