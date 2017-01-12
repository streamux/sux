<?php
/* Smarty version 3.1.30, created on 2017-01-11 05:38:02
  from "/Applications/MAMP/htdocs/sux/modules/login/tpl/_footer_admin.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5875b6aa4d0eb5_46465254',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8c0379ce889c32b06b0199b248a3e09a6a536cce' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/login/tpl/_footer_admin.tpl',
      1 => 1484109481,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5875b6aa4d0eb5_46465254 (Smarty_Internal_Template $_smarty_tpl) {
?>
	</div>
	<div class="footer">
		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['copyrightPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

	</div>
</div>
<div class="ui-panel-msg"></div>

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
<!-- end -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
common/js/jsux.min.js"><?php echo '</script'; ?>
>
<?php if ($_smarty_tpl->tpl_vars['documentData']->value['jscode'] != '') {
echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/login/tpl/js/login_admin.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
	jsux.fn['<?php echo $_smarty_tpl->tpl_vars['documentData']->value['jscode'];?>
'].init();
<?php echo '</script'; ?>
>
<?php }?>
</body>
</html><?php }
}
