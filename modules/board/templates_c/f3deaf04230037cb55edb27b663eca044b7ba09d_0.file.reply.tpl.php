<?php
/* Smarty version 3.1.30, created on 2016-09-09 11:17:43
  from "/Applications/MAMP/htdocs/sux/modules/board/skin/default/reply.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57d27e379cfda0_53860278',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f3deaf04230037cb55edb27b663eca044b7ba09d' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/skin/default/reply.tpl',
      1 => 1473412661,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d27e379cfda0_53860278 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="board-read" style="width:<?php echo $_smarty_tpl->tpl_vars['groupData']->value['width'];?>
">
	<div class="panel-heading">
		<p class="title"><?php echo $_smarty_tpl->tpl_vars['documentData']->value['title'];?>
</p>
		<p class="sub-info"><?php echo $_smarty_tpl->tpl_vars['documentData']->value['name'];?>
 &nbsp; <?php echo $_smarty_tpl->tpl_vars['documentData']->value['date'];?>
 &nbsp; 조회 <?php echo $_smarty_tpl->tpl_vars['documentData']->value['hit'];?>
</p>
	</div>
	<div class="panel-body">
		<p class="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['css_down'];?>
">
			<a href="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['fileup_path'];?>
"><?php echo $_smarty_tpl->tpl_vars['documentData']->value['fileup_name'];?>
&nbsp;<b>[ 다운로드 ]</b></a>
		</p>
		<p style="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['img_width'];?>
" class="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['css_img'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['fileup_path'];?>
" width="100%" border="0"></p>
		<p><?php echo $_smarty_tpl->tpl_vars['documentData']->value['comment'];?>
</p>
	</div>		
</div>
<div class="board-write" style="width:<?php echo $_smarty_tpl->tpl_vars['groupData']->value['width'];?>
">
	<form action="board.php?board=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board_grg'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['id'];?>
&igroup=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['igroup'];?>
&ssunseo=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['ssunseo'];?>
&action=record_reply" method="post"  name="f_board_reply" enctype="multipart/form-data" onSubmit="return jsux.fn.boardReply.checkDocumentForm(this);">
	<div class="panel-heading">
		<p>
			<label for="name" class="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['css_user_label'];?>
">이름</label>
			<input type="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['user_name_type'];?>
" name="name" id="name" maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['user_name'];?>
">
		</p>
		<p>
			<label for="pass" class="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['css_user_label'];?>
">비번</label>
			<input type="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['user_pass_type'];?>
" name="pass" id="pass" maxlength="10" value="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['user_password'];?>
">
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
			<span><input type="radio" name="type" id="radio_type_text" value="text" <?php echo $_smarty_tpl->tpl_vars['documentData']->value['comment_type_text'];?>
><label for="radio_type_text">TEXT</label></span>
			<span><input type="radio" name="type" id="radio_type_html" value="html" <?php echo $_smarty_tpl->tpl_vars['documentData']->value['comment_type_html'];?>
><label for="radio_type_html">HTML</label></span>
		</p>
		<textarea name="comment" id="comment" cols="64" rows="14"></textarea>
	</div>
	<div class="panel-footer">
		<p class="ui-imgup">
			<label for="imgup_pick">첨부파일</label> <input type="file" name="imgup" id="imgup_pick">
		</p>
		<span class="ui-wallkey">
			<label for="wall_key">등록키 [ <span class="color-red font-weight-bold"><?php echo $_smarty_tpl->tpl_vars['documentData']->value['wallname'];?>
</span> ]</label>
			<input type="text" name="wall" id="wall_key" size="16" maxlength="20">			
			<input type="hidden" name="wallok" value="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['wallname'];?>
">
			<input type="hidden" name="wallwd" value="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['wallkey'];?>
">
		</span>
		<span class="ui-inlineblock">등록키를 입력해주세요.</span>
	</div>
	<div class="panel-buttons">
		<input name="imageField" type="image" src="<?php echo $_smarty_tpl->tpl_vars['skinDir']->value;?>
/images/btn_confirm.gif" width="51" height="23" border="0">&nbsp;<a href="javascript:history.back();"><img src="<?php echo $_smarty_tpl->tpl_vars['skinDir']->value;?>
/images/btn_cancel.gif" width="51" height="23" border="0"></a>
	</div>
	</form>
</div>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['skinDir']->value;?>
/js/board.reply.js"><?php echo '</script'; ?>
>

<?php }
}
