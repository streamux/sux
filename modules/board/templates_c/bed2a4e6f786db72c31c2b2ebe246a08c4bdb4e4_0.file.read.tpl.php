<?php
/* Smarty version 3.1.30, created on 2016-09-09 10:43:07
  from "/Applications/MAMP/htdocs/sux/modules/board/skin/default/read.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57d2761bc40a49_73890807',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bed2a4e6f786db72c31c2b2ebe246a08c4bdb4e4' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/skin/default/read.tpl',
      1 => 1473410583,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d2761bc40a49_73890807 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="board-read" style="width:<?php echo $_smarty_tpl->tpl_vars['groupData']->value['width'];?>
">
	<div class="panel-heading">
		<p class="title"><?php echo $_smarty_tpl->tpl_vars['documentData']->value['title'];?>
</p>
		<p class="sub-info"><?php echo $_smarty_tpl->tpl_vars['documentData']->value['name'];?>
 &nbsp; <?php echo $_smarty_tpl->tpl_vars['documentData']->value['date'];?>
 &nbsp; 조회 <?php echo $_smarty_tpl->tpl_vars['documentData']->value['hit'];?>
</p>
	</div>
	<div class="panel-body">
		<p class="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['css_down'];?>
">
			<a href="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['fileup_path'];?>
"><?php echo $_smarty_tpl->tpl_vars['documentData']->value['file_name'];?>
&nbsp;<b>[ 다운로드 ]</b></a>
		</p>
		<p style="max-width:<?php echo $_smarty_tpl->tpl_vars['documentData']->value['css_img_width'];?>
" class="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['css_img'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['fileup_path'];?>
" width="100%" border="0"></p>
		<p><?php echo $_smarty_tpl->tpl_vars['documentData']->value['comment'];?>
</p>
	</div>		
</div>
<div class="board-buttons">
	<a href="board.php?board=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board_grg'];?>
&passover=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['passover'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['page'];?>
&find=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['find'];?>
&search=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['search'];?>
&action=list"><img src="<?php echo $_smarty_tpl->tpl_vars['skinDir']->value;?>
/images/btn_list.gif" width="51px" height="23px" border="0px"></a>
	<a href="board.php?&board=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board_grg'];?>
&action=write"><img src="<?php echo $_smarty_tpl->tpl_vars['skinDir']->value;?>
/images/btn_write.gif" width="62" height="23" border="0"></a> <a href="board.php?board=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board_grg'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['id'];?>
&igroup=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['igroup'];?>
&ssunseo=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['ssunseo'];?>
&action=reply"><img src="<?php echo $_smarty_tpl->tpl_vars['skinDir']->value;?>
/images/btn_answer.gif" width="51" height="23" border="0"></a>&nbsp;<a href="board.php?board=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board_grg'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['id'];?>
&sid=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['sid'];?>
&action=modify"><img src="<?php echo $_smarty_tpl->tpl_vars['skinDir']->value;?>
/images/btn_edit.gif" border="0"></a>&nbsp;<a href="board.php?board=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board_grg'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['id'];?>
&action=deletepass"><img src="<?php echo $_smarty_tpl->tpl_vars['skinDir']->value;?>
/images/btn_del.gif" width="51" height="23" border="0"></a>
</div>
<div style="width:<?php echo $_smarty_tpl->tpl_vars['groupData']->value['width'];?>
" class="board-adminsetup <?php echo $_smarty_tpl->tpl_vars['documentData']->value['css_opkey'];?>
">
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['opkeySkinPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

</div>
<div style="width:<?php echo $_smarty_tpl->tpl_vars['groupData']->value['width'];?>
" class="board-tail <?php echo $_smarty_tpl->tpl_vars['documentData']->value['css_tail'];?>
">
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tailSkinPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

</div>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['skinDir']->value;?>
/js/board.read.js"><?php echo '</script'; ?>
>
<?php }
}
