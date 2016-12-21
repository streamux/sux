<?php
/* Smarty version 3.1.30, created on 2016-12-15 08:31:04
  from "/Applications/MAMP/htdocs/sux/modules/admin/tpl/_footer.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_585246b83ba481_84015613',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c06b5a80a1d710f85c7938094effb0b200f4d6e6' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/admin/tpl/_footer.tpl',
      1 => 1481787062,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_585246b83ba481_84015613 (Smarty_Internal_Template $_smarty_tpl) {
?>
	</div>
	<div class="footer">
		<p>
			<span>
				<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['copyrightPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

			</span>
		</p>
	</div>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
	var is_page = 'admin_main';
<?php echo '</script'; ?>
>
<!-- js api -->
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-1.12.4.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>window.jQuery || document.write('<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
common/js/jquery.min.js"><\/script>')<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>window.jQuery.tmpl || document.write('<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
common/js/jquery.tmpl.min.js"><\/script>')<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>window.TweenMax || document.write('<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
common/js/TweenMax.min.js"><\/script>')<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>window.Swiper || document.write('<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
common/js/idangerous.swiper.min.js"><\/script>')<?php echo '</script'; ?>
>
<!-- end -->
<!--[if (gte IE 6)&(lte IE 8)]>
	<?php echo '<script'; ?>
 type="text/javascript" src="tpl/js/selectivizr-min.js"><?php echo '</script'; ?>
>
	<link rel="stylesheet" type="text/css" href="./css/main_ie8.css">
<![endif]-->
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
common/js/jsux.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
common/js/jsux_common.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
common/js/jsux_admin_app.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
common/js/jsux_admin_app_stage.min.js"><?php echo '</script'; ?>
>

<?php if ($_smarty_tpl->tpl_vars['documentData']->value['jscode'] != '') {
echo '<script'; ?>
>	jsux.rootPath = <?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
;<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/<?php echo $_smarty_tpl->tpl_vars['documentData']->value['module_code'];?>
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
