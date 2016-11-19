<?php
/* Smarty version 3.1.30, created on 2016-11-18 05:42:37
  from "/Applications/MAMP/htdocs/sux/modules/install/tpl/_footer.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_582e86bdc23885_79207612',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '52fa753f277c40ebcb69bdf8786118b4cdd266d7' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/install/tpl/_footer.tpl',
      1 => 1479034040,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_582e86bdc23885_79207612 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 src="../common/js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../common/js/jsux.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../modules/install/tpl/js/install.js"><?php echo '</script'; ?>
>
<?php if ($_smarty_tpl->tpl_vars['requestData']->value['action'] != '') {
echo '<script'; ?>
 type="text/javascript">
	jsux.fn['<?php echo $_smarty_tpl->tpl_vars['requestData']->value['action'];?>
'].init();
<?php echo '</script'; ?>
>
<?php }?>
</body>
</html><?php }
}
