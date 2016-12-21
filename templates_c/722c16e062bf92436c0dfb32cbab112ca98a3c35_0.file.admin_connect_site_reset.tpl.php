<?php
/* Smarty version 3.1.30, created on 2016-12-18 08:12:38
  from "/Applications/MAMP/htdocs/sux/modules/analytics/tpl/admin_connect_site_reset.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_585636e6d69072_37467057',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '722c16e062bf92436c0dfb32cbab112ca98a3c35' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/analytics/tpl/admin_connect_site_reset.tpl',
      1 => 1482045157,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_585636e6d69072_37467057 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('rootPath', $_smarty_tpl->tpl_vars['skinPathList']->value['root']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX관리자 접속키워드 초기화 - StreamUX"), 0, true);
?>

<div class="articles ui-edgebox">
	<div class="del">
		<div class="tt">
			<div class="imgbox">
				<h1>접속키워드 초기화 확인</h1>	
			</div>
		</div>
		<div class="box">
			<ul>
				<li>
					<img src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/admin/tpl/images/icon_stop.gif" width="30" height="13" alt="경고아이콘" class="icon">
					<span class="title1"><?php echo $_smarty_tpl->tpl_vars['documentData']->value['name'];?>
 접속키워드를 정말로 초기화 하시겠습니까?</span>
					<input type="hidden" name="id" value=<?php echo $_smarty_tpl->tpl_vars['documentData']->value['id'];?>
>
					<input type="hidden" name="keyword" value=<?php echo $_smarty_tpl->tpl_vars['documentData']->value['name'];?>
>
				</li>
				<li>
					<span class="title2">다시한번 잘 확인해 주세요.</span>
					<a href="#" data-key="reset" class="button-del"><span>[초기화]</span></a>
					<a href="#" data-key="back" class="button-cancel"><span>[취소]</span></a>		
				</li>
			</ul>
		</div>
	</div>
</div>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
