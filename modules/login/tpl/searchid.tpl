{include file="$skinDir/_header.tpl" title="아이디 찾기 - StreamUX"}
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
				<h1 class="title">아이디 찾기</h1>
				<span class="subtitle">SUX Board 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>
				<form action="login.php?action=searchid" name="f_searchid" method="post" onSubmit="return jsux.fn.searchid.checkForm(this);">
				<div class="box ui-edgebox-2px">
					<div class="leave-header">
						<img src="tpl/images/icon_01.gif" title="">						
						<span>회원그룹</span>
						<select name="member" id="ljsMember">
							<!-- templete -->
						</select>
						<span class="link-searchinfo">
							<a href="login.php?action=searchID">아이디</a> | <a href="login.php?action=searchPassword">비밀번호 찾기</a>	
						</span>
					</div>
					<div class="leave-body">
						<div class="panel-info">
							<ul>
								<li><span class="ui-label">이름</span><input type="text" name="user_name" maxlength="14" value=""></li>
								<li><span class="ui-label">E-Mail 주소</span><input type="text" name="user_email" maxlength="20"></li>
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
		{include file="$copyrightPath"}
	</div>
</div>
<div class="ui-panel-msg"></div>
<script type="text/javascript">
	var loginObj = loginObj || {};
	loginObj.memberList = {$documentData.group};
</script>
<script type="x-jquery-templete" id="ljsMember_tmpl">
	<option>{literal}${name}{/literal}</option>
</script>
{include file="$skinDir/_footer.tpl"}