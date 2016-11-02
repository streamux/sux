<?php
/* Smarty version 3.1.30, created on 2016-10-11 09:15:02
  from "/Applications/MAMP/htdocs/sux/modules/board/skin/default/_footer.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57fc9176a4ad38_22969140',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '89850fb37acb72d41502196bc7b0ae5c9f4b79f6' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/skin/default/_footer.tpl',
      1 => 1476170075,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57fc9176a4ad38_22969140 (Smarty_Internal_Template $_smarty_tpl) {
?>
	</div>
</div>
<?php echo '<script'; ?>
 src="../../common/js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../../common/js/jsux.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['skinPathList']->value['dir'];?>
/js/board.js"><?php echo '</script'; ?>
>
<?php if ($_smarty_tpl->tpl_vars['requestData']->value['jscode'] != '') {
echo '<script'; ?>
 type="text/javascript">
	jsux.fn['<?php echo $_smarty_tpl->tpl_vars['requestData']->value['jscode'];?>
'].init();
<?php echo '</script'; ?>
>
<?php }?>
</body>
</html><?php }
}
