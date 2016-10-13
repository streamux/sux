<?php
/* Smarty version 3.1.30, created on 2016-10-12 12:56:04
  from "/Applications/MAMP/htdocs/sux/modules/board/skin/default/read.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57fe16c46915d5_85383961',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bed2a4e6f786db72c31c2b2ebe246a08c4bdb4e4' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/skin/default/read.tpl',
      1 => 1475747198,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57fe16c46915d5_85383961 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('groupData', $_smarty_tpl->tpl_vars['documentData']->value['group']);
$_smarty_tpl->_assignInScope('boardTitle', $_smarty_tpl->tpl_vars['groupData']->value['board_name']);
$_smarty_tpl->_assignInScope('contentData', $_smarty_tpl->tpl_vars['documentData']->value['contents']);
$_smarty_tpl->_assignInScope('tailData', $_smarty_tpl->tpl_vars['documentData']->value['tails']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_assignInScope('opkeySkinPath', $_smarty_tpl->tpl_vars['skinPathList']->value['opkey']);
$_smarty_tpl->_assignInScope('tailSkinPath', $_smarty_tpl->tpl_vars['skinPathList']->value['tail']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->tpl_vars['boardTitle']->value)." :: 게시물 읽기 - StreamUX"), 0, true);
?>

<div class="board-read" style="width:<?php echo $_smarty_tpl->tpl_vars['groupData']->value['width'];?>
">
	<div class="panel-heading">
		<p class="title"><?php echo $_smarty_tpl->tpl_vars['contentData']->value['title'];?>
</p>
		<p class="sub-info"><?php echo $_smarty_tpl->tpl_vars['contentData']->value['name'];?>
 &nbsp; <?php echo $_smarty_tpl->tpl_vars['contentData']->value['date'];?>
 &nbsp; 조회 <?php echo $_smarty_tpl->tpl_vars['contentData']->value['hit'];?>
</p>
	</div>
	<div class="panel-body">
		<p class="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['css_down'];?>
">
			<a href="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['fileup_path'];?>
"><?php echo $_smarty_tpl->tpl_vars['contentData']->value['file_name'];?>
&nbsp;<b>[ 다운로드 ]</b></a>
		</p>
		<p class="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['css_img'];?>
" style="max-width:<?php echo $_smarty_tpl->tpl_vars['contentData']->value['css_img_width'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['fileup_path'];?>
" width="100%" border="0"></p>
		<p><?php echo $_smarty_tpl->tpl_vars['contentData']->value['comment'];?>
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
&action=list"><img src="<?php echo $_smarty_tpl->tpl_vars['skinPathList']->value['dir'];?>
/images/btn_list.gif" width="51px" height="23px" border="0px"></a>
	<a href="board.php?&board=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board_grg'];?>
&action=write"><img src="<?php echo $_smarty_tpl->tpl_vars['skinPathList']->value['dir'];?>
/images/btn_write.gif" width="62" height="23" border="0"></a> <a href="board.php?board=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board_grg'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['id'];?>
&igroup=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['igroup'];?>
&space=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['space'];?>
&ssunseo=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['ssunseo'];?>
&action=reply"><img src="<?php echo $_smarty_tpl->tpl_vars['skinPathList']->value['dir'];?>
/images/btn_answer.gif" width="51" height="23" border="0"></a>&nbsp;<a href="board.php?board=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board_grg'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['id'];?>
&sid=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['sid'];?>
&action=modify"><img src="<?php echo $_smarty_tpl->tpl_vars['skinPathList']->value['dir'];?>
/images/btn_edit.gif" border="0"></a>&nbsp;<a href="board.php?board=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board_grg'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['id'];?>
&action=delete"><img src="<?php echo $_smarty_tpl->tpl_vars['skinPathList']->value['dir'];?>
/images/btn_del.gif" width="51" height="23" border="0"></a>
</div>
<?php if ($_smarty_tpl->tpl_vars['opkeySkinPath']->value != '') {?>	
<div class="board-adminsetup <?php echo $_smarty_tpl->tpl_vars['contentData']->value['css_opkey'];?>
" style="width:<?php echo $_smarty_tpl->tpl_vars['groupData']->value['width'];?>
">
	<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['opkeySkinPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

</div>
<?php }
if ($_smarty_tpl->tpl_vars['tailSkinPath']->value != '') {?>
<div class="board-tail <?php echo $_smarty_tpl->tpl_vars['contentData']->value['css_tail'];?>
" style="width:<?php echo $_smarty_tpl->tpl_vars['groupData']->value['width'];?>
">
	<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tailSkinPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

</div>
<?php }
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
