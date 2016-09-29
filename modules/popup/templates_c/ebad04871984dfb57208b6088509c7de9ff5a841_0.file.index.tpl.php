<?php
/* Smarty version 3.1.30, created on 2016-09-27 13:51:36
  from "/Applications/MAMP/htdocs/sux/modules/popup/skin/spring_event/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57ea5d484b1032_89881954',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ebad04871984dfb57208b6088509c7de9ff5a841' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/popup/skin/spring_event/index.tpl',
      1 => 1474973220,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57ea5d484b1032_89881954 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('groupData', $_smarty_tpl->tpl_vars['documentData']->value['group']);
$_smarty_tpl->_assignInScope('contentData', $_smarty_tpl->tpl_vars['documentData']->value['contents']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_assignInScope('popupName', $_smarty_tpl->tpl_vars['contentData']->value['popup_name']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->tpl_vars['popupName']->value)." - StreamUX"), 0, true);
?>

<div class="wrapper">
	<div class="header">
	</div>
	<div class="container" style="padding:<?php echo $_smarty_tpl->tpl_vars['contentData']->value['skin_top'];?>
 <?php echo $_smarty_tpl->tpl_vars['contentData']->value['skin_right'];?>
 20px <?php echo $_smarty_tpl->tpl_vars['contentData']->value['skin_left'];?>
;background-image:url('skin/<?php echo $_smarty_tpl->tpl_vars['contentData']->value['skin'];?>
/images/bg.jpg');background-repeat:no-repeat;background-size:contain;width:<?php echo $_smarty_tpl->tpl_vars['contentData']->value['imagesx'];?>
px;height:<?php echo $_smarty_tpl->tpl_vars['contentData']->value['imagesy'];?>
px;">
		<div class="comment">
			<?php echo $_smarty_tpl->tpl_vars['contentData']->value['comment'];?>

		</div>
	</div>
	<form name="f_popup" method="post">
	<div class="footer">		
		<label for="suxpopCheckbox">오늘하루 이창을 열지 않음</label>
		<input type="checkbox" id="suxpopCheckbox" name="suxpop" value="">
		<a href="javascript:closePopup('<?php echo $_smarty_tpl->tpl_vars['contentData']->value['popup_name'];?>
');"><img src="./skin/<?php echo $_smarty_tpl->tpl_vars['contentData']->value['skin'];?>
/images/btn_close.gif" width="55" height="17"></a>
	</div>
	</form>
</div>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
