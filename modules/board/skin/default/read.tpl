<div class="board-read" style="width:{$groupData.width}">
	<div class="panel-heading">
		<p class="title">{$documentData.title}</p>
		<p class="sub-info">{$documentData.name} &nbsp; {$documentData.date} &nbsp; 조회 {$documentData.hit}</p>
	</div>
	<div class="panel-body">
		<p class="{$documentData.css_down}">
			<a href="{$documentData.fileup_path}">{$documentData.file_name}&nbsp;<b>[ 다운로드 ]</b></a>
		</p>
		<p style="max-width:{$documentData.css_img_width}" class="{$documentData.css_img}"><img src="{$documentData.fileup_path}" width="100%" border="0"></p>
		<p>{$documentData.comment}</p>
	</div>		
</div>
<div class="board-buttons">
	<a href="board.php?board={$requestData.board}&board_grg={$requestData.board_grg}&passover={$requestData.passover}&page={$requestData.page}&find={$requestData.find}&search={$requestData.search}&action=list"><img src="{$skinDir}/images/btn_list.gif" width="51px" height="23px" border="0px"></a>
	<a href="board.php?&board={$requestData.board}&board_grg={$requestData.board_grg}&action=write"><img src="{$skinDir}/images/btn_write.gif" width="62" height="23" border="0"></a> <a href="board.php?board={$requestData.board}&board_grg={$requestData.board_grg}&id={$requestData.id}&igroup={$requestData.igroup}&ssunseo={$requestData.ssunseo}&action=reply"><img src="{$skinDir}/images/btn_answer.gif" width="51" height="23" border="0"></a>&nbsp;<a href="board.php?board={$requestData.board}&board_grg={$requestData.board_grg}&id={$requestData.id}&sid={$requestData.sid}&action=modify"><img src="{$skinDir}/images/btn_edit.gif" border="0"></a>&nbsp;<a href="board.php?board={$requestData.board}&board_grg={$requestData.board_grg}&id={$requestData.id}&action=deletepass"><img src="{$skinDir}/images/btn_del.gif" width="51" height="23" border="0"></a>
</div>
<div style="width:{$groupData.width}" class="board-adminsetup {$documentData.css_opkey}">
{include file="$opkeySkinPath"}
</div>
<div style="width:{$groupData.width}" class="board-tail {$documentData.css_tail}">
{include file="$tailSkinPath"}
</div>
<script type="text/javascript" src="{$skinDir}/js/board.read.js"></script>
