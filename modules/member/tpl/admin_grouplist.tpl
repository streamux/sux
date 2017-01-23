{assign var=rootPath value=$skinPathList.root}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="SUX관리자 회원그룹목록 - StreamUX"}	
<div class="articles ui-edgebox">
	<div class="list">
		<div class="tt">
			<div class="imgbox">						
				<h1>회원그룹목록</h1>
			</div>
		</div>
		<div class="box">
			<ul>
				<li>
					<img src="{$rootPath}modules/admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
					<span class="text-notice">한번 삭제 시 모든 자료가 사라집니다. 주의하세요.</span>	
				</li>
			</ul>
			<table summary="회원목록을 보여줍니다." cellspacing="0">
				<caption><span class="blind">회원목록</span></caption>
				<colgroup>
					<col width="12%">
					<col width="19%">
					<col width="43%">
					<col width="13%">
					<col width="13%">
				</colgroup>
				<thead>
					<tr>
						<th scope="col"><span>번호</span></th>
						<th scope="col"><span>그룹이름</span></th>
						<th scope="col"><span>생성 날자</span></th>
						<th scope="col"><span>수정</span></th>
						<th scope="col"><span>삭제</span></th>
					</tr>         
				</thead>
				<tbody id="memberList">
					<tr>
						<td colspan="5"></td>
					</tr>
					<!--
					@ jquery templete
					@ name	memberWarnMsg_tmpl, memberList_tmpl
					-->							
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="jquery-templete" id="memberWarnMsg_tmpl">
{literal}
	<tr>
		<td colspan="9"><span class="warn-msg">${msg}</span></td>
	</tr>
{/literal}
</script>
<script type="jquery-templete" id="memberList_tmpl">
	<tr>
		<td><span>{literal}${no}{/literal}</span></td>
		<td>
			
			<a href="{$rootPath}member-admin/{literal}${id}{/literal}/list">
				<span>{literal}${category}{/literal}</span>
			</a>
		</td>
		<td><span>{literal}${$item.editDate(date)}{/literal}</span></td>	
		<td>
			<a href="#">
				<img src="{$rootPath}modules/admin/tpl/images/btn_edit.gif" alt="수정버튼">
			</a>
		</td>
		<td>
			<a href="{$rootPath}member-admin/{literal}${id}{/literal}/group-delete">
				<img src="{$rootPath}modules/admin/tpl/images/btn_del.gif" alt="삭제버튼">
			</a>
		</td>
	</tr>
</script>
{include file="$footerPath"}