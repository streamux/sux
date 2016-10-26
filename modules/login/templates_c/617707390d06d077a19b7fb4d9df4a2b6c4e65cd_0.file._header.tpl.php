<?php
/* Smarty version 3.1.30, created on 2016-10-24 07:25:25
  from "/Applications/MAMP/htdocs/sux/modules/login/tpl/_header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580d9b458c71e4_15790450',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '617707390d06d077a19b7fb4d9df4a2b6c4e65cd' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/login/tpl/_header.tpl',
      1 => 1477286479,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_580d9b458c71e4_15790450 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=2.0">
	<link rel="stylesheet" type="text/css" href="../../common/css/sux_default.css">
	<link rel="stylesheet" type="text/css" href="../../common/css/sux_common.min.css">
	<link rel="stylesheet" type="text/css" href="../../common/css/sux_layout.css">	
	<link rel="stylesheet" type="text/css" href="tpl/css/login.css">
<?php if ($_smarty_tpl->tpl_vars['documentData']->value['isLogon'] === false) {?>
	<link rel="stylesheet" type="text/css" href="tpl/css/login_fail.css">
<?php }?>
</head>
<body>
<div class="wrapper">
	<div class="header"></div>
	<div class="container">	

<?php }
}
