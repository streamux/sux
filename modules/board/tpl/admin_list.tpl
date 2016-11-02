{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="SUX관리자 게시판 목록 - StreamUX"}
<div class="articles ui-edgebox">
	<div class="list">
		<div class="tt">
			<div class="imgbox">
				<h1>게시판목록</h1>
			</div>
		</div>
		<div class="box">
			<ul>
				<li>
					<img src="../admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
					<span class="text-notice">한번 삭제 시 모든 자료가 사라집니다. 주의하세요.</span>			
				</li>
			</ul>
			<table summary="회원목록을 보여줍니다." cellspacing="0">
				<caption><span class="blind">게시판목록</span></caption>
				<colgroup>
					<col width="8%">
					<col width="28%">
					<col width="26%">
					<col width="10%">
					<col width="12%">
					<col width="8%">
					<col width="8%">
				</colgroup>
				<thead>
					<tr>
						<th scope="col"><span>번호</span></th>
						<th scope="col"><span>게시판 이름</span></th>
						<th scope="col"><span>생성날</span></th>
						<th scope="col"><span>권한</span></th>
						<th scope="col"><span>넓이</span></th>
						<th scope="col"><span>수정</span></th>
						<th scope="col"><span>삭제</span></th>
					</tr>         
				</thead>
				<tbody id="boardList">
					<tr>
						<td colspan="7"></td>
					</tr>
					<!--
					@ jquery templete
					@ name	boardWarnMsg_tmpl, boardList_tmpl
					-->								
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="jquery-templete" id="boardWarnMsg_tmpl">
{literal}
	<tr>
		<td colspan="9"><span class="warn-msg">${msg}</span></td>
	</tr>
{/literal}
</script>
<script type="jquery-templete" id="boardList_tmpl">
{literal}
	<tr>
		<td><span>${no}</span></td>
		<td><a href="../board/board.php?board=${name}&action=list" target="_blank"><span>${board_name}</span></a></td>								
		<td><span>${$item.editDate(date)}</span></td>
		<td><span>${log_key}</span></td>						
		<td><span>${width}</span></td>
		<td>
			<a href="board.admin.php?id=${id}&table_name=${name}&pagetype=board&action=modify">
				<img src="../admin/tpl/images/btn_edit.gif" alt="수정버튼">
			</a></td>
		<td>
			<a href="board.admin.php?id=${id}&table_name=${name}&pagetype=board&action=delete">
				<img src="../admin/tpl/images/btn_del.gif" alt="삭제버튼">
			</a>
		</td>
	</tr>
{/literal}
</script>
{include file="$footerPath"}
