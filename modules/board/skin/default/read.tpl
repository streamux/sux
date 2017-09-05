{assign var=groupData value=$documentData.group}
{assign var=boardTitle value=$groupData.board_name}
{assign var=contentData value=$documentData.contents}
{assign var=commentData value=$documentData.comments}
{assign var=uri value=$documentData.uri}
{assign var=rootPath value=$skinPathList.root}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{assign var=progressStepSkinPath value=$skinPathList.progress_step}
{assign var=commentSkinPath value=$skinPathList.comment}
{include file="$headerPath" title="$boardTitle :: 게시물 읽기 - StreamUX"}
<div class="board-read" style="width:{$groupData.width}">
	<div class="panel-heading">
		<p class="title">{$contentData.title}</p>
		<p class="sub-info">{$contentData.user_name} &nbsp; {$contentData.date} &nbsp; 조회 {$contentData.readed_count}</p>
	</div>
	<div class="panel-body">
		<p class="{$contentData.css_down}">
			<a href="{$contentData.fileup_path}">{$contentData.file_name}&nbsp;<b>[ 다운로드 ]</b></a>
		</p>
		<p class="{$contentData.css_img}" style="max-width:{$contentData.css_img_width}"><img src="{$contentData.fileup_path}" width="100%" border="0"></p>
		<p>{$contentData.contents}</p>
	</div>
	<div class="board-buttons">
		{if $requestData.search != ''}
			<a href="{$uri}?find={$requestData.find}&search={$requestData.search}">
		{else}
			<a href="{$uri}">
		{/if}
		<img src="{$skinPathList.dir}/images/btn_list.gif" width="51px" height="23px" border="0px"></a>
		{if $requestData.search != ''}
			<a href="{$uri}/write?find={$requestData.find}&search={$requestData.search}">
		{else}
			<a href="{$uri}/write">
		{/if}
		<img src="{$skinPathList.dir}/images/btn_write.gif" width="62" height="23" border="0"></a>
		{if $requestData.search != ''}
			<a href="{$uri}/{$contentData.id}/reply?find={$requestData.find}&search={$requestData.search}">
		{else}
			<a href="{$uri}/{$contentData.id}/reply">
		{/if}
		<img src="{$skinPathList.dir}/images/btn_answer.gif" width="51" height="23" border="0"></a>&nbsp;
		{if $requestData.search != ''}
			<a href="{$uri}/{$contentData.id}/modify?find={$requestData.find}&search={$requestData.search}">
		{else}
			<a href="{$uri}/{$contentData.id}/modify">
		{/if}
		<img src="{$skinPathList.dir}/images/btn_edit.gif" border="0"></a>&nbsp;
		{if $requestData.search != ''}
			<a href="{$uri}/{$contentData.id}/delete?find={$requestData.find}&search={$requestData.search}">
		{else}
			<a href="{$uri}/{$contentData.id}/delete">
		{/if}
		<img src="{$skinPathList.dir}/images/btn_del.gif" width="51" height="23" border="0"></a>
	</div>
{if $progressStepSkinPath != ''}	
	<div class="board-adminsetup {$contentData.css_progress_step}" style="width:{$groupData.width}">
		{include file="$progressStepSkinPath"}
	</div>
{/if}
{if $commentSkinPath != ''}
	<div class="board-tail {$contentData.css_comment}" style="width:{$groupData.width}">
		{include file="$commentSkinPath"}
	</div>
{/if}
</div>
{include file="$footerPath"}