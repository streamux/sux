<?php
/* Smarty version 3.1.30, created on 2016-09-22 01:57:26
  from "/Applications/MAMP/htdocs/sux/modules/login/tpl/_footer.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57e31e66576be7_00155289',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3b455289258547b65afd0e23a1f65d2af277dbd4' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/login/tpl/_footer.tpl',
      1 => 1474502122,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57e31e66576be7_00155289 (Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
 src="../../common/js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../../common/js/jquery.tmpl.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../../common/js/jsux-1.0.0.min.js"><?php echo '</script'; ?>
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
 type="text/javascript" src="tpl/js/login.js"><?php echo '</script'; ?>
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
