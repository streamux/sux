<?php
/* Smarty version 3.1.30, created on 2016-09-22 05:27:15
  from "/Applications/MAMP/htdocs/sux/modules/login/tpl/_header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57e34f932edda0_80427158',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '617707390d06d077a19b7fb4d9df4a2b6c4e65cd' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/login/tpl/_header.tpl',
      1 => 1474514833,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57e34f932edda0_80427158 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=2.0">
	<link rel="stylesheet" type="text/css" href="tpl/css/default.css">
<?php if ($_smarty_tpl->tpl_vars['documentData']->value['isLogon'] === false) {?>
	<link rel="stylesheet" type="text/css" href="tpl/css/login_fail.css">
<?php }?>
</head>
<body>

<?php }
}
