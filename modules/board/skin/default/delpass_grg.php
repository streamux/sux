<link rel="stylesheet" type="text/css" href="<? echo ${skin_dir}; ?>/css/common.css">
<link rel="stylesheet" type="text/css" href="<? echo ${skin_dir}; ?>/css/layout.css">
<script src="../../common/js/jquery.min.js"></script>
<script src="../../common/js/jsux-1.0.0.min.js"></script>
<script src="../../common/js/jsux.min.js"></script>

<div class="container">		
	<div class="article-box ui-edgebox">			
		<h2 class="blind">댓글삭제 비밀번호 인증</h2>		
		<div class="login">
			<span class="title">댓글삭제 비밀번호 인증</span>
			<span class="subtitle">SUX 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>

			<form action="board.php?board_grg=<? echo $board_grg; ?>&id=<? echo $id; ?>&board=<? echo $board; ?>&grgid=<? echo $grgid; ?>&igroup=<? echo $igroup; ?>&passover=<? echo $passover; ?>&action=record_deletecomment" method="post" name="musimd" onSubmit="return jsux.fn.checkForm(this);">			
			<div class="box ui-edgebox-2px">
				<div class="login-title">
					<img src="<? echo ${skin_dir}; ?>/images/icon_01.gif" title="">			
					<span class="link-searchinfo">
						<a href="../login/login.php?action=searchid">아이디</a> | <a href="../login/login.php?action=searchpwd">비밀번호 찾기</a>
					</span>
				</div>
				<div class="login-body">
					<div class="panel-info">
						<ul>
							<li><span class="ui-label">이름</span><? echo $m_name; ?><input type="hidden" name="m_name" maxlength="14" value="<? echo $m_name; ?>"class="input-id"></li>
							<li><span class="ui-label">비밀번호</span><input type="password" name="pwd" maxlength="20"class="input-pwd"></li>
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

<script type="text/javascript" src="<? echo ${skin_dir}; ?>/js/board.delpass.js"></script>