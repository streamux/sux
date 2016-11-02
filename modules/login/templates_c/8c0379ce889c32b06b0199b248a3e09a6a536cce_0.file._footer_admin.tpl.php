<?php
/* Smarty version 3.1.30, created on 2016-10-27 06:33:15
  from "/Applications/MAMP/htdocs/sux/modules/login/tpl/_footer_admin.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5811838bb0feb0_54231229',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8c0379ce889c32b06b0199b248a3e09a6a536cce' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/login/tpl/_footer_admin.tpl',
      1 => 1477542790,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5811838bb0feb0_54231229 (Smarty_Internal_Template $_smarty_tpl) {
?>
	</div>
	<div class="footer">
		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['copyrightPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

	</div>
</div>
<div class="ui-panel-msg"></div>

<?php echo '<script'; ?>
 src="../../common/js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../../common/js/jquery.tmpl.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../../common/js/jsux.min.js"><?php echo '</script'; ?>
>
<!--[if (gte IE 6)&(lte IE 8)]>
  <?php echo '<script'; ?>
 type="text/javascript" src="../../common/js/selectivizr-min.js"><?php echo '</script'; ?>
>
<![endif]-->
<?php echo '<script'; ?>
 type="text/javascript" src="tpl/js/login_admin.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
	jsux.fn.loginAdmin.init();
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
