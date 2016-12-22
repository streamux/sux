<?php
/* Smarty version 3.1.30, created on 2016-12-21 10:33:19
  from "/Applications/MAMP/htdocs/sux/modules/document/contents/userguide.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_585a4c5f3628a6_89596344',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '09cb9890d32578cf22266135e514b77682017161' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/document/contents/userguide.tpl',
      1 => 1482312589,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_585a4c5f3628a6_89596344 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('rootPath', $_smarty_tpl->tpl_vars['skinPathList']->value['root']);
$_smarty_tpl->_assignInScope('title', $_smarty_tpl->tpl_vars['groupData']->value['document_name']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->tpl_vars['title']->value)." :: 사용자 가이드 - STREAMUX"), 0, true);
?>


사용자가이드 내용 

<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<?php }
}
