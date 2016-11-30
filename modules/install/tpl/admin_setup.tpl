{assign var=rootPath value=$skinPathList.root}
{assign var=skinDir value=$skinPathList.skin_dir}
{include file="$skinDir/_header.tpl" title="SUX 설치 : 관리자 기본정보 설정 - StreamUX"}
<div class="wrapper">
	<div class="header">
		<div class="util"></div>
		<h1 class="logo">
			<img class="logo" src="{$rootPath}modules/install/tpl/images/logo.png" alt="streamxux">	
		</h1>
	</div>
	<div class="container">
		<form name="f_setup_admin" action="{$rootPath}setup-admin" method="post">
		<input type="hidden" name="_method" value="insert">
		<div class="article-box ui-edgebox">	
			<h1>관리자 기본정보 설정</h1>
			<ul>
				<li>
					<fieldset>
						<label for="admin_id">* 관리자 아이디</label>
						<input type="text" id="admin_id" name="admin_id" value="admin">
					</fieldset>	
				</li>
				<li>
					<fieldset>
						<label for="admin_pwd">* 관리자 비밀번호</label>
						<input type="password" id="admin_pwd" name="admin_pwd">
					</fieldset>
				</li>
				<li>
					<fieldset>
						<label for="admin_email">* 관리자 이메일</label>
						<input type="text" id="admin_email" name="admin_email" value="streamux@naver.com">
					</fieldset>
				</li>
				<li>
					<fieldset>
						<label for="yourhome">* 홈페이지 주소</label>
						<input type="text" id="yourhome" name="yourhome" value="localhost">
					</fieldset>
				</li>
			</ul>
		</div>
		<input type="submit" value=' 다 음 ' class="btn-submit">
		</form>
	</div>
	<div class="footer">
		{include file="$copyrightPath"}
	</div>
</div>
{include file="$skinDir/_footer.tpl"}
