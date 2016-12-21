{assign var=rootPath value=$skinPathList.root}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="SUX관리자 회원그룹추가 - StreamUX"}	
<div class="articles ui-edgebox">
	<div class="group-add">
		<h2 class="blind">회원그룹추가</h2>
		<div class="tt">
			<div class="imgbox">
				<h1>회원그룹추가</h1>
			</div>
		</div>
		<div class="box">
			<form action="{$rootPath}member-admin/group-add" name="f_admin_group_add" method="post">
			<input type="hidden" name="_method" value="insert">
			<ul>
				<li>
					<img src="{$rootPath}modules/admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
					<span class="text-notice">회원그룹을 생성해야지만 회원을 받으실수 있습니다.</span>			
				</li>				
				<li>
					<p><label for="category">카테고리(영문)</label></p>
					<input type="text" id="category" name="category" maxlength="16" value=""> <input type="button" name="check-member-group" value="중복체크">
				</li>
				<li>
					<p><label for="group_name">회원그룹 이름</label></p>				
					<input type="text" id="group_name" name="group_name" maxlength="16" value="">
				</li>
				<li>
					<p><label for="summary">요약 설명</label></p>				
					<input type="text" id="summary" name="summary" maxlength="50" value="회원을 그룹단위로 관리합니다.">
				</li>
				<li>
					<p><label for="header_path">헤더 파일</label></p>					
					<input type="text" id="header_path" name="header_path" maxlength="50" value="/sux/common/_header.tpl">
				</li>
				<li>
					<p><label for="footer_path">푸터 파일</label></p>				
					<input type="text" id="footer_path" name="footer_path" maxlength="50" value="/sux/common/_footer.tpl">
				</li>
			</ul>
			<input type="submit" name="submit" size="10" value="확 인">
			<input type="button" name="cancel" value="취 소">
			</form>
		</div>
	</div>
</div>
{include file="$footerPath"}