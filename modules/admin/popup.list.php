<? include "top.php"; ?>

	<div class="container">	
		<div class="articles ui-edgebox">
			<div class="list">
				<h2 class="blind">팝업목록</h2>
				<div class="tt">
					<div class="imgbox">
						<span>팝업목록</span>
					</div>
				</div>
				<div class="box">
					<ul>
						<li>
							<img src="tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
							<span class="text-notice">한번 삭제 시 모든 자료가 사라집니다. 주의하세요.</span>			
						</li>
					</ul>
					<table summary="팝업목록을 보여줍니다." cellspacing="0">
						<caption><span class="blind">팝업목록</span></caption>
						<colgroup>
							<col width="8%">
							<col width="32%">
							<col width="24%">
							<col width="20%">
							<col width="8%">
							<col width="8%">
						</colgroup>
						<thead>
							<tr>
								<th scope="col"><span>번호</span></th>
								<th scope="col"><span>팝업 이름</span></th>
								<th scope="col"><span>완료일</span></th>
								<th scope="col"><span>스킨</span></th>
								<th scope="col"><span>수정</span></th>
								<th scope="col"><span>삭제</span></th>
							</tr>         
						</thead>
						<tbody id="popupList">
							<!--
							@ jquery templete
							@ name	popupWarnMsg_tmpl, popupList_tmpl
							-->		
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="jquery-templete" id="popupWarnMsg_tmpl">
	<tr>
		<td colspan="9"><span class="warn-msg">${msg}</span></td>
	</tr>
</script>
<script type="jquery-templete" id="popupList_tmpl">
	<tr>
		<td><span>${no}</span></td>
		<td><span>${name}</span></td>								
		<td><span>${date}</span><span class="ui-time">${time}</span></td>
		<td><span>${skin}</span></td>
		<td>
			<a href="popup.edit.php?id=${id}&pageType=popup">
				<img src="./tpl/images/btn_edit.gif" alt="수정버튼">
			</a></td>
		<td>
			<a href="popup.delpass.php?id=${id}&pageType=popup">
				<img src="./tpl/images/btn_del.gif" alt="삭제버튼">
			</a>
		</td>
	</tr>
</script>

<script type="text/javascript" src="./tpl/js/popup.list.js"></script>

<? include "bottom.php"; ?>