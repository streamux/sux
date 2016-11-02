<?php
/* Smarty version 3.1.30, created on 2016-10-13 08:11:46
  from "/Applications/MAMP/htdocs/sux/modules/member/tpl/_footer.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57ff25a21b67f2_22455930',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '46dbe823484a00a8872d73b7ad3c6586fdd8f348' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/member/tpl/_footer.tpl',
      1 => 1476339104,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57ff25a21b67f2_22455930 (Smarty_Internal_Template $_smarty_tpl) {
?>
	</div>
	<div class="footer">
		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['copyrightPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

	</div>
</div>
<?php if ($_smarty_tpl->tpl_vars['requestData']->value['action'] == 'join') {
echo '<script'; ?>
 type="jquery-templete" id="tableList_tmpl">

	<option>${name}</option>

<?php echo '</script'; ?>
>
<?php }?>

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
 type="text/javascript" src="tpl/js/member.js"><?php echo '</script'; ?>
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
</html>
<?php }
}
