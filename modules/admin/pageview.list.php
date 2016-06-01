<? include "top.php"; ?>

	<div class="container">	
		<div class="articles ui-edgebox">
			<div class="list">
				<h2 class="blind">통계 페이지뷰 목록</h2>
				<div class="tt">
					<div class="imgbox">
						<span>페이지뷰 목록</span>
					</div>
				</div>
				<div class="box">
					<ul>
						<li>
							<img src="tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
							한번 삭제 시 모든 자료가 사라집니다. 주의하세요.	
						</li>
						<li>
							초기화 또한 반드시 필요한지 확인해주세요.
						</li>
					</ul>
					<table summary="접속키워드 목록을 보여줍니다." cellspacing="0">
						<caption><span class="blind">페이지뷰 목록</span></caption>
						<colgroup>
							<col width="8%">
							<col width="25%">
							<col width="16%">
							<col width="31%">
							<col width="12%">
							<col width="8%">
						</colgroup>
						<thead>
							<tr>
								<th scope="col"><span>번호</span></th>
								<th scope="col"><span>페이지 이름</span></th>
								<th scope="col"><span>클릭수</span></th>
								<th scope="col"><span>통계그래프</span></th>
								<th scope="col"><span>수정</span></th>
								<th scope="col"><span>삭제</span></th>
							</tr>         
						</thead>
						<tbody id="totallogList">
							<!--
							@jquery templete
							@name totallogWarnMsg_tmpl, totallogList_tmpl
							-->	
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="jquery-templete" id="totallogWarnMsg_tmpl">
	<tr>
		<td colspan="9"><span class="warn-msg">${msg}</span></td>
	</tr>
</script>

<script type="jquery-templete" id="totallogList_tmpl">
	<tr>
		<td><span>${no}</span></td>
		<td><span>${name}</span></td>								
		<td><span>${hit}</span></td>
		<td><span>${percent}</span></td>
		<td>
			<a href="pageview.resetpass.php?id=${id}&name=${name}&pageType=totallog">
				<img src="./tpl/images/btn_reset.gif" alt="초기화버튼">
			</a></td>
		<td>
			<a href="pageview.delpass.php?id=${id}&name=${name}&pageType=totallog">
				<img src="./tpl/images/btn_del.gif" alt="삭제버튼">
			</a>
		</td>
	</tr>
</script>

<script type="text/javascript" src="./tpl/js/pageview.list.js"></script>

<? include "bottom.php"; ?>