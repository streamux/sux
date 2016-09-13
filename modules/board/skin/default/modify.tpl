<div class="board-write" style="width:{$groupData.width}">
	<form action="board.php?board={$requestData.board}&board_grg={$requestData.board_grg}&id={$requestData.id}&action=record_modify" method="post"  name="f_board_modify" enctype="multipart/form-data" onSubmit="return jsux.fn.boardModify.checkDocumentForm(this);">

	<div class="panel-heading">
		<p>
			<label for="name" class="{$documentData.css_user_label}">이름</label>
			<input type="{$documentData.user_name_type}" name="name" id="name" maxlength="20" value="{$documentData.user_name}">
		</p>
		<p>
			<label for="pass" class="{$documentData.css_user_label}">비번</label>
			<input type="{$documentData.user_pass_type}" name="pass" id="pass" maxlength="10" value="{$documentData.user_password}">
		</p>
		<p>
			<label for="title">제목</label>
			<input type="text" name="title" id="title" maxlength="50" value="{$documentData.title}">
		</p>
		<p>
			<label for="email">이메일</label>
			<input type="text" name="email" id="email" maxlength="28" value="{$documentData.email}">			
		</p>
	</div>
	<div class="panel-body">
		<p>
			<span class="ui-label-width"><label for="comment">내용</label></span>
			<span><input type="radio" name="type" id="radio_type_text" value="text" {$documentData.comment_type_text}><label for="radio_type_text">TEXT</label></span>
			<span><input type="radio" name="type" id="radio_type_html" value="html" {$documentData.comment_type_html}><label for="radio_type_html">HTML</label></span>
		</p>
		<textarea name="comment" id="comment" cols="64" rows="14">{$documentData.comment}</textarea>
	</div>
	<div class="panel-footer">
		<p class="ui-imgup">
			첨부파일&nbsp;<input type="file" name="imgup">			
		</p>
	</div>
	<div class="panel-buttons">
		<input name="imageField" type="image" src="{$skinDir}/images/btn_confirm.gif" width="51" height="23" border="0">&nbsp;<a href="javascript:history.back();"><img src="{$skinDir}/images/btn_cancel.gif" width="51" height="23" border="0"></a>
	</div>
	</form>
</div>

<script type="text/javascript" src="{$skinDir}/js/board.modify.js"></script>
