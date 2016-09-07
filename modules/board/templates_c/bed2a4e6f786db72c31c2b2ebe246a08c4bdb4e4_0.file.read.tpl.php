<?php
/* Smarty version 3.1.30, created on 2016-09-07 04:21:44
  from "/Applications/MAMP/htdocs/sux/modules/board/skin/default/read.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57cf79b8816815_95590098',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bed2a4e6f786db72c31c2b2ebe246a08c4bdb4e4' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/skin/default/read.tpl',
      1 => 1473214830,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57cf79b8816815_95590098 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="board-read" style="width:<?php echo $_smarty_tpl->tpl_vars['group_data']->value['width'];?>
">
	<div class="panel-heading">
		<p class="title"><?php echo $_smarty_tpl->tpl_vars['read_data']->value['title'];?>
</p>
		<p class="sub-info"><?php echo $_smarty_tpl->tpl_vars['read_data']->value['name'];?>
 &nbsp; <?php echo $_smarty_tpl->tpl_vars['read_data']->value['date'];?>
 &nbsp; 조회 <?php echo $_smarty_tpl->tpl_vars['read_data']->value['hit'];?>
</p>
	</div>
	<div class="panel-body">
		<p style="display:<?php echo $_smarty_tpl->tpl_vars['read_data']->value['down_display'];?>
">
			<a href="<?php echo $_smarty_tpl->tpl_vars['read_data']->value['fileup_path'];?>
"><?php echo $_smarty_tpl->tpl_vars['read_data']->value['file_name'];?>
&nbsp;<b>[ 다운로드 ]</b></a>
		</p>
		<p style="display:<?php echo $_smarty_tpl->tpl_vars['read_data']->value['img_display'];?>
;max-width:<?php echo $_smarty_tpl->tpl_vars['read_data']->value['img_width'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['read_data']->value['fileup_path'];?>
" width="100%" border="0"></p>
		<p><?php echo $_smarty_tpl->tpl_vars['read_data']->value['comment'];?>
</p>
	</div>		
</div>
<div class="board-buttons">
	<a href="board.php?board=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['board_grg'];?>
&passover=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['passover'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['page'];?>
&find=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['find'];?>
&search=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['search'];?>
&action=list"><img src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/btn_list.gif" width="51px" height="23px" border="0px"></a>
	<a href="board.php?&board=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['board_grg'];?>
&action=write"><img src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/btn_write.gif" width="62" height="23" border="0"></a> <a href="board.php?board=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['board_grg'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['id'];?>
&igroup=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['igroup'];?>
&ssunseo=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['ssunseo'];?>
&action=reply"><img src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/btn_answer.gif" width="51" height="23" border="0"></a>&nbsp;<a href="board.php?board=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['board_grg'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['id'];?>
&sid=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['sid'];?>
&action=modify"><img src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/btn_edit.gif" border="0"></a>&nbsp;<a href="board.php?board=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['board_grg'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['id'];?>
&action=deletepass"><img src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/btn_del.gif" width="51" height="23" border="0"></a>
</div>
<div class="board-adminsetup" style="display:<?php echo $_smarty_tpl->tpl_vars['read_data']->value['opkey_display'];?>
;width:<?php echo $_smarty_tpl->tpl_vars['group_data']->value['width'];?>
">
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['opkey_skin_path']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

</div>
<div class="board-tail" style="display:<?php echo $_smarty_tpl->tpl_vars['read_data']->value['tail_display'];?>
;width:<?php echo $_smarty_tpl->tpl_vars['group_data']->value['width'];?>
">
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tail_skin_path']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

</div>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/js/board.read.js"><?php echo '</script'; ?>
>
<?php }
}
