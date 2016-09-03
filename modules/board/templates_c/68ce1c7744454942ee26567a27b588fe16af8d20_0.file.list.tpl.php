<?php
/* Smarty version 3.1.30, created on 2016-09-02 12:27:49
  from "/Applications/MAMP/htdocs/sux/modules/board/skin/default/list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57c954256d05b6_16777275',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '68ce1c7744454942ee26567a27b588fe16af8d20' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/skin/default/list.tpl',
      1 => 1472812066,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57c954256d05b6_16777275 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="board-list" style="width:<?php echo $_smarty_tpl->tpl_vars['width']->value;?>
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
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rows_data']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>			
			<?php if (isset($_smarty_tpl->tpl_vars['item']->value)) {?>
			<tr>
				<td class="author"><span><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</span></td>
				<td class="subject">
					<span style="display:<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['space_display'];?>
;width:<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['space_width'];?>
"></span>
					<span style="display:<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['space_display'];?>
;padding-right:5px"><img src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/icon_answer.gif"></span>
					<span style="display:<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['icon_display'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['icon_name'];?>
"></span>
					<a href="board.php?board=<?php echo $_smarty_tpl->tpl_vars['board']->value;?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['board_grg']->value;?>
&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['id'];?>
&igroup=<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['igroup'];?>
&sid=<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['sid'];?>
&passover=<?php echo $_smarty_tpl->tpl_vars['passover']->value;?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&action=read"><span><?php echo nl2br($_smarty_tpl->tpl_vars['item']->value['subject']['title']);?>
</span></a>
					<span style="display:<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['comment_display'];?>
">(<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['comment_num'];?>
)</span>
					<span style="display:<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['newicon_display'];?>
;padding-left:5px"><img src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/new.gif"></span>
					<span style="display:<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['opkey_display'];?>
;padding-left:5px"><img src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/<?php echo $_smarty_tpl->tpl_vars['item']->value['subject']['opkey_name'];?>
"></span>
				</td>				
				<td class="date"><span><?php echo $_smarty_tpl->tpl_vars['item']->value['compareDay'];?>
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
	<form action="" method="post" name="musimsl" onSubmit="return musimsl_check(this);">
		<select name=find>
			<option value='title'>제 목</option>
			<option value='name'>작성자</option>
			<option value='comment'>내 용</option>
		</select>
		<input type=text name=search size=15>
		<input name="imageField" type="image" src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/btn_search.gif" width="51" height="23" border="0">
	</form>
</div>	
<div class="board-buttons ui-inlineblock">
	<a href=""><img src="<?php echo $_smarty_tpl->tpl_vars['skin_dir']->value;?>
/images/btn_write.gif" width="62" height="23" border="0"></a>
</div>

<?php echo '<script'; ?>
 type="text/javascript" src="/js/board.list.js"><?php echo '</script'; ?>
>
<?php }
}
