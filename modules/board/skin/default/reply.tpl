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

<div class="board-write" style="width:{$width}">
	<form action="board.php?id={$id}&board={$board}&board_grg={$board_grg}&action=record_reply" method="post"  name="musimw" enctype="multipart/form-data" onSubmit="return musimw_check(this);">

	<div class="panel-heading">
		<p>	
			<label for="name">이름</label>
			<input type="text" name="name" id="name" maxlength="20" value="{$data.name}">
		</p>
		<p>
			<label for="pass">비번</label>
			<input type="password" name="pass" id="pass" maxlength="10" value="{$data.pass}">
		</p>
		<p>
			<label for="title">제목</label>
			<input type="text" name="title" id="title" maxlength="50" value="">
		</p>
		<p>
			<label for="email">이메일</label>
			<input type="text" name="email" id="email" maxlength="28" value="">			
		</p>
	</div>
	<div class="panel-body">
		<p>
			<span class="ui-label-width"><label for="comment">내용</label></span>
			<span><input type="radio" name="type" id="radio_type_text" value="text" {$data.comment_type_text}><label for="radio_type_text">TEXT</label></span>
			<span><input type="radio" name="type" id="radio_type_html" value="html" {$data.comment_type_html}><label for="radio_type_html">HTML</label></span>			
			<span><input type="radio" name="type" id="radio_type_all" value="text" {$data.comment_type_all}><label for="radio_type_all">TEXT + HTML</label></span>
		</p>
		<textarea name="comment" id="comment" cols="64" rows="14"></textarea>
	</div>
	<div class="panel-footer">
		<p class="ui-imgup">
			<label for="imgup_pick">첨부파일</label> <input type="file" name="imgup" id="imgup_pick">
		</p>
		<span class="ui-wallkey">
			<label for="wall_key">등록키 [ <span class="color-red font-weight-bold">{$data.wallname}</span> ]</label>
			<input type="text" name="wall" id="wall_key" size="16" maxlength="20">			
			<input type="hidden" name="wallok" value="{$data.wallname}">
			<input type="hidden" name="wallwd" value="{$data.wallkey}">
		</span>
		<span class="ui-inlineblock">등록키를 입력해주세요.</span>
	</div>
	<div class="panel-buttons">
		<input name="imageField" type="image" src="{$skin_dir}/images/btn_confirm.gif" width="51" height="23" border="0">&nbsp;<a href="javascript:history.back();"><img src="{$skin_dir}/images/btn_cancel.gif" width="51" height="23" border="0"></a>
	</div>
	</form>
</div>

<script type="text/javascript" src="{$skin_dir}/js/board.reply.js"></script>

