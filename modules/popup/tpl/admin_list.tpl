{assign var=rootPath value=$skinPathList.root}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="SUX관리자 팝업목록 - StreamUX"}
<div class="articles ui-edgebox">
	<div class="list">
		<div class="tt">
			<div class="imgbox">
				<h1>팝업목록</h1>
			</div>
		</div>
		<div class="box">
			<ul>
				<li>
					<img src="{$rootPath}modules/admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
					<span class="text-notice">한번 삭제 시 모든 자료가 사라집니다. 주의하세요.</span>			
				</li>
			</ul>
			<table summary="팝업목록을 보여줍니다." cellspacing="0">
				<caption><span class="blind">팝업목록</span></caption>
				<colgroup>
					<col width="8%">
					<col width="26%">
					<col width="24%">
					<col width="26%">
					<col width="8%">
					<col width="8%">
				</colgroup>
				<thead>
					<tr>
						<th scope="col"><span>번호</span></th>
						<th scope="col"><span>이름</span></th>
						<th scope="col"><span>완료일</span></th>
						<th scope="col"><span>스킨</span></th>
						<th scope="col"><span>수정</span></th>
						<th scope="col"><span>삭제</span></th>
					</tr>         
				</thead>
				<tbody id="popupList">
					<tr>
						<td colspan="6"></td>
					</tr>
					<!--
					@ jquery templete
					@ name	popupWarnMsg_tmpl, popupList_tmpl
					-->		
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="jquery-templete" id="popupWarnMsg_tmpl">
	{literal}
	<tr>
		<td colspan="9"><span class="warn-msg">${msg}</span></td>
	</tr>
	{/literal}
</script>
<script type="jquery-templete" id="popupList_tmpl">	
	<tr>
		{literal}
		<td><span>${no}</span></td>
		<td data-key="td"><span class="popup"><a href="#" data-key="${id}">${popup_name}</a></span></td>
		<td><span class="ui-date">${date}</span><span class="ui-time">${time}</span></td>
		<td><span>${skin}</span></td>
		{/literal}
		<td>
			<a href="{$rootPath}popup-admin/{literal}${id}{/literal}/modify">
				<img src="{$rootPath}modules/admin/tpl/images/btn_edit.gif" alt="수정버튼">
			</a></td>
		<td>
			<a href="{$rootPath}popup-admin/{literal}${id}{/literal}/delete">
				<img src="{$rootPath}modules/admin/tpl/images/btn_del.gif" alt="삭제버튼">
			</a>
		</td>
	</tr>	
</script>
{include file="$footerPath"}
