<?php
/* Smarty version 3.1.30, created on 2017-01-04 10:06:54
  from "/Applications/MAMP/htdocs/sux/modules/install/tpl/_footer.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_586cbb2e7ca027_05714770',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '02b4a1325e099ac4efeda779e581a707e702c2be' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/install/tpl/_footer.tpl',
      1 => 1483518983,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_586cbb2e7ca027_05714770 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
common/js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
common/js/jsux.min.js"><?php echo '</script'; ?>
>
<?php if ($_smarty_tpl->tpl_vars['requestData']->value['action'] != '') {
echo '<script'; ?>
>	jsux.rootPath = <?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
;<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/install/tpl/js/install.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
	jsux.fn['<?php echo $_smarty_tpl->tpl_vars['requestData']->value['action'];?>
'].init();
<?php echo '</script'; ?>
>
<?php }?>
</body>
</html><?php }
}
