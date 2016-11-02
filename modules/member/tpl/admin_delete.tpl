{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="SUX관리자 회원삭제 - StreamUX"}	
<div class="articles ui-edgebox">
	<div class="del ">
		<div class="tt">
			<div class="imgbox">
				<h1>회원삭제 알림</h1>	
			</div>
		</div>
		<div class="box">
			<ul>
				<li>
					<img src="../admin/tpl/images/icon_stop.gif" width="30" height="13" alt="경고아이콘" class="icon">
					<span class="title1">{$table_name} 회원을 정말로 삭제 하시겠습니까?</span>
					<input type="hidden" name="memberid" value="{$requestData.memberid}">
					<input type="hidden" name="table_name" value="{$requestData.table_name}">
					<input type="hidden" name="id" value="{$requestData.id}">
				</li>
				<li>
					<span class="title2">다시한번 잘 확인해 주세요.</span>
					<a href="#" data-key="del" class="button-del"><span>[삭제]</span></a>
					<a href="#" data-key="back" class="button-cancel"><span>[취소]</span></a>		
				</li>
			</ul>
		</div>
	</div>
</div>
{include file="$footerPath"}