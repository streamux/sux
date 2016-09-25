<?php
/* Smarty version 3.1.30, created on 2016-09-25 08:57:19
  from "/Applications/MAMP/htdocs/sux/modules/board/skin/default/modify.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57e7754f60e694_16287846',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e38ec79f3293514559975873e3431a919573932e' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/skin/default/modify.tpl',
      1 => 1474786545,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57e7754f60e694_16287846 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('groupData', $_smarty_tpl->tpl_vars['documentData']->value['group']);
$_smarty_tpl->_assignInScope('contentData', $_smarty_tpl->tpl_vars['documentData']->value['contents']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"게시물 수정 - StreamUX"), 0, true);
?>

<div class="board-write" style="width:<?php echo $_smarty_tpl->tpl_vars['groupData']->value['width'];?>
">
	<form action="board.php?board=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board_grg'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['id'];?>
&action=recordModify" method="post"  name="f_board_modify" enctype="multipart/form-data" onSubmit="return jsux.fn.modify.checkDocumentForm(this);">

	<div class="panel-heading">
		<p>
			<label for="name">이름</label>
			<input type="text" name="name" id="name" maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['user_name'];?>
">
		</p>
		<p>
			<label for="pass">비번</label>
			<input type="password" name="pass" id="pass" maxlength="10" value="">
		</p>
		<p>
			<label for="title">제목</label>
			<input type="text" name="title" id="title" maxlength="50" value="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['title'];?>
">
		</p>
		<p>
			<label for="email">이메일</label>
			<input type="text" name="email" id="email" maxlength="28" value="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['email'];?>
">			
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
		<textarea name="comment" id="comment" cols="64" rows="14"><?php echo $_smarty_tpl->tpl_vars['contentData']->value['comment'];?>
</textarea>
	</div>
	<div class="panel-footer">
		<p class="ui-imgup">
			첨부파일&nbsp;<input type="file" name="imgup">			
		</p>
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
