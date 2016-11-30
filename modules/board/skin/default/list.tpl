{assign var=rootPath value=$skinPathList.root}
{assign var=category value=$documentData.category}
{assign var=uri value=$documentData.uri}
{assign var=groupData value=$documentData.group}
{assign var=boardTitle value=$groupData.board_name}
{assign var=contentData value=$documentData.contents}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="$boardTitle :: 게시물 목록 - StreamUX"}
<div class="board-list" style="width:{$groupData.width}">
	<table summary="게시판 리스트입니다.">
		<thead>
			<tr>
				<th class="author">작성자</th>
				<th class="subject">제목</th>
				<th class="date">날자</th>
				<th class="hit">조회</th>
			</tr>
		</thead>
		<tbody>
		{foreach from=$contentData.list  item=$item}
			{if isset($item)}
			<tr>
				<td class="author"><span>{$item.name}</span></td>
				<td class="subject">					
					<a href="{$uri}/{$item.subject.id}"><span class="link-area" style="padding-left:{$item.subject.space}">
						<span class="label label-primary {$item.subject.icon_box_color}">{$item.subject.icon_box}</span>						
						{$item.subject.title|nl2br}
						<span class="{$item.subject.txt_tail}">({$item.subject.tail_num})</span>
						{if $item.subject.img_name != ''}
						<img src="{$skinPathList.dir}/images/{$item.subject.img_name}" class="{$item.subject.icon_img}">
						{/if}
						<img src="{$skinPathList.dir}/images/icon_new_1.gif" class="{$item.subject.icon_new}"  title="{$item.subject.icon_new_title}">
						<span class="label label-primary {$item.subject.icon_progress_step_color}">{$item.subject.progress_step_name}</span>	
					</span></a>
				</td>				
				<td class="date"><span>{$item.id}</span></td>
				<td class="hit"><span>{$item.ssunseo_count}</span></td>
			</tr>
			{else if}
			<tr>
				<td colspan="4" class="warn-subject color-red"><span>등록된 게시물이 없습니다.</span></td>
			</tr>
			{/if}
		{/foreach}
		</tbody>
	</table>
	<div class="board-page-navi" style="width:{$groupData.width}">
	{if $skinPathList.navi != ''}
		{assign var=naviSkinPath value=$skinPathList.navi}
		{include file="$naviSkinPath"}
	{/if}
	</div>
	<div class="board-search ui-inlineblock">
		<form action="board.php?board={$requestData.board}&find={$requestData.find}&search={$requestData.search}&action=list" method="post" name="f_board_list_search" onSubmit="return jsux.fn.list.checkSearchForm(this);">
			<select name="find">
				<option value='title'>제 목</option>
				<option value='name'>작성자</option>
				<option value='comment'>내 용</option>
			</select>
			<input type="text" name="search" size="15">
			<input name="imageField" type="image" src="{$skinPathList.dir}/images/btn_search.gif" width="51" height="23" border="0">
		</form>
	</div>	
	<div class="board-list-buttons">
		<a href="{$uri}">
			<img src="{$skinPathList.dir}/images/btn_list.gif" width="51" height="23" border="0">
		</a>
		<a href="{$uri}/write"><img src="{$skinPathList.dir}/images/btn_write.gif" width="62" height="23" border="0"></a>
	</div>
</div>
{include file="$footerPath"}