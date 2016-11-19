{assign var=rootPath value=$skinPathList.root}
{assign var=skinDir value=$skinPathList.skin_dir}
{include file="$skinDir/_header.tpl" title="SUX 설치 : DB 계정정보 설정 - StreamUX"}
<div class="wrapper">
	<div class="header">
		<div class="util"></div>
		<h1 class="logo">
			<img class="logo" src="../modules/install/tpl/images/logo.png" alt="streamxux">	
		</h1>	
	</div>
	<div class="container">	
		<form name="f_db_setup">	
		<input type="hidden" name="_method" value="create">		
		<div class="article-box ui-edgebox">
			<h1>데이터 베이스 설정</h1>
			<ul>
				<li>
					<fieldset>
						<label for="db_hostname">* 호스트명</label>
						<input type="text" id="db_hostname" name="db_hostname" value="localhost">
					</fieldset>	
				</li>
				<li>
					<fieldset>
						<label for="db_userid">* 사용자계정</label>
						<input type="text" id="db_userid" name="db_userid" value="root">
					</fieldset>
				</li>
				<li>
					<fieldset>
						<label for="db_password">* 비밀번호</label>
						<input type="password" id="db_password" name="db_password">
					</fieldset>
				</li>
				<li>
					<fieldset>
						<label for="db_database">* DB이름</label>
						<input type="text" id="db_database" name="db_database" value="streamuxcom">
					</fieldset>
				</li>
				<li>
					<fieldset>
						<label for="db_table_prefix">* 테이블 접두사</label>
						<input type="text" id="db_table_prefix" name="db_table_prefix" value="sux">
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
<div class="ui-panel-msg"></div>
{include file="$skinDir/_footer.tpl"}