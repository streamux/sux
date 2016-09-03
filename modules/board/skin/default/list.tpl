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
					<span style="display:{$item.subject.space_display};width:{$item.subject.space_width}"></span>
					<span style="display:{$item.subject.space_display};padding-right:5px"><img src="{$skin_dir}/images/icon_answer.gif"></span>
					<span style="display:{$item.subject.icon_display}"><img src="{$skin_dir}/images/{$item.subject.icon_name}"></span>
					<a href="board.php?board={$board}&board_grg={$board_grg}&id={$item.subject.id}&igroup={$item.subject.igroup}&sid={$item.subject.sid}&passover={$passover}&page={$page}&action=read"><span>{$item.subject.title|nl2br}</span></a>
					<span style="display:{$item.subject.comment_display}">({$item.subject.comment_num})</span>
					<span style="display:{$item.subject.newicon_display};padding-left:5px"><img src="{$skin_dir}/images/new.gif"></span>
					<span style="display:{$item.subject.opkey_display};padding-left:5px"><img src="{$skin_dir}/images/{$item.subject.opkey_name}"></span>
				</td>				
				<td class="date"><span>{$item.compareDay}</span></td>
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
	<form action="" method="post" name="musimsl" onSubmit="return musimsl_check(this);">
		<select name=find>
			<option value='title'>제 목</option>
			<option value='name'>작성자</option>
			<option value='comment'>내 용</option>
		</select>
		<input type=text name=search size=15>
		<input name="imageField" type="image" src="{$skin_dir}/images/btn_search.gif" width="51" height="23" border="0">
	</form>
</div>	
<div class="board-buttons ui-inlineblock">
	<a href=""><img src="{$skin_dir}/images/btn_write.gif" width="62" height="23" border="0"></a>
</div>

<script type="text/javascript" src="/js/board.list.js"></script>
