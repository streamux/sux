{assign var=rootPath value=$skinPathList.root}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="회원 로그인 - StreamUX"}
<div class="article-box ui-edgebox">				
	<div class="login">
		<h1 class="title">회원 로그인</h1>
		<span class="subtitle">SMX 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>

		<form action="{$rootPath}login" name="f_login" method="post" onSubmit="return jsux.fn.login.checkForm(this);">
		<input type="hidden" name="action" value="record-logpass">
		<div class="box ui-edgebox-2px">
			<div class="login-header">
				<img src="{$rootPath}modules/login/tpl/images/icon_01.gif" title="">						
				<span>회원그룹</span>
				<select name="member" id="ljsMember">
					<!-- templete -->
				</select>
			</div>
			<div class="login-body">
				<div class="panel-info">
					<ul>
						<li><span class="ui-label">아이디</span><input type="text" name="memberid" maxlength="14" value=""class="input-id"></li>
						<li><span class="ui-label">비밀번호</span><input type="password" name="pass" maxlength="20"class="input-pwd"></li>
					</ul>							
				</div><div class="panel-btn">
					<input type="image" name="imagefield" src="{$rootPath}modules/login/tpl/images/btn_login.gif" title="로그인버튼" class="login-btn">
				</div>					
			</div>
			<div class="login-footer">
				<span class="link-searchinfo">
					<a href="{$rootPath}member" class="ui-label-join"><span>회원가입</span></a><a href="{$rootPath}login/search-id"><span>아이디</span></a><span>/</span><a href="{$rootPath}login/search-password"><span>비밀번호 찾기</span></a>	
				</span>
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
			</dl><dl>
				<dt>서비스 이용안내</dt>
				<dd>서비스를 이용하시려면 먼저 로그인을 해주세요.</dd>
			</dl>
		</div>					
	</div>
</div>
{include file="$footerPath"}
