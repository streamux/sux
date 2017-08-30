<?php
/* Smarty version 3.1.31, created on 2017-08-30 12:02:40
  from "/Applications/MAMP/htdocs/sux/files/document/download.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_59a68d40e2a802_13107387',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e202b0e021175ad1495eaae5ece46fd78f0df562' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/files/document/download.tpl',
      1 => 1504060416,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59a68d40e2a802_13107387 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('rootPath', $_smarty_tpl->tpl_vars['skinPathList']->value['root']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"download - LOCALHOST"), 0, true);
?>

<!-- contents start -->

내용을 입력해주세요.

<!-- contents end -->
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
