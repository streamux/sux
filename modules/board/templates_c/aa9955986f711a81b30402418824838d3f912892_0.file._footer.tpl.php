<?php
/* Smarty version 3.1.30, created on 2016-10-24 10:03:48
  from "/Applications/MAMP/htdocs/sux/sites/common/_footer.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580dc0643336c8_80648677',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aa9955986f711a81b30402418824838d3f912892' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/sites/common/_footer.tpl',
      1 => 1477295815,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_580dc0643336c8_80648677 (Smarty_Internal_Template $_smarty_tpl) {
?>
				</div>				
			</div>
			<div class="swiper-scrollbar swiper-scrollbar-contents"></div>			
		</div>		
	</div>
	<div class="footer">
		<ul class="clearfix">
			<li>로그인</li>
			<li>회원가입</li>
			<li>사이트 맵</li>
		</ul>	
		<p>
			<span><?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['copyrightPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</span>
		</p>
	</div>
</div>
<!-- mobile menu start -->
<div class="ui-bg-cover ui-bg-cover-off"></div>
<div class="mobile-gnb-case mobile-gnb-case-off">	
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
					<div class="ui-link-login"><a href="/sux/modules/login/login.php?action=login">로그인</a></div>
				</li>
				<li>
					<div class="ui-link-join"><a href="/sux/modules/member/member.php?action=join">회원가입</a></div>
				</li>
			</ul>
		</div>		
	</div>		
	<div class="body-panel">
		<div class="swiper-container swiper-container-mobilegnb">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<ul id="mobileGnb"" class="menu-panel">
						<!-- display first's depth menu list -->
					</ul>
				</div>		
			</div>
			<div class="swiper-scrollbar swiper-scrollbar-mobilegnb"></div>
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

<?php if ($_smarty_tpl->tpl_vars['documentData']->value['jscode'] == 'login' || $_smarty_tpl->tpl_vars['documentData']->value['jscode'] == 'searchID' || $_smarty_tpl->tpl_vars['documentData']->value['jscode'] == 'searchPassword' || $_smarty_tpl->tpl_vars['documentData']->value['jscode'] == 'join') {
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
<!-- api -->
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
<!-- end -->
<!-- customize start -->
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
<?php if ($_smarty_tpl->tpl_vars['documentData']->value['module_code'] != '') {
echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['skinPathList']->value['dir'];?>
/js/<?php echo $_smarty_tpl->tpl_vars['documentData']->value['module_code'];?>
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
