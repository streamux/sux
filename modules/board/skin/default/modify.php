<link rel="stylesheet" type="text/css" href="../../common/css/common.css">
<link rel="stylesheet" type="text/css" href="<? echo ${skin_dir}; ?>/css/layout.css">

<div class="board-write" style="width:<? echo $width; ?>">
	<form action="board.php?id=<? echo ${id}; ?>&board=<? echo ${board}; ?>&board_grg=<? echo ${board_grg}; ?>&action=record_modify" method="post"  name="musimw" enctype="multipart/form-data" onSubmit="return musimw_check(this);">

	<div class="panel-heading">
		<input type="hidden" name="ljs_mod" value="modify">
		<p><span class="ui-label-width">이름</span><input type="text" name="m_name" maxlength="20" value="<? echo ${m_name}; ?>"></p>
		<p><span class="ui-label-width">비밀번호</span><input type="password" name="pass" maxlength="10" value=""></p>
		<p><span class="ui-label-width">제목</span><input type="text" name="storytitle" maxlength="50" value="<? echo ${storytitle}; ?>"></p>
		<p><span class="ui-label-width">이메일</span><input type="text" name="email" maxlength="28" value="<? echo ${email}; ?>">
<?
		if ($setup == 'y'){
			echo "<span class=\"color-red\">※e-mail은 필수입력 사항입니다.</span>";
		}
?>
		</p>
	</div>
	<div class="panel-body">
		<p>
			<span class="ui-label-width">내용</span>
			<span><input name="type" type="radio" value="html" <? if ($admin_type == 'html') echo "checked"; ?>>HTML</span>
			<span><input name="type" type="radio" value="text" <? if ($admin_type == 'text' || $admin_type == 'all') echo "checked"; ?>>TEXT</span>
			<span>※ 형식을 선택해주세요.<span>
		</p>
		<textarea name="storycomment" cols="64" rows="14"><? echo ${storycomment}; ?></textarea>
	</div>
	<div class="panel-footer">
		<p class="ui-imgup">
			첨부파일&nbsp;<input type="file" name="imgup">			
		</p>
	</div>
	<div class="buttons">
		<input name="imageField" type="image" src="<? echo ${skin_dir}; ?>/images/btn_confirm.gif" width="51" height="23" border="0">&nbsp;<a href="javascript:history.back();"><img src="<? echo ${skin_dir}; ?>/images/btn_cancel.gif" width="51" height="23" border="0"></a>
	</div>
	</form>
</div>

<script type="text/javascript" src="<? echo ${skin_dir}; ?>/js/board.modify.js"></script>
