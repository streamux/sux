<div class="board-list" style="width:{$width}">
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
		{foreach from=$rows_data  item=$item}			
			{if isset($item)}
			<tr>
				<td class="author"><span>{$item.name}</span></td>
				<td class="subject">					
					<a href="board.php?board={$board}&board_grg={$board_grg}&id={$item.subject.id}&igroup={$item.subject.igroup}&sid={$item.subject.sid}&passover={$passover}&page={$page}&search={$item.subject.search}&find={$item.subject.find}&action=read"><span class="link-area {$item.subject.space}">
						<img src="{$skin_dir}/images/icon_answer{$item.subject.icon_reply_type}.png" class="{$item.subject.icon_reply}">

						<img src="{$skin_dir}/images/{$item.subject.img_name}" class="{$item.subject.icon_img}">
						{$item.subject.title|nl2br}
						<span class="{$item.subject.txt_comment}">({$item.subject.comment_num})</span>
						<img src="{$skin_dir}/images/new.gif" class="{$item.subject.icon_new}">
						<img src="{$skin_dir}/images/{$item.subject.opkey_name}" class="{$item.subject.icon_opkey}">
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
	<form action="board.php?board={$board}&board_grg={$board_grg}&find={$find}&search={$search}&action=list" method="post" name="musimsl" onSubmit="return musimsl_check(this);" method="post" name="musimsl" onSubmit="return musimsl_check(this);">
		<select name="find">
			<option value='title'>제 목</option>
			<option value='name'>작성자</option>
			<option value='comment'>내 용</option>
		</select>
		<input type="text" name="search" size="15">
		<input name="imageField" type="image" src="{$skin_dir}/images/btn_search.gif" width="51" height="23" border="0">
	</form>
</div>	
<div class="board-buttons ui-inlineblock">
	<a href="board.php?board={$board}&board_grg={$board_grg}&action=list">
		<img src="{$skin_dir}/images/btn_list.gif" width="51" height="23" border="0">
	</a>
	<a href="board.php?board={$board}&board_grg={$board_grg}&passover={$passover}&page={$page}&action=write"><img src="{$skin_dir}/images/btn_write.gif" width="62" height="23" border="0"></a>
</div>

<script type="text/javascript" src="{$skin_dir}/js/board.list.js"></script>
