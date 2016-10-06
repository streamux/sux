{assign var=groupData value=$documentData.group}
{assign var=boardTitle value=$groupData.board_name}
{assign var=contentData value=$documentData.contents}
{assign var=tailData value=$documentData.tails}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{assign var=opkeySkinPath value=$skinPathList.opkey}
{assign var=tailSkinPath value=$skinPathList.tail}
{include file="$headerPath" title="$boardTitle :: 게시물 읽기 - StreamUX"}
<div class="board-read" style="width:{$groupData.width}">
	<div class="panel-heading">
		<p class="title">{$contentData.title}</p>
		<p class="sub-info">{$contentData.name} &nbsp; {$contentData.date} &nbsp; 조회 {$contentData.hit}</p>
	</div>
	<div class="panel-body">
		<p class="{$contentData.css_down}">
			<a href="{$contentData.fileup_path}">{$contentData.file_name}&nbsp;<b>[ 다운로드 ]</b></a>
		</p>
		<p class="{$contentData.css_img}" style="max-width:{$contentData.css_img_width}"><img src="{$contentData.fileup_path}" width="100%" border="0"></p>
		<p>{$contentData.comment}</p>
	</div>		
</div>
<div class="board-buttons">
	<a href="board.php?board={$requestData.board}&board_grg={$requestData.board_grg}&passover={$requestData.passover}&page={$requestData.page}&find={$requestData.find}&search={$requestData.search}&action=list"><img src="{$skinPathList.dir}/images/btn_list.gif" width="51px" height="23px" border="0px"></a>
	<a href="board.php?&board={$requestData.board}&board_grg={$requestData.board_grg}&action=write"><img src="{$skinPathList.dir}/images/btn_write.gif" width="62" height="23" border="0"></a> <a href="board.php?board={$requestData.board}&board_grg={$requestData.board_grg}&id={$requestData.id}&igroup={$requestData.igroup}&space={$requestData.space}&ssunseo={$requestData.ssunseo}&action=reply"><img src="{$skinPathList.dir}/images/btn_answer.gif" width="51" height="23" border="0"></a>&nbsp;<a href="board.php?board={$requestData.board}&board_grg={$requestData.board_grg}&id={$requestData.id}&sid={$requestData.sid}&action=modify"><img src="{$skinPathList.dir}/images/btn_edit.gif" border="0"></a>&nbsp;<a href="board.php?board={$requestData.board}&board_grg={$requestData.board_grg}&id={$requestData.id}&action=delete"><img src="{$skinPathList.dir}/images/btn_del.gif" width="51" height="23" border="0"></a>
</div>
{if $opkeySkinPath != ''}	
<div class="board-adminsetup {$contentData.css_opkey}" style="width:{$groupData.width}">
	{include file="$opkeySkinPath"}
</div>
{/if}
{if $tailSkinPath != ''}
<div class="board-tail {$contentData.css_tail}" style="width:{$groupData.width}">
	{include file="$tailSkinPath"}
</div>
{/if}
{include file="$footerPath"}