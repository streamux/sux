	<form action="{$uri}/{$contentData.id}/progress-step" name="f_progress_step" method="post">
	<input type="hidden" name="_method" value="update">
	<table summary="관리자 진행 상황 설정 옵션입니다.">
		<tbody>
			<tr>
				<td>진행상황</td>
				<td>
					<input type="radio" name="progress_step" id="progress_step_done" value="진행완료" {$contentData.progress_step_done}>
					<label for="progress_step_done"><span >진행완료</span></label>&nbsp;
					<input type="radio" name="progress_step" id="progress_step_ing" value="진행중" {$contentData.progress_step_ing}>
					<label for="progress_step_ing"><span>진행중</span></label>
				</td>
			</tr>
			<tr>
				<td>입금상황</td>
				<td>
					<input type="radio" name="progress_step" id="progress_step_charged" value="입금완료" {$contentData.progress_step_charged}>
					<label for="progress_step_charged"><span>입금완료</span></label>&nbsp;
					<input type="radio" name="progress_step" id="progress_step_nocharged" value="미입금" {$contentData.progress_step_nocharged}>
					<label for="progress_step_nocharged"><span>미입금</span></label>
				</td>
			</tr>
			<tr>
				<td>메일현황</td>
				<td>
					<input type="radio" name="progress_step" id="progress_step_sended" value="메일발송" {$contentData.progress_step_sended}>
					<label for="progress_step_sended"><span>메일발송</span></label>
				</td>
			</tr>
			<tr>
				<td>초기화</td>
				<td>
					<input type="radio" name="progress_step" id="progress_step_reset" value="초기화" {$contentData.progress_step_reset}>
					<label for="progress_step_reset"><span>초기화</span></label>
				</td>
			</tr>
		</tbody>
	</table>
	<div class="form-text-tip">※ 해당버튼을 선택하여 진행상황을 표시할 수 있습니다.</div>
	<div class="form-submit">		
		<input type="submit" name="submit" size="10" value=" 보내기 ">
	</div>
	</form>
