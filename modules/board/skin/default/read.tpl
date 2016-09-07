<div class="board-read" style="width:{$group_data.width}">
	<div class="panel-heading">
		<p class="title">{$read_data.title}</p>
		<p class="sub-info">{$read_data.name} &nbsp; {$read_data.date} &nbsp; 조회 {$read_data.hit}</p>
	</div>
	<div class="panel-body">
		<p style="display:{$read_data.down_display}">
			<a href="{$read_data.fileup_path}">{$read_data.file_name}&nbsp;<b>[ 다운로드 ]</b></a>
		</p>
		<p style="display:{$read_data.img_display};max-width:{$read_data.img_width}"><img src="{$read_data.fileup_path}" width="100%" border="0"></p>
		<p>{$read_data.comment}</p>
	</div>		
</div>
<div class="board-buttons">
	<a href="board.php?board={$req_data.board}&board_grg={$req_data.board_grg}&passover={$req_data.passover}&page={$req_data.page}&find={$req_data.find}&search={$req_data.search}&action=list"><img src="{$skin_dir}/images/btn_list.gif" width="51px" height="23px" border="0px"></a>
	<a href="board.php?&board={$req_data.board}&board_grg={$req_data.board_grg}&action=write"><img src="{$skin_dir}/images/btn_write.gif" width="62" height="23" border="0"></a> <a href="board.php?board={$req_data.board}&board_grg={$req_data.board_grg}&id={$req_data.id}&igroup={$req_data.igroup}&ssunseo={$req_data.ssunseo}&action=reply"><img src="{$skin_dir}/images/btn_answer.gif" width="51" height="23" border="0"></a>&nbsp;<a href="board.php?board={$req_data.board}&board_grg={$req_data.board_grg}&id={$req_data.id}&sid={$req_data.sid}&action=modify"><img src="{$skin_dir}/images/btn_edit.gif" border="0"></a>&nbsp;<a href="board.php?board={$req_data.board}&board_grg={$req_data.board_grg}&id={$req_data.id}&action=deletepass"><img src="{$skin_dir}/images/btn_del.gif" width="51" height="23" border="0"></a>
</div>
<div class="board-adminsetup" style="display:{$read_data.opkey_display};width:{$group_data.width}">
{include file="$opkey_skin_path"}
</div>
<div class="board-tail" style="display:{$read_data.tail_display};width:{$group_data.width}">
{include file="$tail_skin_path"}
</div>
<script type="text/javascript" src="{$skin_dir}/js/board.read.js"></script>
