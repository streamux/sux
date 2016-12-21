<?php
/* Smarty version 3.1.30, created on 2016-12-02 08:37:02
  from "/Applications/MAMP/htdocs/sux/modules/board/skin/default/list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5841249edfa9d9_27258671',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '68ce1c7744454942ee26567a27b588fe16af8d20' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/skin/default/list.tpl',
      1 => 1480664219,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5841249edfa9d9_27258671 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('rootPath', $_smarty_tpl->tpl_vars['skinPathList']->value['root']);
$_smarty_tpl->_assignInScope('category', $_smarty_tpl->tpl_vars['documentData']->value['category']);
$_smarty_tpl->_assignInScope('uri', $_smarty_tpl->tpl_vars['documentData']->value['uri']);
$_smarty_tpl->_assignInScope('groupData', $_smarty_tpl->tpl_vars['documentData']->value['group']);
$_smarty_tpl->_assignInScope('boardTitle', $_smarty_tpl->tpl_vars['groupData']->value['board_name']);
$_smarty_tpl->_assignInScope('contentData', $_smarty_tpl->tpl_vars['documentData']->value['contents']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->tpl_vars['boardTitle']->value)." :: 게시물 목록 - StreamUX"), 0, true);
?>

<div class="board-list" style="width:<?php echo $_smarty_tpl->tpl_vars['groupData']->value['width'];?>
">
	<table summary="게시판 리스트입니다.">
		<thead>
			<tr>
				<th class="author">작성자</th>
				<th class="subject">제목</th>
				<th class="date">날자</th>
				<th class="hit">조회</th>
			</tr>
		</thead>
		<tbody>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['contentData']->value['list'], 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
			<?php if (isset($_smarty_tpl->tpl_vars['item']->value)) {?>
			<tr>
				<td class="author"><span><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</span></td>
				<td class="subject">
					<?php if ($_smarty_tpl->tpl_vars['requestData']->value['search'] != '') {?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['uri']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['id'];?>
?find=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['find'];?>
&search=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['search'];?>
">
					<?php } else { ?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['uri']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['id'];?>
">
					<?php }?>			
					<span class="link-area" style="padding-left:<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['space'];?>
">
						<span class="label label-primary <?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['icon_box_color'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['icon_box'];?>
</span>						
						<?php echo nl2br($_smarty_tpl->tpl_vars['item']->value['subject']['title']);?>

						<span class="<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['css_comment'];?>
">(<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['comment_num'];?>
)</span>
						<?php if ($_smarty_tpl->tpl_vars['item']->value['subject']['img_name'] != '') {?>
						<img src="<?php echo $_smarty_tpl->tpl_vars['skinPathList']->value['dir'];?>
/images/<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['img_name'];?>
" class="<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['icon_img'];?>
">
						<?php }?>
						<img src="<?php echo $_smarty_tpl->tpl_vars['skinPathList']->value['dir'];?>
/images/icon_new_1.gif" class="<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['icon_new'];?>
"  title="<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['icon_new_title'];?>
">
						<span class="label label-primary <?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['icon_progress_step_color'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['progress_step_name'];?>
</span>	
					</span></a>
				</td>				
				<td class="date"><span><?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
</span></td>
				<td class="hit"><span><?php echo $_smarty_tpl->tpl_vars['item']->value['ssunseo_count'];?>
</span></td>
			</tr>
			<?php } else { ?>
			<tr>
				<td colspan="4" class="warn-subject color-red"><span>등록된 게시물이 없습니다.</span></td>
			</tr>
			<?php }?>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

		</tbody>
	</table>
	<div class="board-page-navi" style="width:<?php echo $_smarty_tpl->tpl_vars['groupData']->value['width'];?>
">
	<?php if ($_smarty_tpl->tpl_vars['skinPathList']->value['navi'] != '') {?>
		<?php $_smarty_tpl->_assignInScope('naviSkinPath', $_smarty_tpl->tpl_vars['skinPathList']->value['navi']);
?>
		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['naviSkinPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

	<?php }?>
	</div>
	<div class="board-search ui-inlineblock">
		<form action="<?php echo $_smarty_tpl->tpl_vars['uri']->value;?>
" method="post" name="f_board_list_search">
			<input type="hidden" name="_method" value="select">
			<select name="find">
				<option value='title'>제 목</option>
				<option value='name'>작성자</option>
				<option value='comment'>내 용</option>
			</select>
			<input type="text" name="search" size="15">
			<input name="imageField" type="image" src="<?php echo $_smarty_tpl->tpl_vars['skinPathList']->value['dir'];?>
/images/btn_search.gif" width="51" height="23" border="0">
		</form>
	</div>	
	<div class="board-list-buttons">
		<?php if ($_smarty_tpl->tpl_vars['requestData']->value['search'] != '') {?>
			<a href="<?php echo $_smarty_tpl->tpl_vars['uri']->value;?>
/write?find=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['find'];?>
&search=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['search'];?>
">
		<?php } else { ?>
			<a href="<?php echo $_smarty_tpl->tpl_vars['uri']->value;?>
/write">
		<?php }?>
		<img src="<?php echo $_smarty_tpl->tpl_vars['skinPathList']->value['dir'];?>
/images/btn_write.gif" width="62" height="23" border="0"></a>
	</div>
</div>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
