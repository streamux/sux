<?php
/* Smarty version 3.1.30, created on 2016-09-26 05:20:13
  from "/Applications/MAMP/htdocs/sux/modules/admin/tpl/_admin_header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57e893ed59ed85_02328595',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6aaeceb1e0e46457fee872882f2d09fef2867d8c' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/admin/tpl/_admin_header.tpl',
      1 => 1474859977,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57e893ed59ed85_02328595 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=2.0">
	<link rel="stylesheet" type="text/css" href="../admin/tpl/css/default.css">
	<link rel="stylesheet" type="text/css" href="../admin/tpl/css/<?php echo $_smarty_tpl->tpl_vars['requestData']->value['pagetype'];?>
.css">	
</head>
<body>
<div class="wrapper">
	<div class="header">		
		<div class="util"></div>
		<a href="../admin/index.php?action=main">
			<h1><img class="logo" src="../admin/tpl/images/logo.png" alt="streamxux 로고"></h1>
		</a>
		<div id="gnbIcon" class="gnb-icon"></div>
		<div class="gnb-case">					
			<div id="gnb" class="gnb"></div>
		</div>
	</div><?php }
}
