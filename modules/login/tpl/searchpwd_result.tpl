{assign var=rootPath value=$skinPathList.root}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="비밀번호 찾기 결과 - StreamUX"}
<div class="article-box ui-edgebox">	
	<div class="login">
		<h1 class="title">비밀번호 찾기 결과</h1>
		<span class="subtitle">SUX Board 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>
		
		<div class="box ui-edgebox-2px">
			<div class="leave-header">
				<img src="{$rootPath}modules/login/tpl/images/icon_01.gif" title="">						
				<span>조회 결과</span>
				<span class="link-searchinfo">
					<a href="{$rootPath}search-id">아이디</a> | <a href="{$rootPath}search-password">비밀번호 찾기</a>	
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
					<input type="button" name="btn_confirm" value="확 인" onclick="location.href='{$rootPath}login'">		
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
{include file="$footerPath"}
