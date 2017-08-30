<?php
/* Smarty version 3.1.31, created on 2017-08-30 11:20:42
  from "/Applications/MAMP/htdocs/sux/modules/admin/tpl/_header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_59a6836a903817_39713614',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a75ee3a5102393d38e6649a4db43d00e0b559eab' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/admin/tpl/_header.tpl',
      1 => 1488852504,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59a6836a903817_39713614 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, height=device-height, maximum-scale=2.0">
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
common/css/sux_default.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
common/css/sux_common.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/admin/tpl/css/layout.css">
	<?php if ($_smarty_tpl->tpl_vars['documentData']->value['module_code'] != '') {?>
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/admin/tpl/css/<?php echo $_smarty_tpl->tpl_vars['documentData']->value['module_code'];?>
.css">
	<?php }?>
</head>
<body>
<div class="wrapper">
	<div class="header">		
		<div class="util"></div>
		<a href="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
admin-admin">
			<h1><img class="logo" src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/admin/tpl/images/logo.png" alt="streamxux"></h1>
		</a>
		<div id="gnbIcon" class="gnb-icon"></div>
		<div class="gnb-case">					
			<div id="gnb" class="gnb"></div>
		</div>
	</div>
	<div class="container"><?php }
}
