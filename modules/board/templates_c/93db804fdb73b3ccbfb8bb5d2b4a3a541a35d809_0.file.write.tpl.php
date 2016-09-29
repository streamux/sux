<?php
/* Smarty version 3.1.30, created on 2016-09-25 08:53:56
  from "/Applications/MAMP/htdocs/sux/modules/board/skin/default/write.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57e774840da206_17231484',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '93db804fdb73b3ccbfb8bb5d2b4a3a541a35d809' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/skin/default/write.tpl',
      1 => 1474786385,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57e774840da206_17231484 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('groupData', $_smarty_tpl->tpl_vars['documentData']->value['group']);
$_smarty_tpl->_assignInScope('contentData', $_smarty_tpl->tpl_vars['documentData']->value['contents']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"게시물 쓰기 - StreamUX"), 0, true);
?>

<div class="board-write" style="width:<?php echo $_smarty_tpl->tpl_vars['groupData']->value['width'];?>
">
	<form action="board.php?board=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board_grg'];?>
&action=recordWrite" method="post"  name="f_board_write" enctype="multipart/form-data" onSubmit="return jsux.fn.write.checkDocumentForm(this);">

	<div class="panel-heading">
		<p>
			<label for="name" class="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['css_user_label'];?>
">이름</label>
			<input type="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['user_name_type'];?>
" name="name" id="name" maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['user_name'];?>
">
		</p>
		<p>
			<label for="pass" class="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['css_user_label'];?>
">비번</label>
			<input type="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['user_pass_type'];?>
" name="pass" id="pass" maxlength="10" value="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['user_password'];?>
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
			<span><input type="radio" name="type" id="radio_type_text" value="text" <?php echo $_smarty_tpl->tpl_vars['contentData']->value['comment_type_text'];?>
><label for="radio_type_text">TEXT</label></span>
			<span><input type="radio" name="type" id="radio_type_html" value="html" <?php echo $_smarty_tpl->tpl_vars['contentData']->value['comment_type_html'];?>
><label for="radio_type_html">HTML</label></span>	
		</p>
		<textarea name="comment" id="comment" cols="64" rows="14"></textarea>
	</div>
	<div class="panel-footer">
		<p class="ui-imgup">
			<label for="imgup_pick">첨부파일</label> <input type="file" name="imgup" id="imgup_pick">
		</p>
		<span class="ui-wallkey">
			<label for="wall_key">등록키 [ <span class="color-red font-weight-bold"><?php echo $_smarty_tpl->tpl_vars['contentData']->value['wallname'];?>
</span> ]</label>
			<input type="text" name="wall" id="wall_key" size="16" maxlength="20">			
			<input type="hidden" name="wallok" value="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['wallname'];?>
">
			<input type="hidden" name="wallwd" value="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['wallkey'];?>
">
		</span>
		<span class="ui-inlineblock">등록키를 입력해주세요.</span>
	</div>
	<div class="panel-buttons">
		<input name="imageField" type="image" src="<?php echo $_smarty_tpl->tpl_vars['skinPathList']->value['dir'];?>
/images/btn_confirm.gif" width="51" height="23" border="0">&nbsp;<a href="javascript:history.back();"><img src="<?php echo $_smarty_tpl->tpl_vars['skinPathList']->value['dir'];?>
/images/btn_cancel.gif" width="51" height="23" border="0"></a>
	</div>
	</form>
</div>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
