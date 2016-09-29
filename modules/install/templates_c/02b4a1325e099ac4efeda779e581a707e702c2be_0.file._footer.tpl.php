<?php
/* Smarty version 3.1.30, created on 2016-09-28 04:37:50
  from "/Applications/MAMP/htdocs/sux/modules/install/tpl/_footer.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57eb2cfec67cf8_82452060',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '02b4a1325e099ac4efeda779e581a707e702c2be' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/install/tpl/_footer.tpl',
      1 => 1475030234,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57eb2cfec67cf8_82452060 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 src="../../common/js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../../common/js/jsux.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="tpl/js/install.js"><?php echo '</script'; ?>
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
