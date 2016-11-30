<?php
/* Smarty version 3.1.30, created on 2016-11-24 14:31:10
  from "/Applications/MAMP/htdocs/sux/modules/board/skin/default/_tail.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5836eb9e60db36_73084431',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c3e50f7fe370c97fd981c08492204dcc5fc6082b' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/skin/default/_tail.tpl',
      1 => 1475136773,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5836eb9e60db36_73084431 (Smarty_Internal_Template $_smarty_tpl) {
?>
	<div class="panel-write">
		<form action="board.php?board=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board_grg'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['id'];?>
&igroup=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['igroup'];?>
&passover=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['passover'];?>
&sid=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['sid'];?>
&action=recordWriteTail" method="post" name="f_board_write_tail" onSubmit="return jsux.fn.read.checkTailDocumentForm(this);">
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
			<dt>댓글 <?php echo $_smarty_tpl->tpl_vars['tailData']->value['num'];?>
</dt>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tailData']->value['list'], 'item');
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
				<a href="board.php?board=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board_grg'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['id'];?>
&grgid=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
&igroup=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['igroup'];?>
&passover=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['passover'];?>
&action=deleteTail">[삭제]</a>
			</dd>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

		</dl>
	</div>		<?php }
}
