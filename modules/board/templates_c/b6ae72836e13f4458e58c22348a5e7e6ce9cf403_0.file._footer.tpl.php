<?php
/* Smarty version 3.1.30, created on 2016-10-17 05:01:12
  from "/Applications/MAMP/htdocs/sux/common/_footer.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58043ef86010f1_76169826',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b6ae72836e13f4458e58c22348a5e7e6ce9cf403' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/common/_footer.tpl',
      1 => 1476673269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58043ef86010f1_76169826 (Smarty_Internal_Template $_smarty_tpl) {
?>
	</div>
	<div class="footer">
		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['copyrightPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

	</div>
</div>
<!-- mobile menu start -->
<div class="ui-bg-cover"></div>
<div class="mobile-gnb-case">	
	<div class="header-panel">
		<div class="ui-user-info">
			<ul class="clearfix">
				<li><div class="ui-user-picture"></div></li>
				<li><span class="ui-user-nickname">Guest</span></li>
				<li><div class="ui-user-modify"></div></li>
			</ul>
		</div>
		<div class="ui-user-member">
			<ul class="clearfix">
				<li>
					<div class="ui-link-login"><a href="modules/login/login.php?action=login">로그인</a></div>
				</li>
				<li>
					<div class="ui-link-join"><a href="modules/member/member.php?action=join">회원가입</a></div>
				</li>
			</ul>
		</div>		
	</div>		
	<div id="mobileGnb" class="body-panel">
		<div class="menu-panel">
			<ul>
				<!-- display first's depth menu list -->
			</ul>
		</div>
	</div>	
</div>
<!-- end -->
<!-- template start -->
<?php echo '<script'; ?>
 type="sux-templete" id="suxMobileGnbFirstMenu">
	<li data-code=""><a href="#"></a></li>
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="sux-templete" id="suxMobileGnbSecondMenuCase">
	<div class="second-menu">
		<ul>
			/*display second's depth menu list*/
		</ul>
	</div>
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="sux-templete" id="suxMobileGnbSecondMenu">
	<li data-code="" data-sub-code=""><a href="#"></a></li>
<?php echo '</script'; ?>
>
<!-- end -->
<?php echo '<script'; ?>
 type="text/javascript">
	var is_page = 'sub';
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript" src="../../common/js/jquery.min.js"><?php echo '</script'; ?>
>	
<?php echo '<script'; ?>
 type="text/javascript" src="../../common/js/jquery.tmpl.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="../../common/js/TweenMax.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="../../common/js/idangerous.swiper.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="../../common/js/jquery.mCustomScrollbar.concat.min.js"><?php echo '</script'; ?>
>
<!--[if (gte IE 6)&(lte IE 8)]>
	<?php echo '<script'; ?>
 type="text/javascript" src="tpl/js/selectivizr-min.js"><?php echo '</script'; ?>
>
	<link rel="stylesheet" type="text/css" href="./css/main_ie8.css">
<![endif]-->
<?php echo '<script'; ?>
 type="text/javascript" src="../../common/js/jsux.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="../../common/js/jsux_common_js.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="../../common/js/jsux_app.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="../../common/js/jsux_app_stage.min.js"><?php echo '</script'; ?>
>
<?php if ($_smarty_tpl->tpl_vars['requestData']->value['jscode'] != '') {
echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['skinPathList']->value['dir'];?>
/js/board.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
	jsux.fn['<?php echo $_smarty_tpl->tpl_vars['requestData']->value['jscode'];?>
'].init();
<?php echo '</script'; ?>
>
<?php }
echo '<script'; ?>
>
	(function($){
		$(window).on("load",function(){
			
			$("#mobileGnb").mCustomScrollbar({
				autoHideScrollbar:true,
				theme:"minimal-dark",
			});
			
		});
	})(jQuery);
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
