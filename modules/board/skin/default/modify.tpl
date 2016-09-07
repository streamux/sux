<div class="board-write" style="width:{$group_data.width}">
	<form action="board.php?board={$req_data.board}&board_grg={$req_data.board_grg}&id={$req_data.id}&action=record_modify" method="post"  name="musimw" enctype="multipart/form-data" onSubmit="return musimw_check(this);">

	<div class="panel-heading">
		<p>
			<label for="name" class="{$modify_data.user_label_display}">이름</label>
			<input type="{$modify_data.user_name_type}" name="name" id="name" maxlength="20" value="{$modify_data.name}">
		</p>
		<p>
			<label for="pass" class="{$modify_data.user_label_display}">비번</label>
			<input type="{$modify_data.user_pass_type}" name="pass" id="pass" maxlength="10" value="{$modify_data.pass}">
		</p>
		<p>
			<label for="title">제목</label>
			<input type="text" name="title" id="title" maxlength="50" value="{$modify_data.title}">
		</p>
		<p>
			<label for="email">이메일</label>
			<input type="text" name="email" id="email" maxlength="28" value="{$modify_data.email}">			
		</p>
	</div>
	<div class="panel-body">
		<p>
			<span class="ui-label-width"><label for="comment">내용</label></span>
			<span><input type="radio" name="type" id="radio_type_text" value="text" {$modify_data.comment_type_text}><label for="radio_type_text">TEXT</label></span>
			<span><input type="radio" name="type" id="radio_type_html" value="html" {$modify_data.comment_type_html}><label for="radio_type_html">HTML</label></span>
		</p>
		<textarea name="comment" id="comment" cols="64" rows="14">{$modify_data.comment}</textarea>
	</div>
	<div class="panel-footer">
		<p class="ui-imgup">
			첨부파일&nbsp;<input type="file" name="imgup">			
		</p>
	</div>
	<div class="panel-buttons">
		<input name="imageField" type="image" src="{$skin_dir}/images/btn_confirm.gif" width="51" height="23" border="0">&nbsp;<a href="javascript:history.back();"><img src="{$skin_dir}/images/btn_cancel.gif" width="51" height="23" border="0"></a>
	</div>
	</form>
</div>

<script type="text/javascript" src="{$skin_dir}/js/board.modify.js"></script>
