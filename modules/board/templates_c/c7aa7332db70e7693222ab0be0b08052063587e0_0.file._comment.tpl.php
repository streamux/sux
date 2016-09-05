<?php
/* Smarty version 3.1.30, created on 2016-09-04 16:36:53
  from "/Applications/MAMP/htdocs/sux/modules/board/skin/default/_comment.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57cc3185cae378_19990760',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c7aa7332db70e7693222ab0be0b08052063587e0' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/skin/default/_comment.tpl',
      1 => 1472999788,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57cc3185cae378_19990760 (Smarty_Internal_Template $_smarty_tpl) {
?>
	<div class="panel-write">
		<form action="board.php?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&board=<?php echo $_smarty_tpl->tpl_vars['board']->value;?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['board_grg']->value;?>
&igroup=<?php echo $_smarty_tpl->tpl_vars['igroup']->value;?>
&passover=<?php echo $_smarty_tpl->tpl_vars['passover']->value;?>
&sid=<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
&action=record_writecomment" method="post" name="musimsl" onSubmit="return musimsl_check(this);">
		<dl>
			<dt>댓글 쓰기</dt>
			<dd class="form-heading">
				<span>이름</span>
				<input type="text" name="nickname" size="10" maxlength="20" value="">&nbsp;
				<span>비밀번호</span>
				<input type="password" name="pass" size="8" maxlength="8" value="">
			</dd>
			<dd class="form-comment">
				<textarea name="comment" cols="64" rows="5"></textarea>
			</dd>
			<dd class="form-buttons">
				<input type="submit" name="comfirm" value="댓글등록">
				<input type="reset" name="rewrite" value="다시쓰기">
			</dd>
		</dl>		
		</form>
	</div>
	<div class="panel-list">
		<dl>
			<dt>댓글 <?php echo $_smarty_tpl->tpl_vars['data']->value['tail_nums'];?>
</dt>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['tail_rows'], 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
			<dd>
				<?php echo $_smarty_tpl->tpl_vars['item']->value['nickname'];?>
 - 
				<span class="grgcomment"><?php echo $_smarty_tpl->tpl_vars['item']->value['comment'];?>
</span>
				<span class="date"><?php echo $_smarty_tpl->tpl_vars['item']->value['day'];?>
</span>
				<a href="board.php?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&board=<?php echo $_smarty_tpl->tpl_vars['board']->value;?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['board_grg']->value;?>
&grgid=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
&igroup=<?php echo $_smarty_tpl->tpl_vars['igroup']->value;?>
&passover=<?php echo $_smarty_tpl->tpl_vars['passover']->value;?>
&action=deletecomment">[삭제]</a>
			</dd>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

		</dl>
	</div>		<?php }
}
