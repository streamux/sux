{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="SUX관리자 회원목록 - StreamUX"}	
	<div class="container">	
		<div class="articles ui-edgebox">
			<div class="list">
				<div class="tt">
					<div class="imgbox">						
						<h1>회원목록</h1>
						<input type="hidden" name="table_name" value="{$requestData.table_name}">
					</div>
				</div>
				<div class="box">
					<dl>
						<dt>
							<img src="../admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon_notice">										
						</dt>
						<dt>
							<span class="text-notice">한번 삭제 시 모든 자료가 사라집니다. 주의하세요.</span>
						</dt>
						<dd>							
							<span id="articleMemberDelTitle" class="button-delall">
								<!--
								@ jquery templete
								@ name articleMemberDelTitle_tmpl
								-->
							</span>
						<dd>
					</dl>
					<table summary="회원목록을 보여줍니다." cellspacing="0">
						<caption><span class="blind">회원목록</span></caption>
						<colgroup>
							<col width="8%">
							<col width="18%">
							<col width="18%">
							<col width="20%">
							<col width="9%">
							<col width="9%">
							<col width="9%">
							<col width="9%">
						</colgroup>
						<thead>
							<tr>
								<th scope="col"><span>번호</span></th>
								<th scope="col"><span>아이디</span></th>
								<th scope="col"><span>이름</span></th>
								<th scope="col"><span>날자</span></th>
								<th scope="col"><span>히트</span></th>
								<th scope="col"><span>레벨</span></th>
								<th scope="col"><span>수정</span></th>
								<th scope="col"><span>삭제</span></th>
							</tr>         
						</thead>
						<tbody id="memberList">
							<!--
							@ jquery templete
							@ name	memberWarnMsg_tmpl, memberList_tmpl
							-->							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="jquery-templete" id="articleMemberDelTitle_tmpl">
{literal}
	<a href="member.groupdelpass.php?table_name=${table_name}&pagetype=member">${table_name}<span>회원그룹삭제</span></a>
{/literal}
</script>
<script type="jquery-templete" id="memberWarnMsg_tmpl">
{literal}
	<tr>
		<td colspan="9"><span class="warn-msg">${msg}</span></td>
	</tr>
{/literal}
</script>
<script type="jquery-templete" id="memberList_tmpl">
{literal}
	<tr>
		<td><span>${no}</span></td>
		<td><span>${memberid}</span></td>
		<td><span>${name}</span></td>
		<td><span>${$item.editDate(date)}</span></td>							
		<td><span>${hit}</span></td>
		<td><span>${grade}</span></td>
		<td>
			<a href="member.admin.php?id=${id}&memberid=${memberid}&table_name=${table_name}&action=modify&pagetype=member">
				<img src="../admin/tpl/images/btn_edit.gif" alt="수정버튼">
			</a></td>
		<td>
			<a href="member.admin.php?id=${id}&memberid=${memberid}&table_name=${table_name}&action=delete&pagetype=member">
				<img src="../admin/tpl/images/btn_del.gif" alt="삭제버튼">
			</a>
		</td>
	</tr>
{/literal}
</script>
{include file="$footerPath"}
