<?php
/* Smarty version 3.1.30, created on 2016-09-04 12:00:58
  from "/Applications/MAMP/htdocs/sux/modules/board/skin/default/opkey.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57cbf0dac9ba84_82066748',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '60fcb3918ae2868a1cb96db411b219a9b92a93aa' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/skin/default/opkey.tpl',
      1 => 1472983257,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57cbf0dac9ba84_82066748 (Smarty_Internal_Template $_smarty_tpl) {
?>

	<form action="board.php?board=<?php echo $_smarty_tpl->tpl_vars['board']->value;?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['board_grg']->value;?>
&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&action=opkey" method="post"  name="musimso" onSubmit="return musimso_check(this);">
	<table summary="관리자 설정옵션입니다.">
		<tbody>
			<tr>
				<td>진행상황</td>
				<td>
					<input type="radio" name="opkey" id="opkey_ing" value="f" checked>
					<label for="opkey_ing"><span>진행완료</span></label>&nbsp;
					<input type="radio" name="opkey" id="opkey_down" value="i">
					<label for="opkey_down"><span>진행중</span></label>
				</td>
			</tr>
			<tr>
				<td>입금상황</td>
				<td>
					<input type="radio" name="opkey" id="opkey_charged" value="c">
					<label for="opkey_charged"><span>입금완료</span></label>&nbsp;
					<input type="radio" name="opkey" id="opkey_nocharged" value="n">
					<label for="opkey_nocharged"><span>미입금</span></label>
				</td>
			</tr>
			<tr>
				<td>메일현황</td>
				<td>
					<input type="radio" name="opkey" id="opkey_sended" value="m">
					<label for="opkey_sended"><span>발송완료</span></label>
				</td>
			</tr>
			<tr>
				<td>초기화</td>
				<td>
					<input type="radio" name="opkey" id="opkey_reset" value="">
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
