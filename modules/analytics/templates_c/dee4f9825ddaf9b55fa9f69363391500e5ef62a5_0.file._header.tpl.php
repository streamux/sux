<?php
/* Smarty version 3.1.30, created on 2016-10-18 11:10:33
  from "/Applications/MAMP/htdocs/sux/modules/admin/tpl/_header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5805e70929dc81_92271230',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dee4f9825ddaf9b55fa9f69363391500e5ef62a5' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/admin/tpl/_header.tpl',
      1 => 1476166976,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5805e70929dc81_92271230 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=2.0">
	<link rel="stylesheet" type="text/css" href="../../common/css/sux_default.min.css">
	<link rel="stylesheet" type="text/css" href="../../common/css/sux_common.min.css">
	<link rel="stylesheet" type="text/css" href="../admin/tpl/css/layout.css">
	<link rel="stylesheet" type="text/css" href="../admin/tpl/css/<?php echo $_smarty_tpl->tpl_vars['requestData']->value['pagetype'];?>
.css">
</head>
<body>
<div class="wrapper">
	<div class="header">		
		<div class="util"></div>
		<a href="../admin/index.php?action=main">
			<h1><img class="logo" src="../admin/tpl/images/logo.png" alt="streamxux"></h1>
		</a>
		<div id="gnbIcon" class="gnb-icon"></div>
		<div class="gnb-case">					
			<div id="gnb" class="gnb"></div>
		</div>
	</div><?php }
}
