<?php
/* Smarty version 3.1.31, created on 2017-08-30 11:22:25
  from "/Applications/MAMP/htdocs/sux/modules/login/tpl/_footer_admin.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_59a683d12c07c3_21883287',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1bee9cbb83178e5a6b439f0957c8688ed9fc23b6' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/login/tpl/_footer_admin.tpl',
      1 => 1488852504,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59a683d12c07c3_21883287 (Smarty_Internal_Template $_smarty_tpl) {
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
