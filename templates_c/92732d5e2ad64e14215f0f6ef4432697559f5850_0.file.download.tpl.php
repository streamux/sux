<?php
/* Smarty version 3.1.30, created on 2017-01-04 07:25:48
  from "/Applications/MAMP/htdocs/sux/modules/document/contents/download.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_586c956c7fe486_27936398',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '92732d5e2ad64e14215f0f6ef4432697559f5850' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/document/contents/download.tpl',
      1 => 1482996559,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_586c956c7fe486_27936398 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('rootPath', $_smarty_tpl->tpl_vars['skinPathList']->value['root']);
$_smarty_tpl->_assignInScope('title', $_smarty_tpl->tpl_vars['groupData']->value['document_name']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->tpl_vars['title']->value)." :: 다운로드 - STREAMUX"), 0, true);
?>


다운로드 내용 

<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<?php }
}
