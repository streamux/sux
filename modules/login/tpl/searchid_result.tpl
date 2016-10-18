{include file="$skinDir/_header.tpl" title="아이디 찾기 결과 - StreamUX"}
<div class="article-box ui-edgebox">
	<div class="login">
		<h1 class="title">아이디 찾기 결과</h1>
		<span class="subtitle">SUX Board 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>

		<div class="box ui-edgebox-2px">
			<div class="leave-header">
				<img src="tpl/images/icon_01.gif" title="">						
				<span class="ui-subtitle">조회 결과</span>
				<span class="link-searchinfo">
					<a href="login.php?action=searchID">아이디</a> | <a href="login.php?action=searchPassword">비밀번호 찾기</a>	
				</span>
			</div>
			<div class="leave-body">
				<div class="panel-info-result">
					<ul>
						<li>
							<p>{$documentData.user_name}님의 아이디</p>
							<p><span>' {$documentData.user_id} '</span></p>
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
				<li><span>비밀번호를 잊어버렸을 경우 비밀번호 찾기를 이용해 주시기 바랍니다.</span></li>
				<li>기타 궁금한 사항이나 질문은 Q&amp;A 게시판을 이용해 주세요.</li>
			</ul>
		</div>		
	</div>			
</div>
{include file="$skinDir/_footer.tpl"}