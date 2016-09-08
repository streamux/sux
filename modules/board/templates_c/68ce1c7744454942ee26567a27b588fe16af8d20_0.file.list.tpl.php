<?php
/* Smarty version 3.1.30, created on 2016-09-07 10:50:32
  from "/Applications/MAMP/htdocs/sux/modules/board/skin/default/list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57cfd4d87bc880_51181015',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '68ce1c7744454942ee26567a27b588fe16af8d20' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/skin/default/list.tpl',
      1 => 1473238230,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57cfd4d87bc880_51181015 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="board-list" style="width:<?php echo $_smarty_tpl->tpl_vars['group_data']->value['width'];?>
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
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_data']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
			<?php if (isset($_smarty_tpl->tpl_vars['item']->value)) {?>
			<tr>
				<td class="author"><span><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</span></td>
				<td class="subject">					
					<a href="board.php?board=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['board_grg'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['id'];?>
&igroup=<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['igroup'];?>
&ssunseo=<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['ssunseo'];?>
&sid=<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['sid'];?>
&passover=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['passover'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['page'];?>
&search=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['search'];?>
&find=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['find'];?>
&action=read"><span style="padding-left:<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['space'];?>
" class="link-area">
						<span class="label label-primary <?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['icon_box_color'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['icon_box'];?>
</span>						
						<?php echo nl2br($_smarty_tpl->tpl_vars['item']->value['subject']['title']);?>

						<span class="<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['txt_tail'];?>
">(<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['tail_num'];?>
)</span>
						<img src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/icon_new_1.gif" class="<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['icon_new'];?>
"  title="<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['icon_new_title'];?>
">
						<img src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['opkey_name'];?>
" class="<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['icon_opkey'];?>
">
						<img src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['img_name'];?>
" class="<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['icon_img'];?>
">
					</span></a>
				</td>				
				<td class="date"><span><?php echo $_smarty_tpl->tpl_vars['item']->value['date'];?>
</span></td>
				<td class="hit"><span><?php echo $_smarty_tpl->tpl_vars['item']->value['hit'];?>
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
</div>

<div class="board-page-navi">
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['navi_skin_path']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

</div>
<div class="board-search ui-inlineblock">
	<form action="board.php?board=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['board_grg'];?>
&find=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['find'];?>
&search=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['search'];?>
&action=list" method="post" name="musimsl" onSubmit="return musimsl_check(this);" method="post" name="musimsl" onSubmit="return musimsl_check(this);">
		<select name="find">
			<option value='title'>제 목</option>
			<option value='name'>작성자</option>
			<option value='comment'>내 용</option>
		</select>
		<input type="text" name="search" size="15">
		<input name="imageField" type="image" src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/btn_search.gif" width="51" height="23" border="0">
	</form>
</div>	
<div class="board-list-buttons ui-inlineblock">
	<a href="board.php?board=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['board_grg'];?>
&action=list">
		<img src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/btn_list.gif" width="51" height="23" border="0">
	</a>
	<a href="board.php?board=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['board_grg'];?>
&passover=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['passover'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['req_data']->value['page'];?>
&action=write"><img src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/btn_write.gif" width="62" height="23" border="0"></a>
</div>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/js/board.list.js"><?php echo '</script'; ?>
>
<?php }
}
