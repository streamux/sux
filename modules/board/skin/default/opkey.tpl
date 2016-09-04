
	<form action="board.php?board={$board}&board_grg={$board_grg}&id={$id}&action=opkey" method="post"  name="musimso" onSubmit="return musimso_check(this);">
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
