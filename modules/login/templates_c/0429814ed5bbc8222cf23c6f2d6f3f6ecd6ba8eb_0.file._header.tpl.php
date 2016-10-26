<?php
/* Smarty version 3.1.30, created on 2016-10-26 07:36:35
  from "/Applications/MAMP/htdocs/sux/common/_header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_581040e32fc7d3_71077168',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0429814ed5bbc8222cf23c6f2d6f3f6ecd6ba8eb' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/common/_header.tpl',
      1 => 1477364804,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_581040e32fc7d3_71077168 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, height=device-height, maximum-scale=2.0">
	<link rel="stylesheet" type="text/css" href="../../common/css/swiper.min.css">
	<link rel="stylesheet" type="text/css" href="../../common/css/sux_default.min.css">
	<link rel="stylesheet" type="text/css" href="../../common/css/sux_common.min.css">
	<link rel="stylesheet" type="text/css" href="../../common/css/sux_layout.css">	
<?php if ($_smarty_tpl->tpl_vars['documentData']->value['module_code'] != '') {?>
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['skinPathList']->value['dir'];?>
/css/<?php echo $_smarty_tpl->tpl_vars['documentData']->value['module_code'];?>
.css">
<?php }
if ($_smarty_tpl->tpl_vars['documentData']->value['isLogon'] === false) {?>
	<link rel="stylesheet" type="text/css" href="tpl/css/login_fail.css">
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
		<div class="mobile-menu">
			<div class="mobile-btn">
				<div class="btn-hline1"></div>
				<div class="btn-hline2"></div>
				<div class="btn-hline2"></div>
			</div>
		</div>
		<h1 class="logo">
			<a href="/sux/index.php"><img src="../../common/images/sux_logo.svg" onerror='this.src="../../common/images/sux_logo.png"' alt="streamxux"></a>
		</h1>		
		<div class="gnb-case">
			<div id="gnb" class="gnb"></div>
		</div>
	</div>
	<div class="section container">
		<div class="swiper-container swiper-container-contents">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<div class="contents-header">
						<div class="ui-btn-write"><a href="board.php?board=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board_grg'];?>
&passover=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['passover'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['page'];?>
&action=write"><img src="../../common/images/icon_write.png" width="18px" height="18px"></a></div>
						<h1 class="document-title"><?php echo $_smarty_tpl->tpl_vars['groupData']->value['board_name'];?>
</h1>
						<p>home > <?php echo $_smarty_tpl->tpl_vars['documentData']->value['module_name'];?>
</p>
					</div>
		
				
		<?php }
}
