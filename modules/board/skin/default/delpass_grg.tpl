<div class="container">
	<div class="article-box ui-edgebox">			
		<h2 class="blind">댓글삭제 비밀번호 인증</h2>		
		<div class="login">
			<span class="title">댓글삭제 비밀번호 인증</span>
			<span class="subtitle">SUX 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>

			<form action="board.php?board={$requestData.board}&board_grg={$requestData.board_grg}&id={$requestData.id}&grgid={$requestData.grgid}&igroup={$requestData.igroup}&passover={$requestData.passover}&action=record_deletetailcomment" method="post" name="f_board_tail_delpass" onSubmit="return jsux.fn.boardDelpass.checkDocumentForm(this);">			
			<div class="box ui-edgebox-2px">
				<div class="login-title">
					<img src="{$skinDir}/images/icon_01.gif" title="">			
					<span class="link-searchinfo">
						<a href="../login/login.php?action=searchid">아이디</a> | <a href="../login/login.php?action=searchpwd">비밀번호 찾기</a>
					</span>
				</div>
				<div class="login-body">
					<div class="panel-info">
						<ul>
							<li><span class="ui-label">이름</span>{$documentData.name}<input type="hidden" name="name" maxlength="14" value="{$documentData.name}"class="input-id"></li>
							<li><span class="ui-label"><label for="pass">비밀번호</label></span><input type="password" name="pass" id="pass" maxlength="20"class="input-pwd"></li>
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

<script type="text/javascript" src="{$skinDir}/js/board.delpass.js"></script>