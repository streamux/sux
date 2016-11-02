<?php
/* Smarty version 3.1.30, created on 2016-10-27 06:04:09
  from "/Applications/MAMP/htdocs/sux/modules/login/tpl/_header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58117cb9cbe454_76358844',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '617707390d06d077a19b7fb4d9df4a2b6c4e65cd' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/login/tpl/_header.tpl',
      1 => 1477541021,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58117cb9cbe454_76358844 (Smarty_Internal_Template $_smarty_tpl) {
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
	<link rel="stylesheet" type="text/css" href="../admin/tpl/css/layout.css">	
	<link rel="stylesheet" type="text/css" href="../admin/tpl/css/login.css">
<?php if ($_smarty_tpl->tpl_vars['documentData']->value['isLogon'] === false) {?>
	<link rel="stylesheet" type="text/css" href="tpl/css/login_fail.css">
<?php }?>
</head>
<body>
<div class="wrapper">
	<div class="header">
		<div class="util"></div>
		<a href="../admin/index.php?action=main">
			<h1><img class="logo" src="../admin/tpl/images/logo.png" alt="streamxux"></h1>
		</a>
	</div>
	<div class="container">	

<?php }
}
