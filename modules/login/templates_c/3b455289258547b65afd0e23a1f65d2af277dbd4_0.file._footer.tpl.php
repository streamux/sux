<?php
/* Smarty version 3.1.30, created on 2016-10-27 06:04:09
  from "/Applications/MAMP/htdocs/sux/modules/login/tpl/_footer.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58117cb9ceb927_99668886',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3b455289258547b65afd0e23a1f65d2af277dbd4' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/login/tpl/_footer.tpl',
      1 => 1477541045,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58117cb9ceb927_99668886 (Smarty_Internal_Template $_smarty_tpl) {
?>
	</div>
	<div class="footer">
		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['copyrightPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

	</div>
</div>
<div class="ui-panel-msg"></div>

<?php if ($_smarty_tpl->tpl_vars['documentData']->value['jscode'] == 'login' || $_smarty_tpl->tpl_vars['documentData']->value['jscode'] == 'searchID' || $_smarty_tpl->tpl_vars['documentData']->value['jscode'] == 'searchPassword') {
echo '<script'; ?>
 type="text/javascript">
	var loginObj = loginObj || {};
	loginObj.memberList = <?php echo $_smarty_tpl->tpl_vars['documentData']->value['group'];?>
;
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="x-jquery-templete" id="ljsMember_tmpl">
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
<?php if ($_smarty_tpl->tpl_vars['documentData']->value['jscode'] != '') {
echo '<script'; ?>
 type="text/javascript" src="tpl/js/login_admin.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
	jsux.fn['<?php echo $_smarty_tpl->tpl_vars['requestData']->value['jscode'];?>
'].init();
<?php echo '</script'; ?>
>
<?php }?>
</body>
</html><?php }
}
