<?php
/* Smarty version 3.1.30, created on 2017-01-10 09:58:55
  from "/Applications/MAMP/htdocs/sux/modules/board/tpl/admin_delete.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5874a24f460dd7_59400190',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4e68e2a0385c623425c8145a41dcc9ca2166d9ad' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/tpl/admin_delete.tpl',
      1 => 1484038733,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5874a24f460dd7_59400190 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('rootPath', $_smarty_tpl->tpl_vars['skinPathList']->value['root']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX관리자 게시판 삭제 - StreamUX"), 0, true);
?>

<div class="articles ui-edgebox">
	<div class="del">
		<h2 class="blind">게시판 삭제 알림</h2>
		<div class="tt">
			<div class="imgbox">
				<span>게시판 삭제 알림</span>	
			</div>
		</div>
		<div class="box">
			<ul>
				<li>
					<img src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/admin/tpl/images/icon_stop.gif" width="30" height="13" alt="경고아이콘" class="icon">
					<span class="title1"><?php echo $_smarty_tpl->tpl_vars['documentData']->value['category'];?>
 게시판을 정말로 삭제 하시겠습니까?</span>
					<input type="hidden" name="_method" value="delete">
					<input type="hidden" name="category" value="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['category'];?>
">
					<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['id'];?>
">
				</li>
				<li>
					<span class="title2">다시한번 잘 확인해 주세요.</span>
					<a href="#" data-key="del" class="button-del"><span>[삭제]</span></a>
					<a href="#" data-key="back" class="button-cancel"><span>[취소]</span></a>		
				</li>
			</ul>
		</div>
	</div>
</div>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
