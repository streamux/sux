<?php
/* Smarty version 3.1.30, created on 2017-01-12 02:32:56
  from "/Applications/MAMP/htdocs/sux/modules/member/tpl/admin_groupdelete.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5876dcc8ce37d0_52106677',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a4f39cd56273b1bcdb248ed7c70d16c931f779d7' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/member/tpl/admin_groupdelete.tpl',
      1 => 1483518983,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5876dcc8ce37d0_52106677 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('rootPath', $_smarty_tpl->tpl_vars['skinPathList']->value['root']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX관리자 회원그룹삭제 - StreamUX"), 0, true);
?>

<div class="articles ui_edgebox">
	<div class="del">
		<div class="tt">
			<div class="imgbox">
				<h1>회원그룹 삭제</h1>	
			</div>
		</div>
		<div class="box">
			<ul>
				<li>
					<img src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/admin/tpl/images/icon_stop.gif" width="30" height="13" alt="경고아이콘" class="icon">
					<span class="title1"><?php echo $_smarty_tpl->tpl_vars['id']->value;?>
 회원그룹을 정말로 삭제 하시겠습니까?</span>
					<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['requestData']->value['id'];?>
">
				</li>
				<li>
					<span class="title2">다시한번 잘 확인해 주세요.</span>
					<a href="#" data-key="del" class="button_del"><span>[삭제]</span></a>
					<a href="#" data-key="back" class="button_cancel"><span>[취소]</span></a>		
				</li>
			</ul>
		</div>
	</div>
</div>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
