{assign var=rootPath value=$skinPathList.root}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="회원정보 - StreamUX"}
<div class="article-box ui-edgebox">
	<div class="login">
		<h1 class="title">회원정보</h1>
		<span class="subtitle">SMX 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>
		<div class="box ui-edgebox-2px">
			<div class="login-header">
				<img src="{$rootPath}modules/login/tpl/images/icon_01.gif" alt="">
				<span><a href="{$rootPath}member-modify">회원정보수정</a> | <a href="{$rootPath}leave">회원탈퇴</a></span>
			</div>
			<div class="login-body">
				<div class="panel-info">
					<ul>
						<li><span class="ui-label">이름</span><span class="ui-value">'{$sessionData.sux_user_name}</span>' 님</li>
						<li><span class="ui-label">적립포인트</span><span class="ui-value">'{$sessionData.sux_point}</span>' 포인트</li>
						<li><span class="ui-label">방문횟수</span><span class="ui-value">'{$sessionData.sux_hit_count}</span>' 번째 방문</li>
					</ul>
				</div><div class="panel-btn">
					<a href="{$rootPath}logout?_method=insert"><img src="{$rootPath}modules/login/tpl/images/btn_logout.gif"></a>
				</div>
			</div>																	
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
{include file="$footerPath"}
