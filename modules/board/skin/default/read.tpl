<div class="board-read" style="width:{$width}">
	<div class="panel-heading">
		<p class="title">{$data.title}</p>
		<p class="sub-info">{$data.name} &nbsp; {$data.date} &nbsp; 조회 {$data.hit}</p>
	</div>
	<div class="panel-body">
		<p style="display:{$data.down_display}">
			<a href="../../board_data/{$board}/{$filename}">{$data.filename}&nbsp;<b>[ 다운로드 ]</b></a>
		</p>
		<p style="display:{$data.img_display};max-width:{$data.img_width}"><img src="../../board_data/{$data.fileup_path}" width="100%" border="0"></p>
		<p>{$data.comment}</p>
	</div>		
</div>
<div class="board-buttons">
	<a href="board.php?board={$board}&board_grg={$board_grg}&passover={$passover}&page={$page}&find={$find}&search={$search}&action=list"><img src="{$skin_dir}/images/btn_list.gif" width="51px" height="23px" border="0px"></a>
	<a href="board.php?&board={$board}&board_grg={$board_grg}&action=write"><img src="{$skin_dir}/images/btn_write.gif" width="62" height="23" border="0"></a> <a href="board.php?board={$board}&board_grg={$board_grg}&id={$id}&action=reply"><img src="{$skin_dir}/images/btn_answer.gif" width="51" height="23" border="0"></a>&nbsp;<a href="board.php?id={$id}&board={$board}&board_grg={$board_grg}&sid={$sid}&action=modify"><img src="{$skin_dir}/images/btn_edit.gif" border="0"></a>&nbsp;<a href="board.php?id={$id}&board={$board}&board_grg={$board_grg}&action=deletepass"><img src="{$skin_dir}/images/btn_del.gif" width="51" height="23" border="0"></a>
</div>
<div class="board-adminsetup" style="display:{$data.opkey};width:{$width}">
{include file="$opkey_skin_path"}
</div>
<div class="board-tail" style="display:{$data.tail};width:{$width}">
{include file="$tail_skin_path"}
</div>
<script type="text/javascript" src="{$skin_dir}/js/board.read.js"></script>
