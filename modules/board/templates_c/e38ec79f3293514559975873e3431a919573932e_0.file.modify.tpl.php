<?php
/* Smarty version 3.1.30, created on 2016-09-05 11:22:14
  from "/Applications/MAMP/htdocs/sux/modules/board/skin/default/modify.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57cd3946560308_58378465',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e38ec79f3293514559975873e3431a919573932e' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/skin/default/modify.tpl',
      1 => 1473067333,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57cd3946560308_58378465 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="board-write" style="width:<?php echo $_smarty_tpl->tpl_vars['width']->value;?>
">
	<form action="board.php?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&board=<?php echo $_smarty_tpl->tpl_vars['board']->value;?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['board_grg']->value;?>
&action=record_modify" method="post"  name="musimw" enctype="multipart/form-data" onSubmit="return musimw_check(this);">

	<div class="panel-heading">
		<p>	
			<label for="name">이름</label>
			<input type="text" name="name" id="name" maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
">
		</p>
		<p>
			<label for="pass">비번</label>
			<input type="password" name="pass" id="pass" maxlength="10" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['pass'];?>
">
		</p>
		<p>
			<label for="title">제목</label>
			<input type="text" name="title" id="title" maxlength="50" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
">
		</p>
		<p>
			<label for="email">이메일</label>
			<input type="text" name="email" id="email" maxlength="28" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
">
			<p class="color-red hide">※e-mail은 필수입력 사항입니다.</p>
		</p>
	</div>
	<div class="panel-body">
		<p>
			<span class="ui-label-width"><label for="comment">내용</label></span>
			<span><input type="radio" name="type" id="radio_type_text" value="text" <?php echo $_smarty_tpl->tpl_vars['data']->value['comment_type_text'];?>
><label for="radio_type_text">TEXT</label></span>
			<span><input type="radio" name="type" id="radio_type_html" value="html" <?php echo $_smarty_tpl->tpl_vars['data']->value['comment_type_html'];?>
><label for="radio_type_html">HTML</label></span>			
			<span><input type="radio" name="type" id="radio_type_all" value="text" <?php echo $_smarty_tpl->tpl_vars['data']->value['comment_type_all'];?>
><label for="radio_type_all">TEXT + HTML</label></span>
		</p>
		<textarea name="comment" id="comment" cols="64" rows="14"><?php echo $_smarty_tpl->tpl_vars['data']->value['comment'];?>
</textarea>
	</div>
	<div class="panel-footer">
		<p class="ui-imgup">
			첨부파일&nbsp;<input type="file" name="imgup">			
		</p>
	</div>
	<div class="panel-buttons">
		<input name="imageField" type="image" src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/btn_confirm.gif" width="51" height="23" border="0">&nbsp;<a href="javascript:history.back();"><img src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/btn_cancel.gif" width="51" height="23" border="0"></a>
	</div>
	</form>
</div>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/js/board.modify.js"><?php echo '</script'; ?>
>
<?php }
}
