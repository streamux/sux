<?php
/* Smarty version 3.1.30, created on 2016-11-14 10:30:52
  from "/Applications/MAMP/htdocs/sux/common/_footer.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5829844cbbedf8_93140694',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b6ae72836e13f4458e58c22348a5e7e6ce9cf403' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/common/_footer.tpl',
      1 => 1479096046,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5829844cbbedf8_93140694 (Smarty_Internal_Template $_smarty_tpl) {
?>
		<div class="footer">
			<ul class="clearfix">
				<li><a href="../login/login.php?action=login">로그인</a></li>
				<li><a href="../member/member.php?action=join">회원가입</a></li>
				<li><a href="#" onclick="jsux.mobileGnbView.showSitemap();">사이트 맵</a></li>
			</ul>	
			<p>
				<span><?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['copyrightPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</span>
			</p>
		</div>
	</div>	
</div>

<!-- mobile menu start -->
<div class="ui-bg-cover ui-bg-cover-off"></div>
<div class="mobile-gnb-case mobile-gnb-case-off">
	<div class="menu-btn-close">
		<div class="ui-h-3stick">
			<div class="hline1"></div>
			<div class="hline2"></div>
			<div class="hline3"></div>
		</div>
	</div>
	<div class="header-panel">
		<div class="ui-user-info">
			<ul class="clearfix">
				<li><div class="ui-user-picture"></div></li>
				<li><span class="ui-user-nickname">Guest</span></li>
				<li><a href="/sux/admin" target="_blank"><img src="../common/images/icon_gear_white.svg" onerror='this.src="../common/images/icon_gear_white.png"' class="ui-user-modify" alt="관리자 설정" /></a></li>
			</ul>
		</div>
		<div class="ui-user-member">
			<ul class="clearfix">
				<li>
					<div class="ui-link-login"><a href="../modules/login/login.php?action=login">로그인</a></div>
				</li>
				<li>
					<div class="ui-link-join"><a href="../modules/member/member.php?action=join">회원가입</a></div>
				</li>
			</ul>
		</div>
	</div>
	<div class="body-panel">
		<div class="swiper-container swiper-container-mobilegnb">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<ul id="mobileGnb" class="menu-panel">
						<!-- display first's depth menu list -->
					</ul>
				</div>		
			</div>
			<div class="swiper-scrollbar swiper-scrollbar-mobilegnb"></div>
		</div>
	</div>	
</div>
<!-- end -->

<!-- js template start -->
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
<?php if ($_smarty_tpl->tpl_vars['documentData']->value['group']) {
echo '<script'; ?>
 type="text/javascript">
	var loginObj = loginObj || {};
	loginObj.memberList = <?php echo $_smarty_tpl->tpl_vars['documentData']->value['group'];?>
;
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="x-jquery-templete" id="ljsMember_tmpl">
	<option>${name}</option>
<?php echo '</script'; ?>
>
<?php }?>
<!-- end -->
<?php echo '<script'; ?>
 type="text/javascript">
	var is_page = 'sub';
<?php echo '</script'; ?>
>

<!-- js api -->
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-1.12.4.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>window.jQuery || document.write('<?php echo '<script'; ?>
 src="../common/js/jquery.min.js"><\/script>')<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>window.jQuery.tmpl || document.write('<?php echo '<script'; ?>
 src="../common/js/jquery.tmpl.min.js"><\/script>')<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>window.TweenMax || document.write('<?php echo '<script'; ?>
 src="../common/js/TweenMax.min.js"><\/script>')<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>window.Swiper || document.write('<?php echo '<script'; ?>
 src="../common/js/idangerous.swiper.min.js"><\/script>')<?php echo '</script'; ?>
>
<!-- end -->
<!-- js customize start -->
<?php echo '<script'; ?>
 type="text/javascript" src="../common/js/jsux.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="../common/js/jsux_common.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="../common/js/jsux_app.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="../common/js/jsux_app_stage.min.js"><?php echo '</script'; ?>
>
<?php if ($_smarty_tpl->tpl_vars['documentData']->value['module_code'] != '') {
echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['skinPathList']->value['dir'];?>
/tpl/js/<?php echo $_smarty_tpl->tpl_vars['documentData']->value['module_code'];?>
.js"><?php echo '</script'; ?>
>
<?php }
if ($_smarty_tpl->tpl_vars['documentData']->value['jscode'] != '') {
echo '<script'; ?>
 type="text/javascript">
	jsux.fn['<?php echo $_smarty_tpl->tpl_vars['documentData']->value['jscode'];?>
'].init();
<?php echo '</script'; ?>
>
<?php }?>
<!-- end -->
</body>
</html><?php }
}
