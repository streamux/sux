<?php
/* Smarty version 3.1.30, created on 2016-12-18 08:39:42
  from "/Applications/MAMP/htdocs/sux/modules/analytics/tpl/admin_pageview_delete.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58563d3edfbf27_42519227',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c29f70a40eb5067a6d96bba7a9958f9da5ed6f23' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/analytics/tpl/admin_pageview_delete.tpl',
      1 => 1482046782,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58563d3edfbf27_42519227 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('rootPath', $_smarty_tpl->tpl_vars['skinPathList']->value['root']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX관리자 페이지뷰 삭제 - StreamUX"), 0, true);
?>

<div class="articles ui-edgebox">
	<div class="del">
		<div class="tt">
			<div class="imgbox">
				<h1>페이지뷰 삭제 확인</h1>	
			</div>
		</div>
		<div class="box">
			<ul>
				<li>
					<img src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/admin/tpl/images/icon_stop.gif" width="30" height="13" alt="경고아이콘" class="icon">
					<span class="title1"><?php echo $_smarty_tpl->tpl_vars['documentData']->value['name'];?>
 페이지뷰를 정말로 삭제 하시겠습니까?</span>
					<input type="hidden" name="id" value=<?php echo $_smarty_tpl->tpl_vars['documentData']->value['id'];?>
>
					<input type="hidden" name="keyword" value=<?php echo $_smarty_tpl->tpl_vars['documentData']->value['name'];?>
>
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
?>

<?php }
}
