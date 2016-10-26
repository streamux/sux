<?php
/* Smarty version 3.1.30, created on 2016-10-24 10:52:30
  from "/Applications/MAMP/htdocs/sux/modules/admin/tpl/_footer.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580dcbceb27677_45388118',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c06b5a80a1d710f85c7938094effb0b200f4d6e6' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/admin/tpl/_footer.tpl',
      1 => 1477299146,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_580dcbceb27677_45388118 (Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="footer">
	<p>
		<span>
			<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['copyrightPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

		</span>
	</p>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
	var is_page = 'admin_main';
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
 type="text/javascript" src="../../common/js/jsux_admin_app.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="../../common/js/jsux_admin_app_stage.min.js"><?php echo '</script'; ?>
>

<?php if ($_smarty_tpl->tpl_vars['documentData']->value['jscode'] != '') {
echo '<script'; ?>
 type="text/javascript" src="../<?php echo $_smarty_tpl->tpl_vars['documentData']->value['module_code'];?>
/tpl/js/<?php echo $_smarty_tpl->tpl_vars['documentData']->value['module_code'];?>
_admin.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
	jsux.fn['<?php echo $_smarty_tpl->tpl_vars['documentData']->value['jscode'];?>
'].init();
<?php echo '</script'; ?>
>
<?php }?>
</body>
</html>
<?php }
}
