<div class="board-adminsetup" style="width:<? echo ${width}; ?>">
	<form action="board.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&id=<? echo $id; ?>&action=opkey" method="post"  name="musimso" onSubmit="return musimso_check(this);">
	<table summary="관리자 설정옵션입니다.">
		<tbody>
			<tr>
				<td>진행상황</td>
				<td>
					<input type="radio" name="opkey" value="f" checked> <span>진행완료</span>&nbsp;
					<input type="radio" name="opkey" value="i"> <span>진행중</span>
				</td>
			</tr>
			<tr>
				<td>입금상황</td>
				<td>
					<input type="radio" name="opkey" value="c"> <span>입금완료</span>&nbsp;
					<input type="radio" name="opkey" value="n"> <span>미입금</span>
				</td>
			</tr>
			<tr>
				<td>메일현황</td>
				<td><input type="radio" name="opkey" value="m"> <span>발송완료</span></td>
			</tr>
			<tr>
				<td>초기화</td>
				<td><input type="radio" name="opkey" value=""> <sapn>초기화</sapn></td>
			</tr>
		</tbody>
	</table>
	<div class="form-text-tip">※ 해당버튼을 선택하여 진행상황을 표시할 수 있습니다.</div>
	<div class="form-submit">		
		<input type="submit" name="submit" size="10" value=" 보내기 ">
	</div>
	</form>
</div>