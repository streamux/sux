{assign var=rootPath value=$skinPathList.root}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="SUX관리자 팝업 수정 - StreamUX"}
<div class="articles ui-edgebox">
	<div class="add">
		<div class="tt">
			<div class="imgbox">
				<h1>팝업수정</h1>
			</div>
		</div>
		<div class="box">
			<form action="{$rootPath}popup-admin/modify">
			<input type="hidden" name="_method" value="update">
			<dl>
				<dt>팝업수정 옵션설정</dt>
				<dd>
					<img src="{$rootPath}modules/admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
					<span class="text-notice">발강색(*)으로 표신된 부분은 반드시 입력해주세요.</span>
					<input type="hidden" name="id" value="{$documentData.id}">	
				</dd>
			</dl>
			<table summary="팝업 정보를 입력해 생성해주세요.">
				<caption class="blind">팝업 정보 입력</caption>
				<tbody>
					<tr>
						<td><label for="popup_name">*팝업이름</label></td>
						<td>
							<input type="text" id="popup_name" name="popup_name" size="20" maxlength="30">
						</td>
					</tr>
					<tr>
						<td><label for="popup_title">제목</label></td>
						<td>
							<input type="text" id="popup_title" name="popup_title" size="30" maxlength="30">
						</td>
					</tr>
					<tr>
						<td>노출</td>
						<td>
							<select name="is_usable">
								<option value="n">n</option>
								<option value="y">y</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>시간</td>
						<td>
							<input type="text" id="period_year" name="time_year" size="4" maxlength="4">
							<span><label for="period_year">년</label></span>
							<input type="text" id="period_month" name="time_month" size="2" maxlength="2">
							<span><label for="period_month">월</label></span>
							<input type="text" id="period_day" name="time_day" size="2" maxlength="2">
							<span><label for="period_day">일</label></span>
							<input type="text" id="period_hours" name="time_hours" size="2" maxlength="2">
							<span><label for="period_hours">시</label></span>
							<input type="text" id="period_minutes" name="time_minutes" size="2" maxlength="2">
							<span><label for="period_minutes">분</label></span>
							<input type="text" id="period_seconds" name="time_seconds" size="2" maxlength="2">
							<span><label for="period_seconds">초 까지</label></span>
							<span>※ 팝업창 닫을 시간을 정확하게 설정하세요.</span>
						</td>
						</td>
					</tr>
					<tr>
						<td>스킨</td>
						<td>
							<select name="skin" id="skinList">
							{foreach from=$documentData.skin_list item=$item}
								<option>{$item.file_name}</option>
							{/foreach}
							</select>
						</td>
					</tr>
					<tr>
						<td>팝업크기</td>
						<td>
							<label for="popup_width">넓이</label>
							<input type="text" id="popup_width" name="popup_width" size="4" maxlength="3">
							<label for="popup_height">높이</label>
							<input type="text" id="popup_height" name="popup_height" size="4" maxlength="3">
						</td>
					</tr>
					<tr>
						<td>팝업위치</td>
						<td>
							<label for="popup_top">상단</label>
							<input type="text" id="popup_top" name="popup_top" size="4" maxlength="3">
							<label for="popup_left">좌측</label>
							<input type="text" id="popup_left" name="popup_left" size="4" maxlength="3" >
							<span>※ 모니터 기준</span>
						</td>
					</tr>		
					<tr>
						<td>내용여백</td>
						<td>
							<label for="skin_top">상단</label>
							<input type="text" id="skin_top" name="skin_top" size="4" maxlength="3">
							<label for="skin_left">좌측</label>
							<input type="text" id="skin_left" name="skin_left" size="4" maxlength="3">
							<label for="skin_right">우측</label>
							<input type="text" id="skin_right" name="skin_right" size="4" maxlength="3">
						</td>
					</tr>						
					<tr>
						<td><label for="textarea_contents">수정내용</label></td>
						<td>
							<textarea id="textarea_contents" name="contents" cols="25" rows="6"></textarea>
							<span>※ 팝업에 들어갈 내용을 입력해주세요.</span>
						</td>
					</tr>
				</tbody>
			</table>

			<input type="submit" name="submit" size="10" value="수 정">
			<input type="button" name="cancel" value="취 소">

			</form>					
		</div>
	</div>
</div>
<script type="jquery-templete" id="popupLabel_tmpl">
{literal}
	<span>${label}</span>
{/literal}
</script>
<script type="jquery-templete" id="skinList_tmpl">
{literal}
	<option>${file_name}</option>
{/literal}
</script>
{include file="$footerPath"}