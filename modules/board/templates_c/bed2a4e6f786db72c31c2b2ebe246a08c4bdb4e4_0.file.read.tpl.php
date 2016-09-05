<?php
/* Smarty version 3.1.30, created on 2016-09-05 09:40:27
  from "/Applications/MAMP/htdocs/sux/modules/board/skin/default/read.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57cd216bf403a8_86230995',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bed2a4e6f786db72c31c2b2ebe246a08c4bdb4e4' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/skin/default/read.tpl',
      1 => 1473061184,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57cd216bf403a8_86230995 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="board-read" style="width:<?php echo $_smarty_tpl->tpl_vars['width']->value;?>
">
	<div class="panel-heading">
		<p class="title"><?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
</p>
		<p class="sub-info"><?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
 &nbsp; <?php echo $_smarty_tpl->tpl_vars['data']->value['date'];?>
 &nbsp; 조회 <?php echo $_smarty_tpl->tpl_vars['data']->value['hit'];?>
</p>
	</div>
	<div class="panel-body">
		<p style="display:<?php echo $_smarty_tpl->tpl_vars['data']->value['down_display'];?>
">
			<a href="../../board_data/<?php echo $_smarty_tpl->tpl_vars['board']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['filename']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['filename'];?>
&nbsp;<b>[ 다운로드 ]</b></a>
		</p>
		<p style="display:<?php echo $_smarty_tpl->tpl_vars['data']->value['img_display'];?>
;max-width:<?php echo $_smarty_tpl->tpl_vars['data']->value['img_width'];?>
"><img src="../../board_data/<?php echo $_smarty_tpl->tpl_vars['data']->value['fileup_path'];?>
" width="100%" border="0"></p>
		<p><?php echo $_smarty_tpl->tpl_vars['data']->value['comment'];?>
</p>
	</div>		
</div>
<div class="board-buttons">
	<a href="board.php?board=<?php echo $_smarty_tpl->tpl_vars['board']->value;?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['board_grg']->value;?>
&passover=<?php echo $_smarty_tpl->tpl_vars['passover']->value;?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&find=<?php echo $_smarty_tpl->tpl_vars['find']->value;?>
&search=<?php echo $_smarty_tpl->tpl_vars['search']->value;?>
&action=list"><img src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/btn_list.gif" width="51px" height="23px" border="0px"></a>
	<a href="board.php?&board=<?php echo $_smarty_tpl->tpl_vars['board']->value;?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['board_grg']->value;?>
&action=write"><img src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/btn_write.gif" width="62" height="23" border="0"></a> <a href="board.php?board=<?php echo $_smarty_tpl->tpl_vars['board']->value;?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['board_grg']->value;?>
&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&action=reply"><img src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/btn_answer.gif" width="51" height="23" border="0"></a>&nbsp;<a href="board.php?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&board=<?php echo $_smarty_tpl->tpl_vars['board']->value;?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['board_grg']->value;?>
&sid=<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
&action=modify"><img src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/btn_edit.gif" border="0"></a>&nbsp;<a href="board.php?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&board=<?php echo $_smarty_tpl->tpl_vars['board']->value;?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['board_grg']->value;?>
&action=deletepass"><img src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/btn_del.gif" width="51" height="23" border="0"></a>
</div>
<div class="board-adminsetup" style="display:<?php echo $_smarty_tpl->tpl_vars['data']->value['opkey'];?>
;width:<?php echo $_smarty_tpl->tpl_vars['width']->value;?>
">
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['opkey_skin_path']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

</div>
<div class="board-tail" style="display:<?php echo $_smarty_tpl->tpl_vars['data']->value['tail'];?>
;width:<?php echo $_smarty_tpl->tpl_vars['width']->value;?>
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
