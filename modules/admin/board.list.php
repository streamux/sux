<? include "top.php"; ?>

	<div class="container">	
		<div class="articles ui-edgebox">
			<div class="list">
				<h2 class="blind">게시판목록</h2>
				<div class="tt">
					<div class="imgbox">
						<span>게시판목록</span>
					</div>
				</div>
				<div class="box">
					<ul>
						<li>
							<img src="tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
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
							<!--
							@ jquery templete
							@ name	boardWarnMsg_tmpl, boardList_tmpl
							-->								
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="jquery-templete" id="boardWarnMsg_tmpl">
	<tr>
		<td colspan="9"><span class="warn-msg">${msg}</span></td>
	</tr>
</script>
<script type="jquery-templete" id="boardList_tmpl">
	<tr>
		<td><span>${no}</span></td>
		<td><span>${board_name}</span></td>								
		<td><span>${$item.editDate(date)}</span></td>
		<td><span>${log_key}</span></td>						
		<td><span>${width}</span></td>
		<td>
			<a href="board.edit.php?id=${id}&table_name=${table_name}&pageType=board">
				<img src="./tpl/images/btn_edit.gif" alt="수정버튼">
			</a></td>
		<td>
			<a href="board.delpass.php?id=${id}&table_name=${table_name}&pageType=board">
				<img src="./tpl/images/btn_del.gif" alt="삭제버튼">
			</a>
		</td>
	</tr>
</script>

<script type="text/javascript" src="./tpl/js/board.list.js"></script>

<? include "bottom.php"; ?>