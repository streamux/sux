<?php
/* Smarty version 3.1.30, created on 2017-01-04 07:23:53
  from "/Applications/MAMP/htdocs/sux/modules/board/skin/default/_comment.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_586c94f9d21ab2_84919366',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c7aa7332db70e7693222ab0be0b08052063587e0' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/skin/default/_comment.tpl',
      1 => 1482303296,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_586c94f9d21ab2_84919366 (Smarty_Internal_Template $_smarty_tpl) {
?>
	<div class="panel-write">
		<form action="<?php echo $_smarty_tpl->tpl_vars['uri']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['contentData']->value['id'];?>
/comment" name="f_comment" method="post">
		<input type="hidden" name="_method" value="insert">
		<input type="hidden" name="content_id" value="content_id : <?php echo $_smarty_tpl->tpl_vars['contentData']->value['id'];?>
">
		<dl>
			<dt>댓글 쓰기</dt>
			<dd class="form-heading">
				<span>이름</span>
				<input type="text" name="nickname" size="10" maxlength="20" value="임꺽정">&nbsp;
				<span>비밀번호</span>
				<input type="password" name="password" size="8" maxlength="8" value="12">
			</dd>
			<dd class="form-comment">
				<textarea name="comment" cols="64" rows="5">내용 입력 테스트 글 입니다.</textarea>
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
			<dt>댓글 <?php echo $_smarty_tpl->tpl_vars['commentData']->value['num'];?>
</dt>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['commentData']->value['list'], 'item');
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
				<a href="<?php echo $_smarty_tpl->tpl_vars['uri']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['contentData']->value['id'];?>
/delete-comment/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">[삭제]</a>
			</dd>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

		</dl>
	</div>		<?php }
}
