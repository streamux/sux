{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="SUX관리자 회원그룹삭제 - StreamUX"}	
	<div class="container">
		<div class="articles ui_edgebox">
			<div class="del">
				<div class="tt">
					<div class="imgbox">
						<h1>회원그룹 삭제</h1>	
					</div>
				</div>
				<div class="box">
					<ul>
						<li>
							<img src="../admin/tpl/images/icon_stop.gif" width="30" height="13" alt="경고아이콘" class="icon">
							<span class="title1">{$id} 회원그룹을 정말로 삭제 하시겠습니까?</span>
							<input type="hidden" name="table_name" value="{$requestData.table_name}">
						</li>
						<li>
							<span class="title2">다시한번 잘 확인해 주세요.</span>
							<a href="#" data-key="del" class="button_del"><span>[삭제]</span></a>
							<a href="#" data-key="back" class="button_cancel"><span>[취소]</span></a>		
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
{include file="$footerPath"}