<?php
/* Smarty version 3.1.30, created on 2016-11-25 08:24:51
  from "/Applications/MAMP/htdocs/sux/modules/board/skin/default/_progress_step.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5837e7431f73c8_92522924',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '859b5b51b7fa5cb6b63f1c7f51af7bd4acf3aae6' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/skin/default/_progress_step.tpl',
      1 => 1480058679,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5837e7431f73c8_92522924 (Smarty_Internal_Template $_smarty_tpl) {
?>
	<form action="board.php?board=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board_grg'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['id'];?>
&action=recordOpkey" name="f_progress_step" method="post">
	<table summary="관리자 진행 상황 설정 옵션입니다.">
		<tbody>
			<tr>
				<td>진행상황</td>
				<td>
					<input type="radio" name="progress_step" id="progress_step_done" value="진행완료">
					<label for="progress_step_done"><span >진행완료</span></label>&nbsp;
					<input type="radio" name="progress_step" id="progress_step_ing" value="진행중">
					<label for="progress_step_ing"><span>진행중</span></label>
				</td>
			</tr>
			<tr>
				<td>입금상황</td>
				<td>
					<input type="radio" name="progress_step" id="progress_step_charged" value="입금완료">
					<label for="progress_step_charged"><span>입금완료</span></label>&nbsp;
					<input type="radio" name="progress_step" id="progress_step_nocharged" value="미입금">
					<label for="progress_step_nocharged"><span>미입금</span></label>
				</td>
			</tr>
			<tr>
				<td>메일현황</td>
				<td>
					<input type="radio" name="progress_step" id="progress_step_sended" value="메일발송">
					<label for="progress_step_sended"><span>메일발송</span></label>
				</td>
			</tr>
			<tr>
				<td>초기화</td>
				<td>
					<input type="radio" name="progress_step" id="opkey_reset" value=""  checked>
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
