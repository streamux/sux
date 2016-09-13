<?php
/* Smarty version 3.1.30, created on 2016-09-09 10:15:49
  from "/Applications/MAMP/htdocs/sux/modules/board/skin/default/_opkey.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57d26fb5c933f6_12579473',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd2a3d5ca2f018e5f4df4cdd42be792bc1ed6a0a7' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/skin/default/_opkey.tpl',
      1 => 1473408811,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d26fb5c933f6_12579473 (Smarty_Internal_Template $_smarty_tpl) {
?>

	<form action="board.php?board=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board_grg'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['id'];?>
&action=opkey" method="post"  name="f_board_read_opkey" onSubmit="return jsux.fn.boardRead.checkOpkeyForm(this);">
	<table summary="관리자 설정옵션입니다.">
		<tbody>
			<tr>
				<td>진행상황</td>
				<td>
					<input type="radio" name="opkey" id="opkey_done" value="진행완료">
					<label for="opkey_done"><span >진행완료</span></label>&nbsp;
					<input type="radio" name="opkey" id="opkey_ing" value="진행중">
					<label for="opkey_ing"><span>진행중</span></label>
				</td>
			</tr>
			<tr>
				<td>입금상황</td>
				<td>
					<input type="radio" name="opkey" id="opkey_charged" value="입금완료">
					<label for="opkey_charged"><span>입금완료</span></label>&nbsp;
					<input type="radio" name="opkey" id="opkey_nocharged" value="미입금">
					<label for="opkey_nocharged"><span>미입금</span></label>
				</td>
			</tr>
			<tr>
				<td>메일현황</td>
				<td>
					<input type="radio" name="opkey" id="opkey_sended" value="메일발송">
					<label for="opkey_sended"><span>메일발송</span></label>
				</td>
			</tr>
			<tr>
				<td>초기화</td>
				<td>
					<input type="radio" name="opkey" id="opkey_reset" value=""  checked>
					<label for="opkey_reset"><span>초기화</span></label>
				</td>
			</tr>
		</tbody>
	</table>
	<div class="form-text-tip">※ 해당버튼을 선택하여 진행상황을 표시할 수 있습니다.</div>
	<div class="form-submit">		
		<input type="submit" name="submit" size="10" value=" 보내기 ">
	</div>
	</form>
<?php }
}
