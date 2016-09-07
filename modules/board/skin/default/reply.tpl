<div class="board-read" style="width:{$group_data.width}">
	<div class="panel-heading">
		<p class="title">{$reply_data.title}</p>
		<p class="sub-info">{$reply_data.name} &nbsp; {$reply_data.date} &nbsp; 조회 {$reply_data.hit}</p>
	</div>
	<div class="panel-body">
		<p style="display:{$reply_data.down_display}">
			<a href="{$reply_data.fileup_path}">{$reply_data.fileup_name}&nbsp;<b>[ 다운로드 ]</b></a>
		</p>
		<p style="display:{$reply_data.img_display};max-width:{$reply_data.img_width}"><img src="{$reply_data.fileup_path}" width="100%" border="0"></p>
		<p>{$reply_data.comment}</p>
	</div>		
</div>

<div class="board-write" style="width:{$group_data.width}">
	<form action="board.php?board={$req_data.board}&board_grg={$req_data.board_grg}&id={$req_data.id}&igroup={$req_data.igroup}&ssunseo={$req_data.ssunseo}&action=record_reply" method="post"  name="musimw" enctype="multipart/form-data" onSubmit="return musimw_check(this);">
	<div class="panel-heading">
		<p>
			<label for="name" class="{$reply_data.user_label_display}">이름</label>
			<input type="{$reply_data.user_name_type}" name="name" id="name" maxlength="20" value="{$ses_data.ljs_name}">
		</p>
		<p>
			<label for="pass" class="{$reply_data.user_label_display}">비번</label>
			<input type="{$reply_data.user_pass_type}" name="pass" id="pass" maxlength="10" value="{$ses_data.ljs_pass1}">
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
			<span><input type="radio" name="type" id="radio_type_text" value="text" {$reply_data.comment_type_text}><label for="radio_type_text">TEXT</label></span>
			<span><input type="radio" name="type" id="radio_type_html" value="html" {$reply_data.comment_type_html}><label for="radio_type_html">HTML</label></span>
		</p>
		<textarea name="comment" id="comment" cols="64" rows="14"></textarea>
	</div>
	<div class="panel-footer">
		<p class="ui-imgup">
			<label for="imgup_pick">첨부파일</label> <input type="file" name="imgup" id="imgup_pick">
		</p>
		<span class="ui-wallkey">
			<label for="wall_key">등록키 [ <span class="color-red font-weight-bold">{$reply_data.wallname}</span> ]</label>
			<input type="text" name="wall" id="wall_key" size="16" maxlength="20">			
			<input type="hidden" name="wallok" value="{$reply_data.wallname}">
			<input type="hidden" name="wallwd" value="{$reply_data.wallkey}">
		</span>
		<span class="ui-inlineblock">등록키를 입력해주세요.</span>
	</div>
	<div class="panel-buttons">
		<input name="imageField" type="image" src="{$skin_dir}/images/btn_confirm.gif" width="51" height="23" border="0">&nbsp;<a href="javascript:history.back();"><img src="{$skin_dir}/images/btn_cancel.gif" width="51" height="23" border="0"></a>
	</div>
	</form>
</div>

<script type="text/javascript" src="{$skin_dir}/js/board.reply.js"></script>

