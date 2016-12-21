{assign var=rootPath value=$skinPathList.root}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="아이디 찾기 - StreamUX"}
<div class="article-box ui-edgebox">	
	<div class="login">
		<h1 class="title">아이디 찾기</h1>
		<span class="subtitle">SUX Board 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>
		<form action="{$rootPath}search-id" name="f_searchid" method="post">
		<input type="hidden" name="_method" value="select">
		<div class="box ui-edgebox-2px">
			<div class="leave-header">
				<img src="{$rootPath}modules/login/tpl/images/icon_01.gif" title="">						
				<span>회원그룹</span>
				<select name="category" id="memberGroup">
					{foreach from=$documentData.group item=value}
						<option>{$value['category']}</option>
					{/foreach}
				</select>
				<span class="link-searchinfo">
					<a href="{$rootPath}search-id">아이디</a> | <a href="{$rootPath}search-password">비밀번호 찾기</a>	
				</span>
			</div>
			<div class="leave-body">
				<div class="panel-info">
					<ul>
						<li><span class="ui-label">이름</span><input type="text" name="user_name" maxlength="14" value=""></li>
						<li><span class="ui-label">E-Mail 주소</span><input type="text" name="email_address" maxlength="20" value=""></li>
					</ul>				
				</div>
				<div class="panel-btn">
					<input type="submit" name="btn_confirm" value="확 인">
					<input type="button" name="btn_cancel" value="취 소" onclick="location.href='{$rootPath}login'">
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
{include file="$footerPath"}