<div class="board-list" style="width:{$group_data.width}">
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
		{foreach from=$list_data  item=$item}
			{if isset($item)}
			<tr>
				<td class="author"><span>{$item.name}</span></td>
				<td class="subject">					
					<a href="board.php?board={$req_data.board}&board_grg={$req_data.board_grg}&id={$item.subject.id}&igroup={$item.subject.igroup}&ssunseo={$item.subject.ssunseo}&sid={$item.subject.sid}&passover={$req_data.passover}&page={$req_data.page}&search={$req_data.search}&find={$req_data.find}&action=read"><span style="padding-left:{$item.subject.space}" class="link-area">
						<span class="label label-primary {$item.subject.icon_box_color}">{$item.subject.icon_box}</span>						
						{$item.subject.title|nl2br}
						<span class="{$item.subject.txt_tail}">({$item.subject.tail_num})</span>
						<img src="{$skin_dir}/images/icon_new_1.gif" class="{$item.subject.icon_new}"  title="{$item.subject.icon_new_title}">
						<img src="{$skin_dir}/images/{$item.subject.opkey_name}" class="{$item.subject.icon_opkey}">
						<img src="{$skin_dir}/images/{$item.subject.img_name}" class="{$item.subject.icon_img}">
					</span></a>
				</td>				
				<td class="date"><span>{$item.date}</span></td>
				<td class="hit"><span>{$item.hit}</span></td>
			</tr>
			{else if}
			<tr>
				<td colspan="4" class="warn-subject color-red"><span>등록된 게시물이 없습니다.</span></td>
			</tr>
			{/if}
		{/foreach}
		</tbody>
	</table>	
</div>

<div class="board-page-navi">
{include file="$navi_skin_path"}
</div>
<div class="board-search ui-inlineblock">
	<form action="board.php?board={$req_data.board}&board_grg={$req_data.board_grg}&find={$req_data.find}&search={$req_data.search}&action=list" method="post" name="musimsl" onSubmit="return musimsl_check(this);" method="post" name="musimsl" onSubmit="return musimsl_check(this);">
		<select name="find">
			<option value='title'>제 목</option>
			<option value='name'>작성자</option>
			<option value='comment'>내 용</option>
		</select>
		<input type="text" name="search" size="15">
		<input name="imageField" type="image" src="{$skin_dir}/images/btn_search.gif" width="51" height="23" border="0">
	</form>
</div>	
<div class="board-list-buttons ui-inlineblock">
	<a href="board.php?board={$req_data.board}&board_grg={$req_data.board_grg}&action=list">
		<img src="{$skin_dir}/images/btn_list.gif" width="51" height="23" border="0">
	</a>
	<a href="board.php?board={$req_data.board}&board_grg={$req_data.board_grg}&passover={$req_data.passover}&page={$req_data.page}&action=write"><img src="{$skin_dir}/images/btn_write.gif" width="62" height="23" border="0"></a>
</div>

<script type="text/javascript" src="{$skin_dir}/js/board.list.js"></script>
