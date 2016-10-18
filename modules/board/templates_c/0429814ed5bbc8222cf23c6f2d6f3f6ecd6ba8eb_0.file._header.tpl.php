<?php
/* Smarty version 3.1.30, created on 2016-10-17 06:24:42
  from "/Applications/MAMP/htdocs/sux/common/_header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5804528a9aad99_31016606',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0429814ed5bbc8222cf23c6f2d6f3f6ecd6ba8eb' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/common/_header.tpl',
      1 => 1476678117,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5804528a9aad99_31016606 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=2.0">
	<link rel="stylesheet" type="text/css" href="../../common/css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" type="text/css" href="../../common/css/sux_default.min.css">
	<link rel="stylesheet" type="text/css" href="../../common/css/sux_common.min.css">
	<link rel="stylesheet" type="text/css" href="../../common/css/sux_layout.css">
	<link rel="stylesheet" type="text/css" href="../../common/css/swiper.min.css">
	<?php if ($_smarty_tpl->tpl_vars['requestData']->value['jscode'] != '') {?>
		<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['skinPathList']->value['dir'];?>
/css/board.css">
	<?php }?>

	<!--[if lt IE 9]>
	<?php echo '<script'; ?>
 src="http://html5shiv.googlecode.com/svn/trunk/html5.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js">IE7_PNG_SUFFIX=".png";<?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"><?php echo '</script'; ?>
>
	<![endif]-->
</head>
<body>
<div class="wrapper">
	<div class="header clearfix">		
		<div class="util"></div>
		<h1 class="logo">
			<a href="../../index.php"><img src="../../common/images/sux_logo.png" alt="streamxux" width="60px" height="30px"></a>
		</h1>		
		<div class="mobile-menu">
			<div class="mobile-btn">
				<div class="btn-hline1"></div>
				<div class="btn-hline2"></div>
				<div class="btn-hline2"></div>
			</div>
		</div>
		<div class="gnb-case">
			<div id="gnb" class="gnb"></div>
		</div>
	</div>
	<div class="container">
		<div class="article-header">
			<div class="ui-btn-write"><a href="board.php?board=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board_grg'];?>
&passover=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['passover'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['page'];?>
&action=write"><img src="../../common/images/icon_write.png" width="18px" height="18px"></a></div>
			<h1 class="document-title"><?php echo $_smarty_tpl->tpl_vars['groupData']->value['board_name'];?>
</h1>
			<p>home > <?php echo $_smarty_tpl->tpl_vars['requestData']->value['board'];?>
 > <?php echo $_smarty_tpl->tpl_vars['groupData']->value['board_name'];?>
</p>
		</div>
		<?php }
}
